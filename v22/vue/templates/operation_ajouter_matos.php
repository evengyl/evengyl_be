<?php

	$res_fx = $all_query->select_simple($var='*', $from='materiel_category', $where='', $order='', $type_return='object');

foreach($res_fx as $key => $value)
{
	?>
	<a href="?nav=ajouter_matos&option_matos=<?php echo $value->id;?>"><button type="button" style="width:150px; margin:0 15px 15px 0;" class="btn btn-primary"><?php echo $value->category; ?></button></a>
	<?php
}


if(isset($_GET['option_matos']))
{
	$where = 'id_category='.$_GET['option_matos'];
	$list_champ = $all_query->select_simple($var='*', $from='materiel_liste', $where, $order='ORDER BY id', $type_return='object');

?>
	<div class='contenu_compte'>
		<div class="row">
				<div class="col-lg-12">
				<form class="form-inline" style="margin:auto;" role="form" action="" method="POST">
					<br><?php
						foreach($list_champ as $key => $value)
						{		
							foreach($value as $key_2 => $value_2)
							{?>		
							
								<div class="form-group 
										<?php 
											if(($key_2 == 'id') || ($key_2 ==  'id_category')) 
												echo  'has-error'; 
											else 
												echo 'has-success';
											?>" style="margin-right:30px;">

								    <div class="input-group">
								      	<div style="width: 200px;" class="input-group-addon"><?php echo $key_2 ?></div>
										<input style='width:450px;' type="text"
											<?php echo ($key_2 == 'id')? 'disabled id="disabledInput"':'id="inputSuccess1"'; ?>
											<?php echo ($key_2 == 'id_category')? 'disabled id="disabledInput" placeholder="'.$value_2.'"':'id="inputSuccess1"'; ?> 
											 class="form-control" name="<?php echo $key_2 ?>">

								    </div>
								</div> 
								<br><?php											
							}										
						}?>													
								
								<button style="width: 650px; margin-top:15px;" type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
	</div>
<?php

}
affiche_pre($_POST);


?>


<script>
	var champ = $('<input>');
	champ.attr('type', 'text');
	champ.attr('name', 'nom_du_nouveau_champ');
	champ.appendTo('form');
</script>