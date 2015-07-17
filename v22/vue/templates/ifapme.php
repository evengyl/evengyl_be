
<?php
if($_GET['nav_intra'] == 'ifapme')
{	
 	$occu = new stdClass();
  	$occu->html = 'Html 5';
  	$occu->css = 'Css et Mq';
  	$occu->js = 'JavaScript';
  	$occu->php = 'Php & Sql';
  	foreach($occu as $key => $values)
  	{?>

  		<div class="col-lg-6">	  		
			<div class='row col-lg-12'>
				<p style="text-align:center;">
					<a href="?nav_intra=tutos_choix_<?php echo $key; ?>">
						<img style='margin-left:auto;' width="200px" height="200px" src='<?php echo $version; ?>/vue/images/tuto-<?php echo $key; ?>.png'>
					</a>
				</p>
			</div>			
		</div>
		<div class="col-lg-6">			
			<div class='row col-lg-12'>
				<p style="text-align:center;">
					<a href="?nav_intra=liens_choix_<?php echo $key; ?>">
						<img style='margin-left:auto;' width="200px" height="200px" src='<?php echo $version; ?>/vue/images/liens-<?php echo $key; ?>.png'>
					</a>
				</p>
			</div>			
		</div>
		<?php
  	}
}
else if($_GET['nav_intra'] == 'ajout_tuto_ifapme')
{?>
	<div class="row">
  <div class="col-lg-5 col-lg-offset-4">
	<p style="font-size:17px; padding:10px; text-align:center;" class="bg-success">Pour ajouter les Tutos</p>
		<form class="form-inline" style="margin:auto;" role="form" action="" method="POST">
		
				  <div class="form-group" style="margin-right:30px;">
				    <div class="input-group">
				      <div style="width: 100px;" class="input-group-addon">Type sos ou lr</div>
				      <input type="text" class="form-control" name="type" placeholder="SOS ou LR">
				    </div>
				  </div>
				  <br>
				  <div class="form-group" style="margin-right:30px;">
				    <div class="input-group">
				      <div style="width: 100px;" class="input-group-addon">language</div>
				      <input class="form-control" name="language" placeholder="Language">
				    </div>
				  </div>
				  <br>
				  <div class="form-group" style="margin-right:30px;">
				    <div class="input-group">
				      <div style="width: 100px;" class="input-group-addon">titre</div>
				      <input type="text" class="form-control" name="titre" placeholder="Titre">
				    </div>
				  </div>
				  <br>
				  <div class="form-group" style="margin-right:30px;">
				    <div class="input-group">
				      <div style="width: 100px;" class="input-group-addon">text</div>
				      
				      <textarea class="form-control" class="form-control" name="text" placeholder="Impression" rows="3"></textarea>
				    </div>
				  </div>
				  <br>
				  <input type="hidden" name="action" value="ajout_tuto_ifapme">
				  <button style="width: 296px;" type="submit" class="btn btn-default">Submit</button>
				  
		</form>
	</div>
</div>
	 <?php 	

}
else 
{
	
	if(strstr($_GET['nav_intra'], 'tutos_'))
	{
		$where = str_replace('tutos_choix_', '', $_GET['nav_intra']);
		$type = "sos";
		$res_fx = $all_query->select_simple($var = '*', $from = 'ifapme', $whereREQ = 'language = "'.$where.'" AND type = "'.$type.'"', $order='ORDER BY id DESC', $type_return='object');
		if(!empty($res_fx))
		{
			foreach($res_fx as $row)
			{
				rendu_tutos_ifapme($row->text, $row->title, $where); // dans le fichier FCT.php controlleur
			}
		}
		else 
			echo "<p style='font-size:17px; padding:10px; text-align:center;' class='bg-success'>Il n'y actuellement aucuns tutos Pour ".$where." !</p>";
	}
	else if(strstr($_GET['nav_intra'], 'liens_'))
	{
 		$where = str_replace('liens_choix_', '', $_GET['nav_intra']);
 		$type = "lr";
		$res_fx = $all_query->select_simple($var = '*', $from = 'ifapme', $whereREQ = 'language = "'.$where.'" AND type = "'.$type.'"', $order='ORDER BY id DESC', $type_return='object');

		if(!empty($res_fx))
		{
			foreach($res_fx as $row)
			{
				rendu_liens_ifapme($row->text, $row->title, $where); // dans le fichier FCT.php controlleur
			}
		}
		else 
			echo "<p style='font-size:17px; padding:10px; text-align:center;' class='bg-success'>Il n'y actuellement liens intéressant tutos Pour ".$where." !</p>";
	}
	
}




?>
