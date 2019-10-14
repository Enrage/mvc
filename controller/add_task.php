<?php
defined('TASKS') or die('Access Denied');

class add_task extends Controller {

  public function get_content() {

    if (isset($_POST['save_task'])) {
      $user = $this->escape($_POST['user_name']);
      $email = $this->escape($_POST['user_email']);
      $text = $this->escape($_POST['task_text']);

      if (empty($user) || empty($email) || empty($text)) {
        $_SESSION['user'] = $user;
        $_SESSION['text'] = $text;
        $_SESSION['email'] = $email;
        $_SESSION['error'] = 'Заполните все поля';
        return false;
      }

      elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['user'] = $user;
        $_SESSION['text'] = $text;
        $_SESSION['error_email'] = 'Email не валиден';
        return false;
      }

      if ($this->m->save_new_task($user, $email, $text)) {
        $_SESSION['status'] = 'Вы успешно добавили новую задачу';
      } else {
        $_SESSION['error'] = 'Ошибка добавления новой задачи';
      }
      header('Location: /');
    }
  }

  private function escape($input) {
    return trim(htmlspecialchars(strip_tags($input)));
  }

}