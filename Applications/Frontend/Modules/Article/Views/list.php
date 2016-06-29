<section id="main-article-landing">

    <h1>GROS TITRE</h1>
    <p class="undertitle">paragraphe d'illustration</p>

<!-- PARTIE SI DESSOUS A VOIR POUR AJAX SUR LE DEUXIEME FORM-->
    <form method="post" action="">
      <input type="text" name="search"></input>
      <input type="submit" value="Submit">
    </form>

    <form method="post" action="">
    <select>
      <option><!--call thèmes clés des articles-->
    </select>
    <select>
      <option><!--call date Y dans date de parution des articles-->
    </select>
    </form>
<!-- -->

</section>

<section id="liste-container">
<?php 
  
	if(count($articles) > 0)
	{
		foreach($articles as $id_article => $article)
		{
	  		echo '
    			<div>
			    	<img src="'.$article['picture'].'"/>
			    	<h3>'.$article['title'].'</h3>
					<p>'.$article['message'].'</p>
					<p>'.$article['created_at'].' '.$article['author'].'</p>
	      			<a href="/article/'.$id_article.'">En savoir plus</a>
    			</div>
		    ';
	 	 }
  	}
	else
	{
		echo "<p>Il n'y a aucun article à afficher</p>" ;
	}
?>
</section>
