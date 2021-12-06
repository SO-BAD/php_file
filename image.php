<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文字檔案匯入</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 class="header">圖形處理練習</h1>
    <!---建立檔案上傳機制--->

    <form action="./image.php" method="post" enctype="multipart/form-data">
        <input type="checkbox" name ="checkbox"id="checkbox"><label for="checkbox">是否要邊框</label>
        <br>
        <select name="rate" id="">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="4">4</option>
            <option value="0.5">0.5</option>
            <option value="0.25">0.25</option>
        </select>
        <p><input type="file" name="img"></p>
        <p><input type="submit" value="上傳"></p>
    </form>
    <?php
    /****
     * 1.建立資料庫及資料表
     * 2.建立上傳圖案機制
     * 3.取得圖檔資源
     * 4.進行圖形處理
     *   ->圖形縮放
     *   ->圖形加邊框
     *   ->圖形驗證碼
     * 5.輸出檔案
     */
    if (isset($_FILES['img']['tmp_name'])) {

        move_uploaded_file($_FILES['img']['tmp_name'], "images/" . $_FILES['img']['name']);
        echo "<img src='images/{$_FILES['img']['name']}'>";
        switch ($_FILES['img']['type']) {
            case "image/jpeg";
                $subname = ".jpg";
                $srcimg = imagecreatefromjpeg("images/" . $_FILES['img']['name']);
            break;
            case "image/png";
                $subname = ".png";
                $srcimg = imagecreatefrompng("images/" . $_FILES['img']['name']);
            break;
            case "image/gif";
                $subname = ".gif";
                $srcimg = imagecreatefromgif("images/" . $_FILES['img']['name']);
            break;
            case "image/bmp";
                $subname = ".bmp";
                $srcimg = imagecreatefrombmp("images/" . $_FILES['img']['name']);
            break;
        }
        $info = getimagesize('images/'.$_FILES['img']['name']);
        $scleRate = $_POST['rate'];
        
        
        $dwidth = $info[0] *$scleRate;
        $dheight =$info[1] *$scleRate;
        $border = (isset($_POST['checkbox']))?ceil(($dwidth*0.1)/2):0;
        
        $inner_w=$dwidth -($border*2);
        $inner_h=$dheight -($border*2);


        $dstimg =imagecreatetruecolor($dwidth,$dheight);


        $white =  imagecolorallocate($dstimg, 255, 255, 255);
        imagefill($dstimg, 0 ,0,$white);
        imagecopyresampled($dstimg,$srcimg,$border,$border,0,0,$inner_w,$inner_h,700,465);
        $name = 'images/'.explode(".",$_FILES['img']['name'])[0]."_small".$subname;
        imagejpeg($dstimg,$name);

        
        echo "<img src='{$name}'>";
    }


    ?>
    <!----縮放圖形----->


    <!----圖形加邊框----->


    <!----產生圖形驗證碼----->



</body>

</html>