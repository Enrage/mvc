<?php
defined('TASKS') or die('Access Denied');

abstract class Controller {

  protected $m;

	public function __construct() {
		$this->m = new model();
  }

	public function get_body($tpl) {
    $content = $this->get_content();
    require_once config::TEMPLATE.'tpl/index.php';
  }

	abstract function get_content();
}