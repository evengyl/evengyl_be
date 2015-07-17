<?php
function button_table_modif()
{?>
	<div class='row col-xs-12 col-sm-12 col-md-12 col-lg-12'>
		<div class='col-xs-2 col-sm-2 col-md-4 col-lg-4' style="margin-bottom:15px;">
			<div class="btn-group" role="group">
				<a href="?nav=manage_bsd&action=insert_new_data&table_selected=<?php echo $_GET['table_selected']; ?>">
					<button type="button" class="btn btn-success">
						<span style='font-size:16px;' class='glyphicon glyphicon-plus'>Ajouter une Ligne</span>
					</button>
				</a>
			</div>		
		</div>
		<div class='col-xs-2 col-sm-2 col-md-4 col-lg-4' style="margin-bottom:15px;">
			<div class="btn-group" role="group">
				<a href="?nav=manage_bsd&action=add_new_column&table_selected=<?php echo $_GET['table_selected']; ?>">
					<button type="button" class="btn btn-success">
						<span style='font-size:16px;' class='glyphicon glyphicon-plus'>Ajouter une Colonne</span>
					</button>
				</a>
			</div>		
		</div>
		<div class='col-xs-2 col-sm-2 col-md-4 col-lg-4' style="margin-bottom:15px;">
			<div class="btn-group" role="group">
				<a href="?nav=intranet&nav_intra=manage_bsd&nav_intra_action=drop_column&table=<?php echo $_GET['table']; ?>">
					<button type="button" class="btn btn-danger">
						<span style='font-size:16px;' class='glyphicon glyphicon-plus'>Supprimer une Colonne</span>
					</button>
				</a>
			</div>		
		</div>
	</div><?php
}



// mtn que les table sont listée , view data s'occupe de liste les élément de la table sélectionnée

if(isset($_GET['table_selected']))
{
	$table_selected = (string)$_GET['table_selected'];
	htmlspecialchars($table_selected);
	$_db_connect->set_base();
	$res_fx = $all_query->select_simple($var = '*', $table_selected, $where = '',$order='ORDER BY id' ,$type_return='object');
	echo '<br><br>';	
	paragraphe_style('Choisisser une option');
	button_table_modif();
		//affiche les boutton de sélection des tables 
	if(count($res_fx) <= 0)
	{
		paragraphe_style('Aucune ligne dans la table');
	}
	else
	{?>
		<table class="table-bordered table" style="background:white;">
			<tr><?php	
				$view_th = 1;

				foreach ($res_fx as $key => $value) // affiche la ligne des nom de colonnes sur le tableau
				{	
					if($view_th == 1)
					{
						foreach($value as $th => $values)
						{
							echo '<th>'.ucfirst($th).'</th>';
						}
						$view_th = 0;
					}							
				}?>
				<th>Modifications</th>
			</tr>
			<?php
				foreach ($res_fx as $key => $value) // affiche la ligne des nom de colonnes sur le tableau
				{	
					echo '<tr>';
						foreach($value as $td => $values)
						{
							echo '<td>'.html_entity_decode(ucfirst($values)).'</td>';											
						}?>	
						<td>					
							<a style="margin-left:15px; text-decoration:none;" 
							href="?nav=manage_bsd&update_data&id=<?php echo $value->id ?>&table_selected=<?php echo $_GET['table_selected'];?>">
								<span style='font-size:24px;' class="glyphicon glyphicon-pencil"></span>
							</a>
							<a style="margin-left:15px; text-decoration:none;" 
							href="?nav=manage_bsd&confirm_delete_data&id=<?php echo $value->id ?>&table_selected=<?php echo $_GET['table_selected'];?>">
								<span style='font-size:24px;' class="glyphicon glyphicon-remove"></span>
							</a>
						</td>
					</tr><?php								
				}?>			
		</table><?php
	}
}
else
{
	echo '<br><br>';
	paragraphe_style('Veuillez Selectionner une table');
}