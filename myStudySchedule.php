<?php
    require_once('connect.php');
    /** 
     * PHPでは、<?php echo '〇〇'; ?>と<?= '〇〇'; ?>は同様の意味である。
     * <?= ?>と間違えて<?php (中身にechoつけてない) ?>を使ってしまわないように注意。
     * <?php ?>だけだとドキュメントに値は出力されない。
     * <?= ?>のフィールド内では、文字列（変数に格納している場合も同）どうし、或いは文字列と数値とは、.（ドット）で繋ぐことができる。
     * （これはJavaScriptの「+」にあたる）
    */
    $index_name = 'myStudySchedule';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $index_name; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <style>
        body { 
            font-family: "Sawarabi Gothic";
            background-color: #2196f3;
        }
    </style>
</head>
<body>
<p class="container" align="right">
    <br>
    <a href="./login/public/login_form.php"><button  class="btn btn-dark">ログイン画面へ</button></a>
</p>
<h2 align="center" style="color:yellow; font-weight:bold"><?= $index_name; ?></h2>
<br>

<h3 align="center" style="color:yellow; font-weight:bold">学習スケジュール早見表</h3>
<br>
    <div class="container" style="">
        <div class="row">
            <table id="example" class="display" style="">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Material & Range</th>
                        <th>Type</th>
                        <th>1st</th>
                        <th>2nd</th>
                        <th>3rd</th>
                        <th>4th</th>
                        <th>5th</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query ="SELECT * FROM schedule ORDER BY id DESC";
                        $sql = mysqli_query($connect,$query);
                        while($row = mysqli_fetch_array($sql))
                        {

                    ?>
                    <tr>
                        <td><input type="hidden" value="<?php echo $row["id"];?>"></td>
                        <td><?php echo $row["name"];?></td>
                        <td><?php echo $row["type"];?></td>
                        <td><?php echo $row["1st"];?></td>
                        <td><?php echo $row["2nd"];?></td>
                        <td><?php echo $row["3rd"];?></td>
                        <td><?php echo $row["4th"];?></td>
                        <td><?php echo $row["5th"];?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
            <!-- モーダルボタンとモーダル -->
            <p align="right"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal1">Typeについて</button></p>
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
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
    	    <!-- モーダルボタンとモーダルここまで -->
    	    
        </div>
    </div>

</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="modalInner.js"></script>
<script type="text/javascript">
$('#example').DataTable({
    responsive: true,
    lengthChange: true,
    info: false,
    searching: true,
    paging: true,
    pagingType: "full_numbers",
    lengthMenu: [ 10, 20, 50, 100 ],
    columnDefs: [
        { targets: 0, visible: false }
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Japanese.json"
    }
});
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
</body>
</html>
