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
                            <p>
                                <b>【共通】</b><br>
                                ・1st: 学習初日　2nd: 学習初日の翌日　3rd: 2ndの4日後（学習初日の5日後）<br><br>
                                <b>【Type_1】</b><br>
                                ・4th: 3rdの8日後（学習初日の13日後） 5th: 4thの15日後（学習初日の28日後）<br><br>
                                <b>【Type_2】</b><br>
                                ・4th: 3rdの8日後（学習初日の13日後） 5th: 4thの16日後（学習初日の29日後）<br><br>
                                <b>【Type_3】</b><br>
                                ・4th: 3rdの9日後（学習初日の14日後） 5th: 4thの15日後（学習初日の30日後）<br><br>
                                <b>【Type_4】</b><br>
                                ・4th: 3rdの9日後（学習初日の14日後） 5th: 4thの16日後（学習初日の31日後）<br>
                            </p>
                            <br>
                            <p><b>　Type_1・2のタスクの学習開始日と、Type_3・4のタスクの学習開始日は、それぞれ同日にするとよいでしょう。<br>
                            　また、Type_2とType_3の学習日は中1日、Type_4Type_1の学習日は中3日空けるとよいでしょう。</b></p>
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
                    <label>教材名（＆範囲） </label><input type="text" class="form-control" name="name" id="name" value="<?php echo $name;?>" required>
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

    function input(type){
      var dayInto = $("#dayInto").val();
      var dtDayInto = new Date(dayInto); //#dayIntoに入力された日付を取得

      var take_1 = dtDayInto;
      var fm_take_1 = `${take_1.getFullYear()}/${take_1.getMonth()+1}/${take_1.getDate()}`.replace(/\n|\r/g, ''); //日付を文字列の形に変換

      var take_2 = dtDayInto.setDate(dtDayInto.getDate() + 1); //取得した現在の日付（dtDayInto）に1日足したもの
      var take_2 = new Date(take_2); //これを数字の羅列から日付に変換
      var fm_take_2 = `${take_2.getFullYear()}/${take_2.getMonth()+1}/${take_2.getDate()}`.replace(/\n|\r/g, ''); //日付を文字列の形に変換

      var take_3 = dtDayInto.setDate(dtDayInto.getDate() + 4);
      var take_3 = new Date(take_3);
      var fm_take_3 = `${take_3.getFullYear()}/${take_3.getMonth()+1}/${take_3.getDate()}`.replace(/\n|\r/g, '');

        if(type == 1){

            var type_1_text = $("#type_1").val();
            $("#type").val(type_1_text);
            var take_4 = dtDayInto.setDate(dtDayInto.getDate() + 8);
            var take_4 = new Date(take_4);
            var fm_take_4 = `${take_4.getFullYear()}/${take_4.getMonth()+1}/${take_4.getDate()}`.replace(/\n|\r/g, '');

            var take_5 = dtDayInto.setDate(dtDayInto.getDate() + 15);
            var take_5 = new Date(take_5);
            var fm_take_5 = `${take_5.getFullYear()}/${take_5.getMonth()+1}/${take_5.getDate()}`.replace(/\n|\r/g, '');

            $("#take_1").val(fm_take_1);
            $("#take_2").val(fm_take_2);
            $("#take_3").val(fm_take_3);
            $("#take_4").val(fm_take_4);
            $("#take_5").val(fm_take_5);

        } else if(type == 2) {

            var type_2_text = $("#type_2").val();
            $("#type").val(type_2_text);
            var take_4 = dtDayInto.setDate(dtDayInto.getDate() + 9);
            var take_4 = new Date(take_4);
            var fm_take_4 = `${take_4.getFullYear()}/${take_4.getMonth()+1}/${take_4.getDate()}`.replace(/\n|\r/g, '');

            var take_5 = dtDayInto.setDate(dtDayInto.getDate() + 16);
            var take_5 = new Date(take_5);
            var fm_take_5 = `${take_5.getFullYear()}/${take_5.getMonth()+1}/${take_5.getDate()}`.replace(/\n|\r/g, '');

            $("#take_1").val(fm_take_1);
            $("#take_2").val(fm_take_2);
            $("#take_3").val(fm_take_3);
            $("#take_4").val(fm_take_4);
            $("#take_5").val(fm_take_5);

        } else if(type == 3) {

            var type_3_text = $("#type_3").val();
            $("#type").val(type_3_text);
            var take_4 = dtDayInto.setDate(dtDayInto.getDate() + 8);
            var take_4 = new Date(take_4);
            var fm_take_4 = `${take_4.getFullYear()}/${take_4.getMonth()+1}/${take_4.getDate()}`.replace(/\n|\r/g, '');

            var take_5 = dtDayInto.setDate(dtDayInto.getDate() + 15);
            var take_5 = new Date(take_5);
            var fm_take_5 = `${take_5.getFullYear()}/${take_5.getMonth()+1}/${take_5.getDate()}`.replace(/\n|\r/g, '');

            $("#take_1").val(fm_take_1);
            $("#take_2").val(fm_take_2);
            $("#take_3").val(fm_take_3);
            $("#take_4").val(fm_take_4);
            $("#take_5").val(fm_take_5);

        } else {
            var type_4_text = $("#type_4").val();
            $("#type").val(type_4_text);
            var take_4 = dtDayInto.setDate(dtDayInto.getDate() + 9);
            var take_4 = new Date(take_4);
            var fm_take_4 = `${take_4.getFullYear()}/${take_4.getMonth()+1}/${take_4.getDate()}`.replace(/\n|\r/g, '');

            var take_5 = dtDayInto.setDate(dtDayInto.getDate() + 16);
            var take_5 = new Date(take_5);
            var fm_take_5 = `${take_5.getFullYear()}/${take_5.getMonth()+1}/${take_5.getDate()}`.replace(/\n|\r/g, '');

            $("#take_1").val(fm_take_1);
            $("#take_2").val(fm_take_2);
            $("#take_3").val(fm_take_3);
            $("#take_4").val(fm_take_4);
            $("#take_5").val(fm_take_5);

        }

    }

</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
</body>
</html>

