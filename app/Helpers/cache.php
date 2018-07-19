<?php
function changeCacheProduct($drug)
{
	if($drug){
		Cache::tags(['nganh_ban_chay_nhat'])->flush();
		Cache::tags(['product_list_ajax'])->flush();
		Cache::tags(['product'])->forget('id_'.$drug->id);
		Cache::tags(['frontend'])->forget('frontend.thuoc-detail'.'_product_'.$drug->id);
		
	}

}