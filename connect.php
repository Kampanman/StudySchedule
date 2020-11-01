<?php

$dsn = 'localhost';  //ホスト名を入力して下さい。
$username = 'root';  //ユーザーネームを入力して下さい。
$password = '';  //パスワードを入力して下さい（ない場合は入力不要）。
$dbname = 'crud'; //データベースサーバー名を入力して下さい。

/*
$dsn = 'localhost';  //ホスト名を入力して下さい。
$username = 'root';  //ユーザーネームを入力して下さい。
$password = '';  //パスワードを入力して下さい（ない場合は入力不要）。
$dbname = 'crud'; //データベースサーバー名を入力して下さい。
*/

$connect = mysqli_connect($dsn,$username,$password,$dbname);
/* これが、index,edit,deleteに出てきた第一引数$connectの正体だった */