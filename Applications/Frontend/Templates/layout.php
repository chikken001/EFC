<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title><?php if (!isset($title)) { echo'EFC' ;} else { echo $title; } ?></title>
        <meta name="description" content="EFC">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Aujean Thomas">

        <!-- CSS -->
        <link rel="stylesheet" href="/Web/css/style.css">

        <!-- Favicon -->
        <link rel="icon" href="/Web/img/favicon.ico">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   		<script> window.jQuery || document.write('<script src="/Web/js/jquery-1.11.3.min.js"><\/script>')</script>
    </head>
    <body>

        <header>
          <nav>
              <ul class="menu">
                  <li id="article">
                      <a href="">ARTICLE</a>
                  </li>
                  <li id="apropos">
                      <a href="">A PROPOS</a>
                  </li>
                  <li id="agenda">
                      <a href="">AGENDA</a>
                  </li>
                  <li id="contact">
                      <a href="">CONTACT</a>
                  </li>
              </ul>
          </nav>
		    </header>

        <!-- Content -->
        <?php
	    if ($user->hasFlash()) echo'<div>'.$user->getFlash().'</div>';
	    echo $content;
	    ?>

        <!-- Footer -->
        <footer class="footer" role="contentinfo">
            <div class="container">
                <p class="copyright">&copy; <?php echo date("Y"); ?> EFC, tous droits réservés</p>
            </div>
        </footer>

        <!-- Scripts
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <script src="/Web/js/script.js"></script>
    </body>
</html>
