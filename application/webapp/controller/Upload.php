<?php
namespace app\webapp\controller;

use think\facade\Log;

class Upload extends Base
{
	protected $uploadValid;

	public function __construct()
	{
		parent::__construct();

		$this->uploadValid	=	[
			'size'	=>	2097152,
			'ext'	=>	'jpeg,jpg,png,gif'
		];
	}

	/**
	 * Fileinput插件图片上传
	 */
	public function fileinput()
	{
		Log::record("开始上传FileInput图片...");

		$file	=	request()->file('upload_pic');
		if (empty($file)) {
			Log::record("未获取到上传图片信息!", "error");
			return ajaxReturn(null, $this->response_code['REQUEST_PARAMS_ERR'], "未找到上传文件信息");
		}
		
		$upload_info	=	$file->validate($this->uploadValid)->move('./uploads/picture/');
		if(!$upload_info){
			$err_message	=	$file->getError();
			Log::record("上传文件失败 [Error: {$err_message}]", "error");
			return	ajaxReturn(null, $this->response_code['SYS_OPERATE_FAILED'], $err_message);
		}
		
		// 设置图片地址
		$file_name		=	$upload_info->getSaveName();
		$image_file		=	"./uploads/picture/" . $file_name;
		$upload_url		=	config("app.website_url") . substr($image_file, 1);

		return ajaxReturn(['upload_path' => $upload_url], 0, "上传图片成功！");
	}
}