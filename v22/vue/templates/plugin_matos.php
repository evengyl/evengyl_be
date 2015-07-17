<?php
	paragraphe_style('page en cours de dev');
?>
<div class="row" style="margin-bottom:15px;">
	<div class="col-lg-6 col-lg-offset-3">
		<a href="?nav=intranet&nav_intra=matos&nav_matos=afficher" style='color:white;'><button type="button" class="btn btn-primary">Afficher</button></a>
		<a href="?nav=ajouter_matos" style='color:white;'><button type="button" class="btn btn-primary">Ajouter</button></a>
		<a href="?nav=intranet&nav_intra=matos&nav_matos=editer" style='color:white;'><button type="button" class="btn btn-primary">Editer</button></a>
	</div>
</div>

<!-- partie Affichage -->
<div class="row">
<?php

if(isset($_GET['nav_matos']))
{

	if($_GET['nav_matos'] == 'afficher')
	{
		$res_fx = $all_query->select_simple($var='*', $from='materiel_category', $where='', $order='', $type_return='object');

		foreach($res_fx as $key => $value)
		{
			?>
			<a href="?nav=intranet&nav_intra=matos&nav_matos=afficher_article&id_categ=<?php echo $value->id;?>&name_categ=<?php echo $value->category; ?>">
				<div class="col-lg-4" style="margin-bottom:15px;">
					<div class="col-lg-12 without-padding" style="background:#BFBFBF; box-shadow:3px 3px 8px black;">
						<?php paragraphe_style($value->category); ?>			
						<p style="text-align:center;"><img src="<?php echo $_db_connect->get_version()."/vue/images/images_category/".$value->lien_img; ?>" width="150" height="150"></p>
					</div>
				</div>
			</a>
			<?php
		}

	}
	else if($_GET['nav_matos'] == 'afficher_article')
	{
		if(isset($_GET['id_categ']))
		{
			paragraphe_style('Id de la catégorie : '.$_GET['id_categ']);
			paragraphe_style('Nom de la catégorie : '.$_GET['name_categ']);
			$where = 'id='.$_GET['id_categ'];
			$res_fx = $all_query->select_simple($var='*', $from='materiel_liste', $where, $order='', $type_return='object');
			foreach($res_fx as $key => $value)
			{?>				
				<div class="col-lg-4" style="margin-bottom:15px;">
					<div class="col-lg-12 without-padding" style="background:#BFBFBF; box-shadow:3px 3px 8px black;"><?php
						foreach($value as $key_2 => $value_2)
						{
							if(($key_2 == 'id_category') || ($key_2 == 'id'))
							{
								continue;
							}
							else
							{
								paragraphe_style($key_2.' : '.$value_2);	
							}
							

						}?>			
					</div>
				</div><?php				
			}
		}
	}
	else if($_GET['nav_matos'] == 'editer')
	{

	}
}


?>
	
</div>
<!-- -->


<!-- partie ajouter  -->


<!-- -->



<!-- partie editer -->


<!-- -->

