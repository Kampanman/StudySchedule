<?php
  session_start();
  require_once('../classes/UserLogic.php');
  // エラーメッセージ
  $err = [];
  
  $token = filter_input(INPUT_POST, 'csrf_token');
  //トークンが存在しない、もしくは一致しない場合は、処理を中止する。
  if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
      exit('不正なリクエスト');
  }
  //二重送信対策
  unset($_SESSION['csrf_token']);

  // バリデーション
  if(!$username = filter_input(INPUT_POST, 'username')){
    $err[] = 'ユーザー名を記入して下さい。';
  }
  if(!$email = filter_input(INPUT_POST, 'email')){
    $err[] = 'メールアドレスを記入して下さい。';
  }
  $password = filter_input(INPUT_POST, 'password');
  // 正規表現を使う
  if(!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)){
    $err[] = 'パスワードは英数字8文字以上100文字以下にして下さい。';
  }
  $password_conf = filter_input(INPUT_POST, 'password_conf');
  if($password !== $password_conf){
    $err[] = '確認用パスワードと異なっています。';
  }

  if(count($err) === 0){
    // ユーザー登録処理
    $hasCreated = UserLogic::createUser($_POST);
    if(!$hasCreated){
      $err[] = '登録に失敗しました。';
    }
  }

  $theme = 'ユーザー登録';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $theme; ?>完了画面</title>
</head>
<body>
  <?php if(count($err) > 0): ?>
    <?php foreach($err as $e): ?>
      <p><?= $e; ?></p>
    <?php endforeach ?>
  <?php else: ?>
    <p><?= $theme; ?>が完了しました。</p>
  <?php endif ?>
  <a href="signup_form.php" style="text-decoration: none;"><button>戻る</button></a>
</body>
</html>
