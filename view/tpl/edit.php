<div class="auth">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h2 class="page_title">Редактировать текст задачи</h2>
        <form action="" method="post" class="form-vertical">
          <textarea name="task_text" id="task_text"><?= $content ?></textarea>

          <?php if (isset($_SESSION['auth']['error'])): ?>
            <div class="text-danger"><?= $_SESSION['auth']['error'] ?></div>
            <?php unset($_SESSION['auth']['error']) ?>
          <?php endif; ?>

          <div class="controls">
            <input type="submit" value="Сохранить" name="update_task" class="btn btn-success" id="update_task">
          </div>
        </form>

      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
</div>