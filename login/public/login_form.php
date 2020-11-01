<?php
  /* 下記2つでセッションを開始できる */
  session_start();
  $err = $_SESSION;

  $_SESSION = array();
  session_destroy();
  /* 上記2つでセッションをリセットできる */

  $theme_1 = 'ログイン';

  $index_name = 'myStudySchedule';
  
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <style>
        body { font-family: "Sawarabi Gothic"; }
    </style>
  <title><?= $theme_1; ?>画面</title>
</head>
<body>
<div class="container">
  <h2><?= $theme_1; ?>フォーム</h2>
    <?php if(isset($err['msg'])): ?>
      <p><?php echo $err['msg']; ?></p>
    <?php endif; ?>
  <form action="login.php" method="post">
    <p>
      <label for="email">メールアドレス</label><input class="form-control" type="email" name="email" id="email">
      <?php if(isset($err['email'])): ?>
      <p><span style="color:red;"><?php echo $err['email']; ?></span></p>
      <?php endif; ?>
    </p>
    <p>
      <label for="password">パスワード</label><input class="form-control" type="password" name="password" id="password">
      <?php if(isset($err['password'])): ?>
      <p><span style="color:red;"><?php echo $err['password']; ?></span></p>
      <?php endif; ?>
    </p>
    <p><input type="submit" class="btn btn-primary" value="<?= $theme_1; ?>"></p>
  </form>
  <a href="signup_form.php">新規登録はこちらから</a>
</div>
<br>
<p align="center">
    <a href="../../<?= $index_name; ?>.php"><button class="btn btn-lg btn-info"><?= $index_name; ?>へ</button></a>
</p>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
</body>
</html>