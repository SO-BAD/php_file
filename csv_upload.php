<?php
    if(!empty($_FILES['csv']['tmp_name'])){
        $filename = md5(time());
        $subname = explode(".",$_FILES['csv']['name'])[1];

        $newFileName = $filename.".".$subname;

        echo "new=>".$newFileName."<br>";
        echo "tmp_name=>".$_FILES['csv']['tmp_name']."<br>";
        echo "fileOrignName=>".$_FILES['csv']['name']."<br>";
        echo "fileType=>".$_FILES['csv']['type'] ."<br>";
        echo "fileSize=>".$_FILES['csv']['size']."<br>";
        
        
        
        move_uploaded_file($_FILES['csv']['tmp_name'],"file/".$newFileName);
        
        // echo "<a href='file/{$newFileName}'>{$_FILES['csv']['name']}</a>";

        if($subname == 'txt' || $subname =="csv"){
            saveToDB("file/".$newFileName);
        }
    }

    function saveToDB($file){
        
        echo "得到檔案".$file."<br>";
        echo "準備進行資料處理作業..........<br>";

        $dsn = "mysql:host=localhost;charset=utf8;dbname=file_upload";
        $pdo = new PDO($dsn,'root','');

        
        
        $resource = fopen($file,'r+');
        $first = 0;
        while(!feof($resource)){
            $str = explode(",",fgets($resource));
            if(is_numeric($str[0]) && count($str)==4){
                $sql ="INSERT INTO `users` (`name`,`gender`,`status`) VALUES ('{$str[1]}','{$str[2]}','{$str[3]}')";
                $pdo->exec($sql);
                $first++;
            }
        }
        fclose($resource);
        echo ($first >0)?"共寫入".($first-1)."筆資料":"";
    }
?>