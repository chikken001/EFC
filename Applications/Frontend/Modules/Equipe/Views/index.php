<div id="bloc-navi-theme">
  <ul id="navi-theme">
    <li class="theme">*
      <svg><!--icone--></svg>
      <h4>L'EQUIPE</h4>
      <p></p>
    </li>
    <li class="theme">
      <svg><!--icone--></svg>
      <h4>MISSIONS</h4>
      <p></p>
    </li>
    <li class="theme">
      <svg><!--icone--></svg>
      <h4>DONNEES</h4>
      <p></p>
    </li>

</div>

<section id="members-trombinoscope">
	<?php 
		foreach($team as $category)
		{
			echo '<div class="category">
  					<h1>'.$category['name'].'</h1>' ;
			
			foreach($category['members'] as $member)
			{
				echo '<div class="member">
    					<img src="'.$member['picture'].'" alt="" />
    					<h2>'.$member['prenom'].' '.$member['nom'].'</h2>' ;
      				  
				foreach($member['jobs'] as $job)
				{
					echo '<p>'.$job.'</p>' ;
				}
				
				echo '</div>' ;	
			}
			
			echo '</div>' ;
		}
	?>
</section>

<section id="guest-trombinoscope">
  <div class="trombibox"></div>
</section>
