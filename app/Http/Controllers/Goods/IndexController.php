<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	/*
		商品详情页
	 */
    public function detail()
    {
    	return view('goods.detail');
    }
}
