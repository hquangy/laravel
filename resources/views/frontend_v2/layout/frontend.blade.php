<!DOCTYPE html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="shortcut icon" type="image/x-icon" href="/images/fa-logo.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title.content',config('comtamcali.title'))</title>
  <meta name="copyright" content="{{ config('comtamcali.title') }}"/>
  <meta name="author" content="{{ config('comtamcali.title') }}"/>
  <meta name="robots" content="@yield('robots.index', 'INDEX,FOLLOW')">
  <meta property="og:locale" content="vi_VN">
  <meta property="og:type" content="article">
  <meta property="og:site_name" content="{{ config('comtamcali.title') }}">
  @yield('seo.meta')
  {{-- <link href="/frontend_v2/css/bootstrap.css" rel="stylesheet"> --}}
  <link href="/css/styles.css" rel="stylesheet">
  <link href="/css/styles_business.css" rel="stylesheet">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/font-awesome.min.css" rel="stylesheet">
  {{-- <link href="/frontend_v2/css/bootstrap-theme.min.css" rel="stylesheet" /> --}}
  {{-- <link href="/frontend_v2/css/DateTimePicker.css" rel="stylesheet" /> --}}
  <link rel="stylesheet" href="/plugins/selectize/css/selectize.bootstrap3.css">
  <link href="/css/top-nav-transparent.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/custom.css">
  <script src="/js/jquery-3.1.0.min.js"></script>
  @yield('style')
  @include('frontend_v2.layout.script.header')
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-5DB62G4');</script>
  <!-- End Google Tag Manager -->
</head>
<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DB62G4"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  @include('frontend_v2.layout.header')
  @yield('content')
  <aside id="sticky-social">
    <ul>
      <li>
        <a href="tel:19002254" class="entypo-social" target="_blank">
          <i class="fa fa-phone" aria-hidden="true" style="font-size: 35px;"></i>
        </a>
      </li>

      <li>
        <a href="https://www.facebook.com/comtamcali.official" class="entypo-social" target="_blank">
          <i class="fa fa-facebook" aria-hidden="true" style="font-size: 30px;"></i>
        </a>
      </li>
      <li>
        <a href="#" class="entypo-social" target="_blank">
          <i class="fa fa-youtube-play" aria-hidden="true" style="font-size: 35px;"></i>
        </a>
      </li>
    </ul>
  </aside>
  <div class="sticky-social-toggle"><img src="/images/sticky-arrow.png"/></div>
  <div class="fixed">
    <a href="tel:19002254">
      <p style="font-size: 20px;" class="pDatMon">Đặt Món</p>
      <img src="/images/hotro-4.png" alt="{{ config('comtamcali.title') }}" width="39px" height="39px">
      <table>
        <tr>
          <td style="padding-right: 5px">
            <p>Delivery:</p>
          </td>
          <td>
            <p style="font-size: 22px;line-height: 14px">1900 CALI</p>
            <span class="text-small"> 1900  &nbsp;2254</span>
          </td>
        </tr>
      </table>
    </a>
  </div>
  @include('frontend_v2.layout.footer')
  @include('frontend_v2.layout.script.footer')
  @yield('script')
</body>
</html>