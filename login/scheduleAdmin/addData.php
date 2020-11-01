<?php 
session_start();
require_once("config.php");
?>
<?php
    if(isset($_POST["submit"]))
    { /* 下のname="submit"のボタンを押すと次のSQL処理が為される */
    	//post all value
    	extract($_POST);
    	$query = "INSERT INTO $table_1 (`name`, `type`, `1st`, `2nd`, `3rd`, `4th`, `5th`) VALUES ('".$name."', '".$type."', '".$first."', '".$second."', '".$third."', '".$fourth."', '".$fifth."' );";
    	/* idが「Auto Increment」になっている為、SQL構文の中に入れてしまう（値にNULLを指定する等）とエラーになるぞ！ */

    	mysqli_query($connect,$query); /* $connectの中に$queryのデータを格納する */
    	header("location:scheduleAdmin.php"); /* 終了後にどこのファイルに遷移するか */
    }

?>

<html>
<head>
	<title><?= $theme.'登録';?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <style>
        .form-inline {
            border-radius: 5px;
            padding-left: 5px;
            background-color: #EEEEEE;
        }
        .info:hover{
            cursor: pointer;
            color: blue;
            font-weight: 600;
        }
    </style>
</head>

<body onload="start()">
	<div class="container" style="">
	<div class="row">
    <h3><?= $theme.'登録フォーム';?></h3>
    <h4><b style="color: red;"></b></h4>
	<div class="container"> 
    	<p><a href="scheduleAdmin.php?=data-list" class="btn btn-info"><?= $theme; ?>参照</a></p><br>

			<p>
				<button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
					検索テーブルを開く／検索テーブルを閉じる
				</button>
			</p>
			
    	<!-- アコーディオンエリア -->
    	<div class="collapse container" id="collapseExample">
            <div class="row col-sm-5">
              <table id="example" class="display table table-striped" style="">
                <thead>
                  <tr>
                      <th>#</th>
                      <th>Title</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  /**
                   * データテーブルによるnameカラム検索機能
                   */
                      require_once("config.php");
                      $query ="SELECT DISTINCT name FROM $table_1 ORDER BY name ASC";
                      $sql = mysqli_query($connect,$query);
                      while($row = mysqli_fetch_array($sql))
                      {
    
                  ?>
                  <tr>
                    <td><input type="hidden" value="<?php echo $row["id"];?>"></td>
                    <td><span class="info"><?php echo $row["name"];?></span></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
    	</div>
    	<!-- アコーディオンエリアここまで -->
        <br>
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
                  <label>教材名（＆範囲） </label><input type="text" class="form-control" name="name" id="name" placeholder="教材名（＆範囲）を入力して下さい。" required>
                  <br>
                  <p><label>隔日タイプ </label>　<input type="text" class="form-inline" name="type" id="type" value="type_1" readonly></p>
                  <p><label>1回目学習日</label>　<input type="text" class="form-inline" name="first" id="take_1" readonly></p>
                  <p><label>2回目学習日</label>　<input type="text" class="form-inline" name="second" id="take_2" readonly></p>
                  <p><label>3回目学習日</label>　<input type="text" class="form-inline" name="third" id="take_3" readonly></p>
                  <p><label>4回目学習日</label>　<input type="text" class="form-inline" name="fourth" id="take_4" readonly></p>
                  <p><label>5回目学習日</label>　<input type="text" class="form-inline" name="fifth" id="take_5" readonly></p>
                <p align="center"><input type="submit" name="submit" class="btn btn-info" value="これで登録する"></p>
            </form>
        </div>
    </div>
    </div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $('#example').DataTable({
        "language" : {"url":"any.json"},
        "initComplete" : function(settings, json) {
        		this.xxxApi().doAnythng();//ここで処理する
        }
    });
</script>
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

      var take_1 = dtDayInto;
      var fm_take_1 = `${take_1.getFullYear()}/${take_1.getMonth()+1}/${take_1.getDate()}`.replace(/\n|\r/g, ''); //日付を文字列の形に変換

      var take_2 = dtDayInto.setDate(dtDayInto.getDate() + 1); //取得した現在の日付（dtDayInto）に1日足したもの
      var take_2 = new Date(take_2); //これを数字の羅列から日付に変換
      var fm_take_2 = `${take_2.getFullYear()}/${take_2.getMonth()+1}/${take_2.getDate()}`.replace(/\n|\r/g, ''); //日付を文字列の形に変換

      var take_3 = dtDayInto.setDate(dtDayInto.getDate() + 4);
      var take_3 = new Date(take_3);
      var fm_take_3 = `${take_3.getFullYear()}/${take_3.getMonth()+1}/${take_3.getDate()}`.replace(/\n|\r/g, '');

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
            var take_4 = dtDayInto.setDate(dtDayInto.getDate() + 8);
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

        } else {
            var type_4_text = $("#type_4").val();
            $("#type").val(type_4_text);
            var take_4 = dtDayInto.setDate(dtDayInto.getDate() + 9);
            var take_4 = new Date(take_4);
            var fm_take_4 = `${take_4.getFullYear()}/${take_4.getMonth()+1}/${take_4.getDate()}`.replace(/\n|\r/g, '');

            var take_5 = dtDayInto.setDate(dtDayInto.getDate() + 17);
            var take_5 = new Date(take_5);
            var fm_take_5 = `${take_5.getFullYear()}/${take_5.getMonth()+1}/${take_5.getDate()}`.replace(/\n|\r/g, '');

            $("#take_1").val(fm_take_1);
            $("#take_2").val(fm_take_2);
            $("#take_3").val(fm_take_3);
            $("#take_4").val(fm_take_4);
            $("#take_5").val(fm_take_5);

        }

    }

  $(".info").click(function(){
    var val = $(this).text();
    console.log(val);
    $("#name").val(val);
  });

</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

</body>
</html>

