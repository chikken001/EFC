<section id="article-landing">
    <h2>MINI TITRE</h2>
    <p class="undertitle">paragraphe d'illustration</p>
</section>

<section id="article-container">
<?php 
if(empty(!$article))
{
?>
    <aside>
    <?php 
    echo '<img src="'.$article['picture'].'" alt="" />' ;
    echo $article['created_at'] ;
    echo $article['author'] ;
    ?>
      <ul>
      </ul>
    </aside>

    <article id="article-top">
      <h2><?php echo $article['title'] ; ?></h2>
      <p class="p-article"><?php echo $article['message'] ; ?></p>
    </article>
	
	<?php 
	foreach($pictures as $picture)
	{
		echo'
    	<figure>
    		<img src="'.$picture.'" alt="" />
        	<figcaption>Légende</figcaption>
    	</figure>';
	}
	
	?>

    <article id="article-bottom">
      <h2></h2>
      <p class="p-article"></p>
    </article>

    <aside>
    <?php 
	    foreach($similars as $similar)
		{
			echo'
	    	<h3>'.$similar['title'].'</h3>	
	    	<p>'.$similar['message'].'</p>	
	    	';
		}
	?>
    </aside>
<?php 
}
else
{
	echo $empty ;
}
?>

</section>

<section id="section-formulaire">
    <form method="post" action="">
      <input type="text" name="expe-mail"></input>
      <textarea name="expe-com"></textarea>
    </form>

</section>
