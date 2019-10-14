<?php
defined('TASKS') or die('Access Denied');

class edit extends Controller {

  public function get_content() {
    if (isset($_SESSION['auth']['admin'])) {
      $task_id = (int)$_GET['task_id'];
      $task_text = $this->m->get_task_data($task_id)['text'];

      if (isset($_POST['update_task'])) {
        $new_task_text = trim(htmlspecialchars(strip_tags($_POST['task_text'])));
        if ($task_text !== $new_task_text) {
          $task_id = (int)$_GET['task_id'];
          if ($this->m->update_task_text($task_text, $task_id)) {
            $_SESSION['status'] = 'Вы обновили текст задачи #' . $task_id;
            header('Location: /');
          } else {
            $_SESSION['error'] = 'Произошла ошибка обновления текста задачи';
          }
        } else {
          header('Location: /');
        }
      }
      return $task_text;
    } else {
      header('Location: /?view=login');
    }
  }
}