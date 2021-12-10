<?php
    // 97,122   /a-z/
    // 48, 57   /0-9/
    // 65,90    /A-Z/
    //chr($int);  =>str
    //ord($str);  =>int
    
    
    /**
     * 1.英文大小寫及數字的組合
     * 2.每次產生的字串在4-8之間
     * 3.每次產生的排序順序不固定
     */
    $len =rand(4,7);
    $str = "";
    for($i=0;$i<$len;$i++){
        $type = rand(1,3);

        switch($type){
           case 1:
               $str = $str.chr(rand(48,57));
           break;
           case 2:
               $str =$str.chr(rand(65,90));
           break;
           case 3:
               $str =$str.chr(rand(97,122));
           break;
        }
    }
    echo $str;
    $dstimg =imagecreatetruecolor(200,50);
    $white =  imagecolorallocate($dstimg, 255, 255, 255);
    $black =  imagecolorallocate($dstimg, 0, 0, 0);
    imagefill($dstimg, 0 ,0,$white);
    for($i=0;$i<$len;$i++){
        $c =$str[$i];
         imagestring($dstimg,5,($i*rand(18,20)+10),(10+rand(0,10)),$c,$black);
    }



    imagejpeg($dstimg,'captcha.png');
?>
<img src="./captcha.png" alt="">