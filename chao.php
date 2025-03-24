<div id = "Chao">
        <?php
        
        $h=gmdate("H")+7;
        if($h<=12){
            echo"<span class='sang'> Bay gio la $h gio sang! Chuc mot ngay an lanh</span>";        
        }else{
            echo"<span class='chieu'> Bay gio la $h gio chieu! Chuc ban vui</span>";
        }
        ?>
    </div>