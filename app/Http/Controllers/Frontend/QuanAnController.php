<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Page;
use App\Category;
use App\Store;
use App\Region;
use Mail;
class QuanAnController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $uu_dais = Blog::orderBy('boost')
        ->orderBy('updated_at','desc')
        ->where('visibility',1)
        ->get();
    	return view('frontend_v2.home.index',compact('uu_dais'));
    }

    public function thuc_don()
    {
        $title = 'Thực đơn';
        return view('frontend_v2.home.thuc_don',compact('title'));
    }

    public function thanh_vien()
    {
        $title = 'Thành viên';
        $page = Page::where('slug', 'thanh-vien')->first();
        if(!$page) return view_404();
        return view('frontend_v2.home.thanh_vien',compact('title','page'));
    }

    public function uu_dai()
    {
        $title = 'Ưu đãi';
        $uu_dais = Blog::orderBy('boost')
        ->orderBy('updated_at','desc')
        ->get();
        return view('frontend_v2.home.uu_dai',compact('title','uu_dais'));
    }

    public function tuyen_dung()
    {
        $page = Page::where('slug', 'tuyen-dung')->first();
        $title = 'Tuyển dụng';
        if(!$page) return view_404();
        return view('frontend_v2.home.tuyen_dung',compact('page','title'));
    }

    public function gioi_thieu()
    {
        $title = 'Giới thiệu';
        $page = Page::where('slug', 'gioi-thieu')->first();
        if(!$page) return view_404();
        return view('frontend_v2.home.gioi_thieu',compact('title','page'));
    }

    public function tin_tuc()
    {
        $title = 'Tin tức';
        return view('frontend_v2.home.tin_tuc',compact('title'));
    }

    public function chi_nhanh()
    {
        $title = 'Chi nhánh';
        return view('frontend_v2.home.chi_nhanh',compact('title'));
    }


    public function lien_he()
    {
        $title = 'Liên hệ';
        $stores = Store::where('city',10958)->where('visibility', 1)->get();
        $cities = Region::listCitiesHaveStores();
        $districts = Region::listDistrictsHaveStores(10958);
        $more = (object)[
            'id' => '-1',
            'full_title' => 'Tất cả quận, huyện',
            'title' => 'Tất cả quận, huyện',
        ];

        $districts->prepend($more);
        return view('frontend_v2.home.lien_he',compact('title','stores','districts','cities'));
    }

    public function postLienHe(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|min:3|max:100|email',
            'title' => 'required|min:3|max:100',
            'content' => 'required|min:3|max:300',
        ],[
            'title.required' =>  'Vui lòng nhập tiêu đề',
            'title.min' =>  'Tiêu đề ít nhất :min ký tự',
            'title.max' =>  'Tiêu đề tối đa :max ký tự',
            'name.required' =>  'Vui lòng nhập tên',
            'name.min' =>  'Tên ít nhất :min ký tự',
            'name.max' =>  'Tên ngắn hơn :max ký tự',
            'content.required' =>  'Vui lòng nhập nội dung',
            'content.min' =>  'Nội dung ít nhất :min ký tự',
            'content.max' =>  'Nội dung không quá nhất :max ký tự',
            'email.required' =>  'Vui lòng nhập email',
            'email.email' =>  'Định dạng email không hợp lệ',
            'email.max' =>  'Email không quá :max ký tự',
            'email.min' =>  'Email ít nhất :min ký tự',
        ]);

        $data = [
            'name'=>$request->name,
            'title' => $request->title,
            'email' => $request->email,
            'content' => $request->content,
        ];

        Mail::send('frontend_v2.email.email', $data, function($message) {
            $message->to('info@comtamcali.com', 'Artisans Web')
            ->subject('Khách hàng liên hệ từ comtamcali.com');
            $message->from('info@comtamcali.com','Cơm tấm Cali');
        });

        return redirect()->route('frontend.lien_he')
        ->withSuccess('Cám ơn bạn đã gửi liên hệ, chúng tôi sẽ trả lời cho bạn trong thời gian sớm nhất');
    }

    public function huong_dan_mua_hang()
    {
        $title = 'Hướng dẫn';
        $page = Page::where('slug', 'huong-dan-dat-mon')->first();
        if(!$page) return view_404();
        return view('frontend_v2.home.huong_dan_mua_hang',compact('title','page'));
    }

    public function uu_dai_detail($slug)
    {
        $uu_dai = Blog::where('slug','=',$slug)->first();
        if(!$uu_dai) return view_404();
        return view('frontend_v2.home.uu_dai_detail',compact('uu_dai'));
    }

    // public function tin_tuc_detail($slug)
    // {
    //     return view('frontend_v2.home.tin_tuc_detail');
    // }

    public function cam_nhan_detail($slug)
    {
        return view('frontend_v2.home.cam_nhan_detail');
    }
}
