@extends('frontend_v2.layout.frontend')
@section('content')

<div class="news">
	<br>
	<div class="container">
		<div class="container-body">
			<hr class="body-hr">
			<h2 class="text-center">Chị BÍCH LỄ - NHA TRANG</h2>
			<hr>
			<div class="posts">
				<p>Sài gòn típ e kĩ wa. P/s: món ăn quá hoành tráng luôn. Giao hàng nhanh, vị ngon tuyệt vời nhé! Giờ mới biết món gà bó xôi. Ai muốn ăn thì liên hệ liền nha !</p>
				<p style="padding: 0 40px;">
					 
					<b>Chị BÍCH LỄ</b><br>

					Chị BÍCH LỄ - NHA TRANG <br><br>

					Sài gòn típ e kĩ wa. P/s: món ăn quá hoành tráng luôn. Giao hàng nhanh, vị ngon tuyệt vời nhé! Giờ mới biết món gà bó xôi. Ai muốn ăn thì liên hệ liền nha ! <br><br>

					Cảm nhận của chị Bích lễ trên facebook về món ăn của Flyfood: <br>
					Sài gòn típ e kĩ wa. <br>
					P/s: món ăn quá hoành tráng luôn. Giao hàng nhanh, vị ngon tuyệt vời nhé! Giờ mới biết món gà bó xôi. Ai muốn ăn thì liên hệ liền nha ! <br>

					Một số hình ảnh và link chia sẻ về món ăn của Flyfood mà chị Bích Lễ trên facebook: <br>


				</p>

				<p><img src="http://phohotpot.com/image/khong-gian.jpg"><img src="http://phohotpot.com/image/khong-gian-3.jpg"></p>

				<p>🌟🌟🌟🌟🌟 Chắc chắn các thực khách sẽ phải nghiền ngay vị phở " 5 sao" thơm nồng ngay lần thử đầu tiên. Một chút chua chua cay cay, một chút ngọt ngọt, vô cùng đặc sắc của Lẩu phở uyên ương.</p>


				<p><strong>➡️ Đến cảm nhận ngay và nhận ưu đãi hấp dẫn.</strong></p>

				<p><strong>***Lầu 4, TTTM Vincom Thảo Điền, Q2</strong>&nbsp;<br>
					<br>
					<strong>👨‍🍳 028.7300.3022</strong></p>
			</div>
		</div>
	</div>
</div>

@endsection
@section('style')
@endsection

@section('script')
<script>
	$('#contact_form').submit(function(e){
	    e.preventDefault();
	    // $('#success_message').slideDown({ opacity: "show" }, "slow"); // Do something ...
	    // $('#contact_form').data('bootstrapValidator').resetForm();
	    // $(this).trigger('reset');

	    // setTimeout(function(){
	    //     $('#success_message').slideUp({ opacity: "show" }, "slow");
	    // },4000);
	});
</script>
@endsection

