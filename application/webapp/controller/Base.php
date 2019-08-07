<?php
namespace app\webapp\controller;

use think\Controller;

class Base extends Controller
{
	public function __construct()
	{
		parent::__construct();

		// 允许发起的跨域请求
		$origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '*';
		header("Access-Control-Allow-Origin: " . $origin);
		header("Access-Control-Allow-Credentials : true"); 
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie");
	}
}
