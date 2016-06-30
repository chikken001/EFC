<section>
<?php 
if(!empty($agenda))
{
?>
    <aside>
    <?php 
    echo $agenda['date'] ;
    ?>
    </aside>

    <div class="agenda">
      <h2><?php echo $agenda['title'] ; ?></h2>
      <p class="p-agenda"><?php echo $agenda['message'] ; ?></p>
    </div>
<?php 
}
else
{
	echo $empty ;
}
?>
</section>