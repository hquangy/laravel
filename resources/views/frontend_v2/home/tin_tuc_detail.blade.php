@extends('frontend_v2.layout.frontend')
@section('content')

<div class="news">
	<br>
	<div class="container">
		<div class="container-body">
			<hr class="body-hr">
			<h2 class="text-center">🎉🎉🎉GRAND OPENING - PHỞ HOTPOT 🎉🎉🎉</h2>
			<hr>
			<div class="posts">
				<p>🔥 Những hình ảnh đầu tiên về buổi khai trương hồng phát với "cơn lốc màu da cam" rực rỡ, trẻ trung không chê vào đâu được. Các fan của món phở huyền thoại nay có dịp thưởng thức phở theo phong cách tuyệt vời ông mặt trời.</p>

				<p><img src="http://phohotpot.com/image/khong-gian.jpg"><img src="http://phohotpot.com/image/khong-gian-1.jpg"><img src="http://phohotpot.com/image/khong-gian-2.jpg"><img src="http://phohotpot.com/image/khong-gian-3.jpg"></p>

				<p>🌟🌟🌟🌟🌟 Chắc chắn các thực khách sẽ phải nghiền ngay vị phở " 5 sao" thơm nồng ngay lần thử đầu tiên. Một chút chua chua cay cay, một chút ngọt ngọt, vô cùng đặc sắc của Lẩu phở uyên ương.</p>

				<p>&nbsp;</p>

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

