<div class="tasks">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="page_title">Список задач</h1>
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <a href="/?view=add_task" class="btn btn-success">Добавить новую задачу</a>
            </div>

            <?php if ($this->m->count_tasks() > 0): ?>
              <div class="col-md-9">
                <span class="bold underline">Сортировать по:</span><br>
                имени (<a href="?sortby=user&sort=asc">возрастанию</a>, <a href="?sortby=user&sort=desc">убыванию</a>) /
                email (<a href="?sortby=email&sort=asc">возрастанию</a>, <a href="?sortby=email&sort=desc">убыванию</a>) /
                статусу (<a href="?sortby=status&sort=asc">возрастанию</a>, <a href="?sortby=status&sort=desc">убыванию</a>)
              </div>
            <?php endif; ?>
          </div>
        </div>

        <?php if (isset($_SESSION['status'])): ?>
          <div class="text-success status"><?= $_SESSION['status'] ?></div>
          <?php unset($_SESSION['status']) ?>
        <?php elseif (isset($_SESSION['error'])): ?>
          <div class="text-danger status"><?= $_SESSION['error'] ?></div>
          <?php unset($_SESSION['error']) ?>
        <?php endif; ?>

        <?php if (count($content) > 0): ?>
          <div class="task_list">
            <?php foreach ($content as $task): ?>
              <div class="task">
                <div class="task_number">Задача №: <span><?= $task['id'] ?></span></div>
                <div class="user_name">Имя пользователя: <span><?= $task['user'] ?></span></div>
                <div class="user_email">Email: <span><?= $task['email'] ?></span></div>
                <div class="task_text">Текст задачи: <span><?= $task['text'] ?></span></div>
                <div class="task_status">Статус:
                  <?php if ($task['status'] == '1'): ?>
                  <span class="text-success"><?= $task['result'] ?></span>
                  <?php else: ?>
                  <span class="text-warning"><?= $task['result'] ?></span>
                  <?php endif; ?>
                </div>
                <?php if ($task['updated'] == '1'): ?>
                <div class="task_status text-primary">отредактировано администратором</div>
                <?php endif; ?>

                <?php if ($_SESSION['auth']['admin']): ?>
                <div class="admin_settings">
                  <a href="/?view=edit&task_id=<?= $task['id'] ?>" class="btn btn-primary edit_task_text">Редактировать текст задачи</a>

                  <div class="done">
                    <form action="" method="post">
                      <label for="done">Выполнено:</label>
                      <input type="checkbox" name="done" id="done" value="yes" <?= ($task['status']) ? 'checked' : '' ?>>
                      <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                      <input type="submit" name="change_status" class="btn btn-success save_status" value="Сохранить статус">
                    </form>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="task_list">Задач еще нет</div>
        <?php endif; ?>

        <div class="pagination">
          <?php if ($this->pos()['pages_count'] > 1) $this->m->pagination($this->pos()['page'], $this->pos()['pages_count']); ?>
        </div>
      </div>
    </div>
  </div>
</div>