<?php
session_start();
require_once('config.php');

  $id = $_GET["id"];
  $result = mysqli_query($connect, "DELETE FROM $table_1 WHERE id=$id");
  header("location:scheduleAdmin.php"); /* どこのファイルにするか */




?>