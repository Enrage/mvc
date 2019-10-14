<div class="auth">
  <div class="container">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <h1 class="page_title">Авторизация</h1>

        <form action="" method="post" class="form-vertical" autocomplete="off">
          <div class="control-group">
            <label for="login" class="control-label">Введите имя пользователя:</label>
            <div class="controls">
              <input type="text" name="login" id="login" autocomplete="off" placeholder="">
            </div>
          </div>
          <div class="control-group">
            <label for="password" class="control-label">Введите пароль:</label>
            <div class="controls">
              <input type="password" name="password" id="password" autocomplete="off" placeholder="">
            </div>
          </div>

          <?php if (isset($_SESSION['auth']['error'])): ?>
            <div class="text-danger"><?= $_SESSION['auth']['error'] ?></div>
            <?php unset($_SESSION['auth']['error']) ?>
          <?php endif; ?>

          <div class="controls">
            <input type="submit" value="Войти" name="enter" class="btn btn-success" id="enter">
          </div>
        </form>

      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
</div>