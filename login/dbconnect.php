<?php

require_once('env.php');
/* ↓次の構文があれば具体的に何が原因で接続エラーになっているのかが分かる。 */
ini_set('display_errors',true);
function connect()
{
  $host = DB_HOST;
  $db = DB_NAME;
  $user = DB_USER;
  $pass = DB_PASS;

  $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
  try{
    $pdo = new PDO($dsn,$user,$pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    // echo '接続できました。';
    return $pdo;
  }catch(PDOExeption $e){
    echo '接続できませんでした... '.$e->getMessage();
    exit;
  }

}

//echo connect();