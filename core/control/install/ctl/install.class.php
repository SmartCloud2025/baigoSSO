<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

//不能非法包含或直接执行
if(!defined("IN_BAIGO")) {
	exit("Access Denied");
}

include_once(BG_PATH_CLASS . "tpl.class.php"); //载入模板类
include_once(BG_PATH_MODEL . "opt.class.php"); //载入管理帐号模型

class CONTROL_INSTALL {

	private $obj_tpl;
	private $mdl_opt;

	function __construct() { //构造函数
		$this->obj_tpl    = new CLASS_TPL(BG_PATH_TPL_INSTALL);
	}


	/**
	 * install_1 function.
	 *
	 * @access public
	 * @return void
	 */
	function ctl_dbconfig() {
		$this->obj_tpl->tplDisplay("install_dbconfig.tpl", $this->tplData);

		return array(
			"str_alert" => "y030403",
		);
	}


	function ctl_auto() {
		if (!$this->check_db()) {
			return array(
				"str_alert" => "x030404",
			);
			exit;
		}

		$_str_url     = fn_getSafe($_GET["url"], "txt", "");
		$_str_path    = fn_getSafe($_GET["path"], "txt", "");
		$_str_target  = fn_getSafe($_GET["target"], "txt", "");

		$_arr_tplData = array(
			"url"    => base64_decode($_str_url),
			"path"   => $_str_path,
			"target" => $_str_target,
		);

		$this->obj_tpl->tplDisplay("install_auto.tpl", $_arr_tplData);

		return array(
			"str_alert" => "y030404",
		);
	}

	/**
	 * install_2 function.
	 *
	 * @access public
	 * @return void
	 */
	function ctl_dbtable() {
		if (!$this->check_db()) {
			return array(
				"str_alert" => "x030404",
			);
			exit;
		}

		$this->obj_tpl->tplDisplay("install_dbtable.tpl", $_arr_tplData);

		return array(
			"str_alert" => "y030404",
		);
	}


	function ctl_over() {
		if (!$this->check_db()) {
			return array(
				"str_alert" => "x030404",
			);
			exit;
		}

		$this->obj_tpl->tplDisplay("install_over.tpl", $_arr_tplData);

		return array(
			"str_alert" => "y030404",
		);
	}

	/**
	 * install_3 function.
	 *
	 * @access public
	 * @return void
	 */
	function ctl_base() {
		if (!$this->check_db()) {
			return array(
				"str_alert" => "x030404",
			);
			exit;
		}

		foreach ($this->obj_tpl->opt["base"] as $_key=>$_value) {
			$_arr_optRows[$_key] = $this->mdl_opt->mdl_read($_key);
		}

		$_arr_tplData["optRows"] = $_arr_optRows;

		$this->obj_tpl->tplDisplay("install_base.tpl", $_arr_tplData);

		return array(
			"str_alert" => "y030404",
		);
	}


	/**
	 * install_4 function.
	 *
	 * @access public
	 * @return void
	 */
	function ctl_reg() {
		if (!$this->check_db()) {
			return array(
				"str_alert" => "x030404",
			);
			exit;
		}

		foreach ($this->obj_tpl->opt["reg"] as $_key=>$_value) {
			$_arr_optRows[$_key] = $this->mdl_opt->mdl_read($_key);
		}

		$_arr_tplData["optRows"] = $_arr_optRows;

		$this->obj_tpl->tplDisplay("install_reg.tpl", $_arr_tplData);

		return array(
			"str_alert" => "y030404",
		);
	}


	/**
	 * ctl_admin function.
	 *
	 * @access public
	 * @return void
	 */
	function ctl_admin() {
		if (!$this->check_db()) {
			return array(
				"str_alert" => "x030404",
			);
			exit;
		}

		$this->obj_tpl->tplDisplay("install_admin.tpl", $_arr_tplData);

		return array(
			"str_alert" => "y030404",
		);
	}


	private function check_db() {
		if (strlen(BG_DB_HOST) < 1 || strlen(BG_DB_NAME) < 1 || strlen(BG_DB_USER) < 1 || strlen(BG_DB_PASS) < 1 || strlen(BG_DB_CHARSET) < 1) {
			return false;
		} else {
			$GLOBALS["obj_db"]   = new CLASS_MYSQL(); //设置数据库对象
			$this->mdl_opt       = new MODEL_OPT(); //设置管理员模型
			return true;
		}
	}
}
?>