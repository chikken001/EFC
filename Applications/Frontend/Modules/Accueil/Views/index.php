<main>
	<!-- Features -->
	<div class="wrapper">

			<section id="main-landing-element">
					<h2>MINI TITRE</h2>
					<h1>GROS TITRE</h1>
					<p class="undertitle">paragraphe d'illustration des mini et gros titre</p>
					<a class="boutton-contact">
						<span>NOUS CONTACTER</span>
					</a>
			</section>

			<section class="catch-elements">
					<div id="black-block">
						<h2></h2>
						<ul class="social-icons">
								<li><img src="url_linkedin"/></li>
								<li><img src="url_tweet"/></li>
								<li><img src="url_googplus"/></li>
						</ul>
					</div>
					<article id="mini-prez-1">
							<figure class="underlayer">
									<img src=""/>
									<figcaption></figcaption>
							</figure>
							<em>.02</em>
							<h2></h2>
							<p></p>
							<a class="boutton-continuer">
								<span>CONTINUER</span>
							</a>
					</article>
			</section>

			<section id="article-sample">
			<?php 
				foreach($articles as $id_article => $article)
				{
			  		echo '
		    			<div class="item-article">
					    	<img src="'.$article['picture'].'"/>
					    	<h3>'.$article['title'].'</h3>
							<p>'.$article['message'].'</p>
			      			<a href="/article/'.$id_article.'">En savoir plus</a>
		    			</div>
				    ';
			 	 }
			 ?>
			</section>

	</div>

</main>
