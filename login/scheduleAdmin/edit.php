<?php
session_start();
require_once('config.php');

if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    /* 入力値は「サニタイズ」（特殊文字の無害化）しておく */
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, "UTF-8");
    $type = htmlspecialchars($_POST['type'], ENT_QUOTES, "UTF-8");
    $first = htmlspecialchars($_POST['first'], ENT_QUOTES, "UTF-8");
    $second = htmlspecialchars($_POST['second'], ENT_QUOTES, "UTF-8");
    $third = htmlspecialchars($_POST['third'], ENT_QUOTES, "UTF-8");
    $fourth = htmlspecialchars($_POST['fourth'], ENT_QUOTES, "UTF-8");
    $fifth = htmlspecialchars($_POST['fifth'], ENT_QUOTES, "UTF-8");
    
    $result = mysqli_query($connect, "UPDATE $table_1 SET name='$name',type='$type',1st='$first',2nd='$second',3rd='$third',4th='$fourth',5th='$fifth' WHERE id=$id");
    header("Location:scheduleAdmin.php"); /* 処理後にどこのファイルに遷移するか */
    
}
?>
<?php
//error_reporting(0);
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($connect, "SELECT * FROM $table_1 WHERE id=$id");
 
while($row = mysqli_fetch_array($result))
{
    $name = $row['name'];
    $type = $row['type'];
    $first = $row['1st'];
    $second = $row['2nd'];
    $third = $row['3rd'];
    $fourth = $row['4th'];
    $fifth = $row['5th'];
}
?>
<html>
<head>
	<title><?= $theme.'編集フォーム';?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <style>
        body { font-family: "Sawarabi Gothic"; }
        .form-inline {
            border-radius: 5px;
            padding-left: 5px;
            background-color: #EEEEEE;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body onload="start()">
	<div class="container" style="width: 800px; margin-top: 100px;">
	    <a href="scheduleAdmin.php?=data-list" class="btn btn-info"><?= $theme; ?>早見表へ</a><br>
		<div class="row">
			<h3><?= $theme.'編集フォーム';?></h3>
			<h4><b style="color: red;"></b></h4>
            <form action="" method="post" class="col-sm-8">
                <p><label for="dayInto">日付を選択して下さい　</label><input type="date" name="dayInto" id="dayInto" min="2020-10-01" required></p>
                <div>
                    <label for="dayInto">日付選択後に必ず下のいずれかを押して下さい　</label><br>
                    <input type="button" id="type_1" class="btn btn-info form-group" value="type_1" onclick="input(1)">
                    <input type="button" id="type_2" class="btn btn-info form-group" value="type_2" onclick="input(2)">
                    <input type="button" id="type_3" class="btn btn-info form-group" value="type_3" onclick="input(3)">
                    <input type="button" id="type_4" class="btn btn-info form-group" value="type_4" onclick="input(4)">
                </div>
                <br>
                <!-- モーダルボタンとモーダル -->
                <p align="right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">Typeについて</button></p>
                <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title" id="label1" align="center"><b>各タイプの隔日間隔</b></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <script src="modalInner.js"></script>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
        	    <!-- モーダルボタンとモーダルここまで -->
                <br>
                    <input type="hidden" name="id" class="form-control" value="<?php echo $id;?>">
                    <label>教材名（＆範囲） </label><input type="text" class="form-control" name="name" id="name" autocomplete="off" value="<?php echo $name;?>" required>
                <br>
                    <p><label>隔日タイプ </label>　<input type="text" class="form-inline" name="type" id="type" value="<?php echo $type;?>" readonly></p>
                    <p><label>1回目学習日</label>　<input type="text" class="form-inline" name="first" id="take_1" value="<?php echo $first;?>" readonly></p>
                    <p><label>2回目学習日</label>　<input type="text" class="form-inline" name="second" id="take_2" value="<?php echo $second;?>" readonly></p>
                    <p><label>3回目学習日</label>　<input type="text" class="form-inline" name="third" id="take_3" value="<?php echo $third;?>" readonly></p>
                    <p><label>4回目学習日</label>　<input type="text" class="form-inline" name="fourth" id="take_4" value="<?php echo $fourth;?>" readonly></p>
                    <p><label>5回目学習日</label>　<input type="text" class="form-inline" name="fifth" id="take_5" value="<?php echo $fifth;?>" readonly></p>
                <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-primary btn-block" name="update">
                </div>
            </form>
		</div>
	</div>
<script>
    function start(){
      // 現在に日付を日付ボックスにセット
      var today = new Date();
      today.setDate(today.getDate());
      var yyyy = today.getFullYear();
      var mm = ("0"+(today.getMonth()+1)).slice(-2);
      var dd = ("0"+today.getDate()).slice(-2);
      var setToday = yyyy+'-'+mm+'-'+dd;
      $("#dayInto").val(setToday);
      
      var dtDayInto = new Date(); //現在の日付を取得
    }
</script>
<script src="inputStudyDays.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
</body>
</html>

