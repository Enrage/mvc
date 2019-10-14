<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= config::TEMPLATE ?>css/styles.css">
  <title>Приложение Список задач</title>
</head>

<body>
  <div class="wrapper">

    <div class="auth_section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php if ($_SESSION['auth']['admin'] === 'admin'): ?>
            <div class="logout"><a href="/?view=logout">Выйти</a></div>
            <?php else: ?>
              <?php if (!isset($_GET['view']) || isset($_GET['view']) && $_GET['view'] != 'login'): ?>
              <div class="login"><a href="/?view=login">Авторизоваться</a></div>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>