
<a href="?do=0">打0劑</a>
<a href="?do=1">打1劑</a>
<a href="?do=2">打2劑</a>


<?php
$dsn = "mysql:host=localhost;charset=utf8;dbname=file_upload";
$pdo = new PDO($dsn,'root','');


if(isset($_GET['do'])){
    $res = $pdo->query("SELECT * FROM `users`WHERE `status` ='{$_GET['do']}'")->fetchAll(PDO::FETCH_ASSOC);
}else{
    $res = $pdo->query("SELECT * FROM `users`")->fetchAll(PDO::FETCH_ASSOC);
}

echo "<ul>";
//寫入BOM 頭
// fwrite($file,'\xEF\xBB\xBF');

foreach($res as $key =>$data){
    echo "<li>";
    echo $data['num'].",".$data['name'].",".$data['gender'].",".$data['status'];
    echo "</li>";
}
echo "</ul>";

if(file_exists('result.csv')){
?>
<a href="result.csv" download> 下載檔案</a>
<?php }?>

