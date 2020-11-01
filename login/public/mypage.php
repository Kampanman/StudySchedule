<?php
  session_start();
  require_once('../classes/UserLogic.php');
  require_once('../functions.php');
  
  //ログインしていなければ新規登録画面へ移す
  $result = UserLogic::checkLogin();
  
  if(!$result){
      $_SESSION['login_err'] = 'ユーザーを登録してログインして下さい。';
      header('Location: signup_form.php');
      return;
  }
  
  $login_user = $_SESSION['login_user'];

  $theme = 'マイページ';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $theme; ?></title>
</head>
<body>
  <h2><?= $theme; ?></h2>
  <p>ログインユーザー：<?= h($login_user['name']); ?></p>
  <p>メールアドレス：<?= h($login_user['email']); ?></p>
  <a href="./login.php" style="text-decoration: none;"><button>ログアウト</button></a>
</body>
</html>
