<main>
	<!-- Features -->
	<div class="wrapper">

			<section id="main-landing-element">
					<h2>ASSOCIATION EFC</h2>
					<h1>L'environnement, au coeur de notre action</h1>
					<p class="undertitle"></p>
					<div class="boutton-contact">
						NOUS CONTACTER
					</div>
			</section>

					<div id="black-block">
						<h2>EGET MOLESTIE LOBORTIS, EST LACUS VEHICULA MAGBNA, VITAE FAUCIBUS EX TUPIS SUT AMEL ELIT PHASELLUS NON PRETIUM LUGULA</h2>
						<ul class="social-icons">
								<li><img src="url_linkedin"/></li>
								<li><img src="url_tweet"/></li>
								<li><img src="url_googplus"/></li>
						</ul>
					</div>

							<div class="underlayer">

							</div>

      <div class="main-center-elements">
        <figcaption>MISSION</figcaption>
              <article class="mini-prez-1">
    							<em>.01</em>
    							<h2>MAURIS SIT AMET GRAVIDA<br/> DONECT PORTA NISI</h2>
    							<p><span>E</span>get molestie lobortis, est lacus vehicula magna,
                    vitae faucibus ex turpis sit amet elit.non,
                    sagittis hendrerit orci.
                    Morbi id euistempor eget ac lectus non premi Fusce a congue nunc.
                    Aenean risus nulla,</p>
    							<a class="boutton-continuer">
    								<span>CONTINUER</span>
    							</a>
					    </article>

			<section id="article-sample">
        <figcaption>ACTUALITES</figcaption>
		
        <div id="box-item-article">
  			<?php
				foreach($articles as $id_article => $article)
				{
					echo '
						<div class="item-article">
							<img src="'.$article['picture'].'">
							<i>
								<a href="/article/'.$id_article.'">></a>
							</i>
							</img>
							<h3>'.$article['title'].'</h3>
							<p>'.$article['message'].'...</p>
						</div>
					';
				 }
			?>
  		</div>
          <!--fin item test-->
        </div>
			</section>

      <section id="agenda-sample">
        <figcaption>AGENDA</figcaption>

        <div id="box-item-agenda">
          <div class="item-agenda-date-top">
            <time>mai</time>
            <time><strong>27</strong></time>
          </div>
          <div class="item-agenda-text-top">
            <h3>EGET MAGNA LOPSEM MOLESTIE</h3>
            <p><span>i</span>n tempor diam. Fusce a congue nunc. Aenean risus nulla</p>
          </div>
          <div class="item-agenda-date">
            <time>mai</time>
            <time><strong>27</strong></time>
          </div>
          <div class="item-agenda-text-top">
            <h3>EGET MAGNA LOPSEM MOLESTIE</h3>
            <p><span>i</span>n tempor diam. Fusce a congue nunc. Aenean risus nulla</p>
          </div>
          <div class="item-agenda-date">
            <time>mai</time>
            <time><strong>27</strong></time>
          </div>
          <div class="item-agenda-text-top">
            <h3>EGET MAGNA LOPSEM MOLESTIE</h3>
            <p><span>i</span>n tempor diam. Fusce a congue nunc. Aenean risus nulla</p>
          </div>
        </div>
      </section>

      <section id="contact-sample">
        <figcaption>CONTACT</figcaption>

        <article class="mini-prez-1">
            <em>.02</em>
            <h2>MAURIS SIT AMET GRAVIDA<br/> DONECT PORTA NISI</h2>
            <p><span>E</span>get molestie lobortis, est lacus vehicula magna,
              vitae faucibus ex turpis sit amet elit.non,
              sagittis hendrerit orci.
              Morbi id euistempor eget ac lectus non premi Fusce a congue nunc.
              Aenean risus nulla,</p>
            <a class="boutton-continuer">
              <span>CONTINUER</span>
            </a>
        </article>

      </section>

      <figcaption id="contact-caption">CONTACT</figcaption>

    </div>

    <div class="underlayer-bis">

    </div>

	</div>

</main>
