<?php
  $filename = public_path('images/count.txt');
  $count = (int)file_get_contents($filename);
  if(date("d-m-Y", filemtime($filename)) == date('d-m-Y')){
    $count = (int)file_get_contents($filename);
  }else{
    $rand = $count + rand(50,100);
    $count = $rand;
    file_put_contents($filename, $rand);
  }
?>
<footer>
  <div class="link_footer">
  <div class="container text-center viewers">
    <a href="https://mail.google.com">
        <img src="/images/mail.jpg" alt="email google">
        <p> Số người đang online: {{ rand(5,10)}} | Tổng lượt truy cập: {{ $count }} </p>
    </a>
  </div>
{{--     <div class="container"> <div class="box_link"> <hr> <h3><a href="http://ggg.com.vn/vi/về-golden-gate/" title="Về Golden Gate">Về Golden Gate</a></h3> </div> <div class="box_link"> <hr> <h3><a href="http://thegoldenspoon.ggg.com.vn/" title="The Golden Spoon">The Golden Spoon</a></h3> </div> <div class="box_link"> <hr> <h3><a href="http://ggg.com.vn/vi/van-hóa/" title="Văn hóa">Văn hóa</a></h3> </div> <div class="box_link"> <hr> <h3><a href="http://ggg.com.vn/vi" title="Tin tức">Tin tức</a></h3> </div> <div class="box_link"> <hr> <h3><a href="https://www.facebook.com/TuyendungGoldenGateGroup/?ref=br_rs" title="Tuyển dụng">Tuyển dụng</a></h3> </div> </div> </div> --}}
  <div class="address_footer">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-6">
          <div class="address">
            <p style="font-size: 20px"><b>Công ty CP Ngọc Lễ F&B</b></p>
            Trụ sở chính: 32 Nguyễn Trãi, Phường Bến Thành, Quận 1, Hồ Chí Minh<br>
            ĐT: <a style="font-weight: bold;color: white" href="tel:19002254">1900 2254</a>    &nbsp;&nbsp;<a href="mailto:info@comtamcali.com" style="font-weight: bold;color: white">Email: info@comtamcali.com</a><br>
            Fanpage: <a href="https://www.facebook.com/comtamcali.official" style="color: white">comtamcali.official</a> <br>
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="bct">
            {{-- <img src="/frontend_v2/Content/images/bct.png" alt=""> --}}
            <p>© 2018 Cơm tấm Cali. All rights reserved</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>