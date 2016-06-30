<section id="agenda-landing">
    <h1>GROS TITRE</h1>
    <p class="undertitle">paragraphe d'illustration</p>
</section>

<section id="event-list">
	<?php 
		foreach($agendas as $id_agenda => $agenda)
		{
	  		echo '
    			<div class="item-agenda">
    				<span class="date">'.$agenda['date'].'</span>
			    	<h3>'.$agenda['title'].'</h3>
					<p>'.$agenda['message'].'</p>
	      			<a href="/agenda/'.$id_agenda.'">En savoir plus</a>
    			</div>
		    ';
	 	 }
	 ?>
  <ul class="event-month-item">
    <!--call php-->
    <li class="event-day-item"><!--call php-->
        <a href="">
          <span class="date"><!--call php--></span>
          <h3><!--call php--></h3>
          <p><!--call php--></p>
        </a>
    </li>
  </ul>
</section>
