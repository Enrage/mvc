<?php
defined('TASKS') or die('Access Denied');
require_once 'db.php';

class model {

	private $db;

	public function __construct() {
    $this->db = db::getInstance();
  }

  // Получение списка задач
  public function get_all_tasks($start_pos, $perpage) {
  $query = "SELECT * FROM `tasks` ORDER BY `id` DESC LIMIT {$start_pos}, {$perpage}";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $rows = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }

  // Сохранение новой задачи
  public function save_new_task($user, $email, $text) {
    $query = 'INSERT INTO `tasks` (`user`, `email`, `text`) VALUES (?, ?, ?)';
    $stmt = $this->db->prepare($query);
    if ($stmt->execute([$user, $email, $text])) {
      return true;
    }
  }

  // Поменять статус задачи
  public function change_task_status($id, $status) {
    $query = 'UPDATE `tasks` SET `status` = ? WHERE `id` = ?';
    $stmt = $this->db->prepare($query);
    $stmt->execute([$status, $id]);
  }

  // Общее кол-во задач
  public function count_tasks() {
    $query = "SELECT COUNT(`id`) as `count_tasks` FROM `tasks`";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $rows = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
    }
    return (int)$rows[0]['count_tasks'];
  }

  // Получить данные задачи
  public function get_task_data($id) {
    $query = 'SELECT `text`, `status` FROM `tasks` WHERE `id` = ? LIMIT 1';
    $stmt = $this->db->prepare($query);
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  // Обновить текст задачи
  public function update_task_text($text, $id) {
    $query = 'UPDATE `tasks` SET `text` = ?, `updated` = ? WHERE `id` = ?';
    $stmt = $this->db->prepare($query);
    if ($stmt->execute([$text, 1, $id])) {
      return true;
    }
  }

  // Сортировка задач по параметру
  public function sort_tasks_by($start_pos, $perpage, $sort_by, $sort) {
    $query = "SELECT * FROM `tasks` ORDER BY {$sort_by} {$sort} LIMIT {$start_pos}, {$perpage}";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $rows = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }

  // Постраничная навигация
  public function pagination($page, $pages_count) {
    if ($_SERVER['QUERY_STRING']) {
      $uri = '';
      foreach ($_GET as $key => $value) {
        if ($key != 'page') $uri .= "{$key}={$value}&amp;";
      }
    } else $uri = null;

    $back = '';
    $forward = '';
    $startpage = '';
    $endpage = '';
    $page2left = '';
    $page1left = '';
    $page2right = '';
    $page1right = '';
    if ($page > 1) $back = "<a class='nav_link' href='?{$uri}page=" . ($page - 1) . "'>&lt;</a>";
    if ($page < $pages_count) $forward = "<a class='nav_link' href='?{$uri}page=" . ($page + 1) . "'>&gt;</a>";
    if ($page > 3) $startpage = "<a class='nav_link' href='?{$uri}page=1'><<</a>";
    if ($page < ($pages_count - 2)) $endpage = "<a class='nav_link' href='?{$uri}page={$pages_count}'>>></a>";
    if ($page - 2 > 0) $page2left = "<a class='nav_link' href='?{$uri}page=" . ($page - 2) . "'>" . ($page - 2) . "</a>";
    if ($page - 1 > 0) $page1left = "<a class='nav_link' href='?{$uri}page=" . ($page - 1) . "'>" . ($page - 1) . "</a>";
    if ($page + 2 <= $pages_count) $page2right = "<a class='nav_link' href='?{$uri}page=" . ($page + 2) . "'>" . ($page + 2) . "</a>";
    if ($page + 1 <= $pages_count) $page1right = "<a class='nav_link' href='?{$uri}page=" . ($page + 1) . "'>" . ($page + 1) . "</a>";

    echo $startpage . $back . $page2left . $page1left . '<span class="nav_active">' . $page . '</span>' . $page1right . $page2right . $forward . $endpage;
  }

	// Авторизация
	public function authorization() {
		$login = trim($_POST['login']);
		$pass = trim($_POST['password']);
		if (empty($login) OR empty($pass)) {
			$_SESSION['auth']['error'] = 'Оба поля обязательны для заполнения';
		} else {
			$pass = md5($pass);
      $query = "SELECT `id`, `username`, `role` FROM `users` WHERE `username` = ? AND `password` = ? LIMIT 1";

      $stmt = $this->db->prepare($query);
      $stmt->execute([$login, $pass]);
      if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['auth']['admin'] = $row['username'];
        header('Location: /');
      } else {
        $_SESSION['auth']['error'] = 'Неправильный логин или пароль';
        return false;
      }
		}
	}

  // Выйти
  public function logout() {
    unset($_SESSION['auth']);
    header('Location: /');
  }
}