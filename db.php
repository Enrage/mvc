<?php
require_once 'config.php';
class db {

  private static $pdo = null;

	private function __construct() {

	}

	public static function getInstance() {
		if (self::$pdo == null) {
			try {
				self::$pdo = new PDO('mysql:host='.config::HOST.';dbname='.config::DB, config::USER, config::PASS);
				self::$pdo->query("SET NAMES 'UTF8'");
			} catch(PDOException $e) {
				die('No connect to Database');
			}
		}
		return self::$pdo;
	}
}