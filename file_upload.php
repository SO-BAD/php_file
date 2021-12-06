<?php
    if(!empty($_FILES['file']['tmp_name'])){
        $filename = md5(time());
        $subname = explode(".",$_FILES['file']['name'])[1];

        $newFileName = $filename.".".$subname;

        echo "new=>".$newFileName."<br>";
        echo "tmp_name=>".$_FILES['file']['tmp_name']."<br>";
        echo "fileOrignName=>".$_FILES['file']['name']."<br>";
        echo "fileType=>".$_FILES['file']['type'] ."<br>";
        echo "fileSize=>".$_FILES['file']['size']."<br>";
        move_uploaded_file($_FILES['file']['tmp_name'],"file/".$newFileName);
    }

?>