<!DOCTYPE html>
<html lang="en">

    <head>
       <!-- Meta-->
       <meta charset="utf-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
       <meta name="description" content="">
       <meta name="keywords" content="">
       <meta name="author" content="">
       
       <title><?php if (!isset($title)) { echo'EFC Admin' ;} else { echo $title; } ?></title>
       
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
       <script> window.jQuery || document.write('<script src="/Web/js/jquery-1.11.3.min.js"><\/script>')</script>

       <link rel="stylesheet" href="/Web/css/style.css">
       
    </head>

    <body>
        <header>
        <div>
            <?php
                if ($user->isAdmin()){
                    echo'<span class="user-block-name item-text">Bienvenue, '.$user->getAttribute('nom').'</span>' ;
                }
                else 
                {
                    echo'<span class="user-block-name item-text">Administration</span>' ;
                }
            ?>
        </div>
       <section>
        <?php 
            if ($user->hasFlash()) echo'<div>'.$user->getFlash().'</div>';
            echo $content; 
        ?> 
       </section>
       <script src="/Web/js/script.js"></script>
    </body>
    
</html>
