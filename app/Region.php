<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public static function listAllCities()
    {
        return self::where('parent_id', null)
        ->where('visibility', '=', 1)
        ->orderBy('title')
        ->get();
    }

    public static function listCitiesHaveStores()
    {
        return self::where('visibility', '=', 1)
        ->orderBy('title')->whereHas('thanhpho_hethong', function($q){
            $q->where('visibility', '=', 1);
        })
        ->get();
    }

    public static function listAllDistricts($id)
    {
        if(!$id) return [];
        return self::where('parent_id', $id)
        ->where('visibility', '=', 1)
        ->orderBy('title')
        ->get();
    }

    public static function listDistrictsHaveStores($id)
    {
        if(!$id) return [];
        return self::where('parent_id', $id)
        ->where('visibility', '=', 1)
        ->orderBy('title')->whereHas('quan_hethong', function($q){
            $q->where('visibility', '=', 1);
        })
        ->get();
    }

    /* START section ralationship */
    public function children()
    {
        return $this->hasMany(Region::class, 'parent_id', 'id');
    }

    public function thanhpho_hethong()
    {
        return $this->hasMany('App\Store','city','id');
    }

    public function quan_hethong()
    {
        return $this->hasMany('App\Store','district','id');
    }
    /* END section ralationship */
}
