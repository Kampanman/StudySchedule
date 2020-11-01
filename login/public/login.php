<?php
  /**
   * 先にsession_start();を記述することで、
   * セッションを有効にした状態で
   * 「require_once」を適用させる事が出来る。
   */
  session_start();
  require_once('../classes/UserLogic.php');

  // エラーメッセージ
  $err = [];

  // バリデーション
  if(!$email = filter_input(INPUT_POST, 'email')){
    $err['email'] = 'メールアドレスを記入して下さい。';
  }
  if(!$password = filter_input(INPUT_POST, 'password')){
    $err['password'] = 'パスワードを記入して下さい。';
  };


  if(count($err) > 0){
    // エラーがあった場合は戻す
    $_SESSION = $err;
    header('Location: login_form.php');
    return; /* 戻る際に処理を止める */
  }
  // ログイン成功時の処理
  $result = UserLogic::login($email, $password);
  // ログイン失敗時の処理
  if(!$result){
    header('Location: login.php');
    return; /* 戻る際に処理を止める */
  }

  $theme = 'ログイン';
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
  <title><?= $theme; ?>完了</title>
</head>
<body>
<div class="container">
  <h2><?= $theme; ?>完了</h2>
  <br>
  <p><b><?= $theme; ?>しました。</b></p>
  <div class="col-sm-8">
    <a href="../scheduleAdmin/scheduleAdmin.php" style="text-decoration: none;"><button class="btn btn-danger btn-block">学習スケジュール管理ページへ</button></a>
  </div>
</div>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
</body>
</html>
