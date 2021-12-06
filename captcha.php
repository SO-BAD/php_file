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
?>