<?php
defined('TASKS') or die('Access Denied');

class main extends Controller {

	private $perpage = 3;

	public function get_content() {

		if (isset($_GET['sortby'])) {
			setcookie('sortby', trim(htmlspecialchars(strip_tags($_GET['sortby']))));
		}

		if (isset($_GET['sort'])) {
			setcookie('sort', trim(htmlspecialchars(strip_tags($_GET['sort']))));
		}

		$start_pos = $this->pos()['start_pos'];

		// Сортировать задачи по параметру
		if (isset($_COOKIE['sortby']) || isset($_GET['sortby'])) {
			$sort_by = $_GET['sortby'] ?? $_COOKIE['sortby'];
			$sort = $_GET['sort'] ?? $_COOKIE['sort'];
			$tasks = $this->m->sort_tasks_by($start_pos, $this->perpage, $sort_by, $sort);
		} else {
			$tasks = $this->m->get_all_tasks($start_pos, $this->perpage);
		}

		foreach ($tasks as &$task) {
			if ($task['status'] == 0) {
				$task['result'] = 'Не выполнено';
			} else {
				$task['result'] = 'Выполнено';
			}
		}

		if (isset($_POST['change_status'])) {
			$this->changeTaskStatus();
		}

		return $tasks;
	}

	protected function pos() {
		if (isset($_GET['page'])) {
			$page = abs((int)$_GET['page']);
			if ($page < 1) $page = 1;
		} else $page = 1;
		$count_tasks = $this->m->count_tasks();
		$pages_count = ceil($count_tasks / $this->perpage);
		if (empty($pages_count)) $pages_count = 1;
		if ($page > $pages_count) $page = $pages_count;
		$res['start_pos'] = ($page - 1) * $this->perpage;
		$res['page'] = $page;
		$res['pages_count'] = $pages_count;
		return $res;
	}

	private function changeTaskStatus() {
		$task_id = trim((int)$_POST['task_id']);

		if ($_POST['done'] == 'yes') {
			$status = 1;
		} else $status = 0;
		$this->m->change_task_status($task_id, $status);
		header('Location: /');
	}
}