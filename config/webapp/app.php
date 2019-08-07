<?php
return	[
	"website_url"			=>	"http://webapps.jfhycn.com",

	// Ajax响应返回错误码
	"response_error_code"   =>  [
		"SYSTEM_ERR"			=>		1000,		//	系统错误
		"REQUEST_PARAMS_ERR"	=>		1001,		//	请求参数错误
		"SYS_OPERATE_FAILED"	=>		1002,		//	操作失败

		"USER_NOT_LOGINED"		=>		2000,		//	用户未登录
		"USER_NOT_FOUND"		=>		2001,		//	用户未找到
		"USER_PASSWORD_ERR"		=>		2002,		//	帐号或密码不正确
		"USER_USERNAME_EXISTED"	=>		2003,		//	用户帐号已存在
		"UESR_STATUS_DISABLED"	=>		2004,		//	用户已被禁用
	],
];