<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductWatch extends Model
{
    protected $table = 'cms_tproducts';

    protected $appends = ['description_ex', 'link', 'pri_img', 'sec_img' ,'type', 'color', 'price', 'price_off', 'num_inventory', 'store_status', 'gender','bo_suu_tap','ton'];

    public function getTypeAttribute()
    {
        $category = $this->category;
        if( !$category ) return null;

        return ( $this->category->ctype == 0 or $this->category->ctype == 1 ) ? 'Watch' : 'Jewellery';
    }

    public function getNumInventoryAttribute()
    {
        $inventories = $this->inventories;
        return count($inventories);
    }

    public function getTonAttribute()
    {
        $inventories = $this->inventories;
        $inventories = $inventories->where('cstatus', 1)->all();
        return count($inventories);
    }

    public function getStoreStatusAttribute()
    {
        $inventories = $this->inventories;
        if(count($inventories)) return 'In stock';
        return 'Available for order';
    }

    public function getPriceAttribute()
    {
        $price = $this->fprice * 23000;
        return number_format($price, 0, ',', '.') .' VND';
    }

    public function getPriceOffAttribute()
    {
        $price = $this->csale_off * 23000;
        return number_format($price, 0, ',', '.') .' VND';
    }


    public function getColorAttribute()
    {
        $descriptions = $this->descriptions;

        $color = $descriptions->where('nid_method', 24)->first();
        if($color) return $color->value;
        return null;
    }

    public function getBoSuuTapAttribute()
    {
        $descriptions = $this->descriptions;

        $collection = $descriptions->where('nid_method', 2)->first();
        if($collection) return $collection->value;
        return null;
    }

    public function getPriImgAttribute()
    {
        if( !$this->cimage) return null;

        return 'https://likewatch.com/upload/images_product/full_images/' .$this->cimage;
    }

    public function getLinkAttribute()
    {
        if( !$this->cproducts_vni) return null;

        return 'https://likewatch.com/product-vni-'.str_slug($this->cproducts_vni) . '-' . $this->nid. '.html';
    }
    
    public function getDescriptionExAttribute()
    {
        $des = null;
        $descriptions = $this->descriptions;
        // return count($descriptions);
        if( !count($descriptions) ) return $this->cdetail_vni;

        foreach($descriptions as $description){
            $des .= trim($description->method->cmethod) . ':' . $description->value ."\n";
        }

        return $des;
    }

    public function getSecImgAttribute()
    {
        $images = $this->images;
        if(!count($images)) return null;

        $image = $images->first();
        return 'https://likewatch.com/upload/images_product/full_images/' .$image->cimage;
    }

    public function getGenderAttribute()
    {
        // return $this->nid_material_products;
        if( in_array($this->nid_material_products, [85,87]) ) return 'female';

        if( $this->nid_material_products == 84 ) return 'male';

        if( in_array($this->nid_material_products, [88,91]) ) return 'unisex';

        return null;
    }

    #relationship
    public function material()
    {
        return $this->hasOne(MaterialWatch::class, 'nid', 'nid_material_products');
    }

    public function inventories()
    {
        return $this->hasMany(InventoryWatch::class, 'nid_products', 'nid');
    }

    public function images()
    {
        return $this->hasMany(ImageProductWatch::class, 'nid_products', 'nid');
    }

    public function category()
    {
        return $this->belongsTo(CategoryWatch::class, 'nid_cat_products', 'nid');
    }

    public function descriptions()
    {
        return $this->hasMany(ProductDescriptionWatch::class, 'nid_product', 'nid');
    }
    #end relationship

    // relationModel()
	public function scopeRelationModel($query)
	{
        $query->with(['images', 'category','inventories', 'material','descriptions'=> function($q) {$q->with('method'); }]);
	}


}
