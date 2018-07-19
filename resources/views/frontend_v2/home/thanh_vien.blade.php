@extends('frontend_v2.layout.frontend')
@section('content')
<div class="news">
	<br>
	<div class="page-title">
		<div class="page-title-content">
			<div class="page-title-left"><span class="narrow"></span></div>
			<div class="page-title-center nowrap"><h1 class="title-menu"><strong>{{ $title }}.</strong></h1></div>
			<div class="page-title-right"></div>
		</div>
	</div>
	<br>

	<div class="container">
		<div class="container-body">
			<div class="row">
				<div class="col-sm-12">
					<div class="posts">
						{!! $page->content !!}
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection
@section('style')
<style>
#huong-dan-su-dung , #quyen-loi-thanh-vien, #dieu-khoan-su-dung {
	padding-bottom: 15px;
}

.divChiNhanh li {
	margin-bottom: 10px;
}

#divThanhvien {
	background: #f2f2f2 !important;
	font-family: "MyriadPro",Arial,sans-serif !important;
}

.news a {
	text-decoration: none !important;
}

.row {
	width: 102%;
}

.thanh-vien-section {
	margin-top: 110px;
}

.thanh-vien-container li {
	margin-bottom: 15px;
}

.thanh-vien-container {
	padding: 30px 100px 30px 100px;
}

.thanh-vien-container h2 {
	font-size: 38px;
}

.thanh-vien-section {
	font-size: 1.2em;
}

.thanh-vien-section h3 a:hover {
	font-weight: none !important;
}

a.mfn-link {
	color: #7c7c7c;
}
a.mfn-link-4 {
	padding: 12px 10px 10px;
	text-shadow: none;
	font-weight: 700;
}
a.mfn-link {
	position: relative;
	display: inline-block;
	margin: 15px 25px;
	font-size: 15px;
	text-shadow: 0 0 1px rgba(255,255,255,0.3);
	text-decoration: none;
	outline: none;
	white-space: nowrap;
}

/*cho di động*/
@media (max-width: 768px){
	.thanh-vien-section img {
		width: 100%;
	}

	#huong-dan-su-dung , #quyen-loi-thanh-vien, #dieu-khoan-su-dung {
		padding-bottom: 20px;
	}
	.row {
		width: 100%;
	}

	.thanh-vien-section {
		margin-top: 71px;
	}

	.thanh-vien-container {
		padding: 20px 15px;
	}
}

/* section ol style */
ol {
	margin:0 0 1.5em;
	padding:0;
	counter-reset:item;
}

ol > li > ul  {
	list-style: none;
}

ol>li {
	margin:0;
	padding:0 0 0 2em;
	text-indent:-2em;
	list-style-type:none;
	counter-increment:item;
}

ol>li:before {
	display:inline-block;
	width:1.5em;
	padding-right:0.5em;
	font-weight:bold;
	text-align:right;
	content:counter(item) ".";
}

/* section button dat-hang */
#table-dang-ky {
	width: 100%;
	border-collapse: collapse;
	border-spacing: 0;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}
#table-dang-ky h2 {
	color: #e49100 !important;
	text-shadow: 1px 1px #792723;
	font-size: 34px;
	font-family: "MyriadPro-Bold",Arial,sans-serif !important;
}
.c-button {
	border: 3px solid #e49100;
	border-radius: 0;
	color: #e49100;
	background: #fff;
	font-size: 1em;
	line-height: 80px;
	font-weight: bold;
	letter-spacing: .1em;
	font-family: "MyriadPro-Bold",Arial,sans-serif !important;
	padding: 20px 15px;
	cursor: pointer;
	transition: all .5s;
	white-space: nowrap;
}
.c-button--from-left {
	box-shadow: inset 0 0 0 0 #e49100;
}
.c-button--from-left:hover {
	box-shadow: inset 100vmax 0 0 0 #e49100;
	color: #fff;
}
.c-button--filled.c-button--from-left:hover {
	box-shadow: inset 100vmax 0 0 0 #fff;
	color: #e49100;
}

.c-button-border:hover {
	border: 3px solid #f5b23e !important;
}

.c-button:hover {
	border: 3px solid white;
}

.v-center {
	display: flex;
	align-items: center;
}

/* section text hover effect */
*,
*:after,
*::before {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

section {
	margin: 0 auto;
	padding: 50px 3em;
	text-align: center;
}
.color-8 {
	background: white;
}

.thanh-vien-section nav a {
	position: relative;
	display: inline-block;
	margin: 15px 25px;
	outline: none;
	text-decoration: none;
	letter-spacing: 1px;
	font-weight: 400;
	text-shadow: 0 0 1px rgba(255,255,255,0.3);
	font-size: 20px;
	font-weight: bold;
	font-family: "MyriadPro-Bold",Arial,sans-serif !important;
}
.thanh-vien-section nav a:hover,
.thanh-vien-section nav a:focus {
	outline: none;
	color: #eaa122;
}
.cl-effect-7 a {
	padding: 12px 10px 10px;
	color: #566473;
	text-shadow: none;
	font-weight: 700;
}

.cl-effect-7 a::before,
.cl-effect-7 a::after {
	position: absolute;
	top: 100%;
	left: 0;
	width: 100%;
	height: 3px;
	background: #ddd;
	content: '';
	-webkit-transition: -webkit-transform 0.3s;
	-moz-transition: -moz-transform 0.3s;
	transition: transform 0.3s;
	-webkit-transform: scale(0.85);
	-moz-transform: scale(0.85);
	transform: scale(0.85);
}

.cl-effect-7 a::after {
	opacity: 0;
	-webkit-transition: top 0.3s, opacity 0.3s, -webkit-transform 0.3s;
	-moz-transition: top 0.3s, opacity 0.3s, -moz-transform 0.3s;
	transition: top 0.3s, opacity 0.3s, transform 0.3s;
}

.cl-effect-7 a:hover::before,
.cl-effect-7 a:hover::after,
.cl-effect-7 a:focus::before,
.cl-effect-7 a:focus::after {
	-webkit-transform: scale(1);
	-moz-transform: scale(1);
	transform: scale(1);
	background: #eaa122;
}

.cl-effect-7 a:hover::after,
.cl-effect-7 a:focus::after {
	top: 0%;
	opacity: 1;
}
</style>
@endsection

@section('script')
@endsection

