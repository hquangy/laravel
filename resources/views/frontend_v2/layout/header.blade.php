<header id="header_nav" {{ Request::is('/') ? 'class=home' : ''}}>
  <nav class="navbar navbar-default navbar-fixed-top transparent">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('frontend.trang_chu') }}"><img src="/images/logo.png" alt="{{ config('comtamcali.title') }}"></a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
{{--           <li {{ Request::is('/') ? 'class=active' : ''}}>
            <a href="{{  route('frontend.trang_chu') }}">
              Trang chủ
            </a>
          </li> --}}
          <li {{ Request::segment(1) == 'gioi-thieu' ? 'class=active' : ''}}>
            <a href="{{ route('frontend.gioi_thieu') }}">
              Giới thiệu
            </a>
          </li>

          <li class="dropdown {{ Request::segment(1) == 'thuc-don' ? 'active' : ''}}">
            <a class="dropdown-toggle" href="{{ route('frontend.thuc_don') }}">Thực đơn <span class="caret hidden-sm hidden-md hidden-lg" style="float: right;"></span> </a>
            <ul class="dropdown-menu">
              @foreach($categories as $category)
              <li><a href="{{ route('frontend.thuc_don') . '#' .$category->slug}}" class="menu-tag">{{ mb_ucwords($category->title) }}</a></li>
              @endforeach
            </ul>
          </li>
          <li {{ Request::segment(1) == 'uu-dai' ? 'class=active' : ''}}>
            <a href="{{ route('frontend.uu_dai') }}">
              Thông tin & Ưu đãi
            </a>
          </li>
          <li {{ Request::segment(1) == 'tuyen-dung' ? 'class=active' : ''}}>
            <a href="{{ route('frontend.tuyen_dung') }}">
              Tuyển Dụng
            </a>
          </li>
          <li {{ Request::segment(1) == 'thanh-vien' ? 'class=active' : ''}}>
            <a href="{{ route('frontend.thanh_vien') }}">
              Thành viên
            </a>
          </li>
          <li {{ Request::segment(1) == 'huong-dan-mua-hang' ? 'class=active' : ''}}>
            <a href="{{ route('frontend.huong_dan_mua_hang') }}">
              Hướng dẫn đặt món
            </a>
          </li>
          <li {{ Request::segment(1) == 'lien-he' ? 'class=active' : ''}}>
            <a href="{{ route('frontend.lien_he') }}">
              Liên hệ
            </a>
          </li>
        </ul>
        {{-- <div class="langue"> <a href="vi/index.html" > <img src="/frontend_v2/media/1101/vn.png" alt=""> </a> <a href="voucher/index.html" > <img alt=""> </a> </div>  --}}
      </div>
    </div>
  </nav>
</header>