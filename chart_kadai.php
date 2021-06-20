<?php 
include('funcs_kadai.php');

//2. DBに接続
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');//pdoでmysqlに接続してくれる
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }

$realestate_name = '';
$unit_price = '';


//2．データ登録SQL作成
//prepare("")の中にはmysqlのSQLで入力したINSERT文を入れて修正すれば良いイメージ
$stmt = $pdo->prepare("SELECT* FROM gs_bm_table");
$status = $stmt->execute();

//loop through the returned data
while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){

    $realestate_name = $realestate_name . '"'. $r['realestate_name'].'",';
    $unit_price = $unit_price . '"'. $r['unit_price'] .'",';
}

$realestate_name = trim($realestate_name,",");
$unit_price = trim($unit_price,",");




?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>価格比較表</title>
</head>
<body>
    <a class="navbar-brand" href="select_kadai.php">■案件登録画面の表示</a>

    <canvas id="myChart" width="400" height="200"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php echo $realestate_name ?>],//各棒の名前（name)
            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'ほげ'],//各棒の名前（name)
            datasets: [{
                label: '価格比較表（万円/㎡）',
                data: [<?php echo $unit_price ?>],//各縦棒の高さ(値段)
                // data: [12, 19, 3, 5, 2, 20],//各縦棒の高さ(値段)
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
</body>
</html>