<div class="add_task">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="/">Назад</a>
        <h1 class="page_title">Добавление новой задачи</h1>

        <?php if (isset($_SESSION['error'])): ?>
          <div class="text-danger"><?= $_SESSION['error'] ?></div>
          <?php unset($_SESSION['error']) ?>
        <?php endif; ?>

        <form action="" method="post" class="form-vertical">
          <div class="control-group">
            <label for="user_name" class="control-label">Введите имя:</label>
            <div class="controls">
              <input type="text" name="user_name" id="user_name" value="<?= (isset($_SESSION['user'])) ? $_SESSION['user'] : ''; unset($_SESSION['user']) ?>">
            </div>
          </div>
          <div class="control-group">
            <label for="user_email" class="control-label">Введите email:</label>
            <div class="controls">
              <input type="text" name="user_email" id="user_email" value="<?= (isset($_SESSION['email'])) ? $_SESSION['email'] : ''; unset($_SESSION['email']) ?>">
            </div>
            <?php if (isset($_SESSION['error_email'])) : ?>
              <div class="text-danger"><?= $_SESSION['error_email'] ?></div>
              <?php unset($_SESSION['error_email']) ?>
            <?php endif; ?>
          </div>

          <div class="control-group">
            <label for="task_text" class="control-label">Введите текст задачи:</label>
            <div class="controls">
              <textarea name="task_text" id="task_text" cols="30" rows="10"><?= (isset($_SESSION['text'])) ? $_SESSION['text'] : ''; unset($_SESSION['text']) ?></textarea>
            </div>
          </div>

          <div class="controls">
            <input type="submit" value="Добавить" name="save_task" class="btn btn-success" id="save_task">
          </div>
        </form>

      </div>
    </div>
  </div>
</div>