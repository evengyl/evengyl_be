<?php
if(isset($_POST['db_name'])) // liste toute les table de la base sélectionnée
{
	$_SESSION['db_name'] = $_POST['db_name'];
		//construction de la requète pour l'affichage de table
	$var = 'TABLE_NAME,TABLE_ROWS ';
	$from = 'INFORMATION_SCHEMA.TABLES ';
	$where = 'TABLE_SCHEMA="'.$_POST['db_name'].'"';
	$type_return='object';
	$table_liste = $all_query->select_simple($var, $from, $where, $order='', $type_return);
	echo '<br><br>';
	paragraphe_style('Listes des Tables Détaillées');?>
	<table class="table-bordered table table-responsive" style="background:white;">
		<tr>
			<th style="width:50%;">Nom de la table</th>
			<th style="width:35%;">Nombre d'élements</th>
			<th style="width:15%;">Modification</th>
		</tr><?php

		foreach($table_liste as $row_object)
		{
			$table_current = $row_object->TABLE_NAME;?>
			
			<tr>				
				<td style="padding-bottom:10px; padding-top:7px; width:50%;">
					<p style="padding-left:15px; font-size:17px; display:inline;"><?php echo $row_object->TABLE_NAME; ?></p></td>
				<td style="padding-bottom:10px; padding-top:10px; width:35%;">
					<p style="padding-left:54px; font-size:17px; display:inline;">Nombre d'entrées : <?php echo $row_object->TABLE_ROWS; ?></p></td>
				<td style="padding-bottom:10px; padding-top:10px; width:15%;">
					<a href="?nav=manage_bsd&select_table&table_selected=<?php echo $table_current ?>" style="font-size:17px; display:block; text-align:center;" >
						<span class="glyphicon glyphicon-sort-by-alphabet"></span>
					</a>
				</td>			
			</tr><?php				
		}?>
	</table><?php
	unset($table_liste);
}

?>