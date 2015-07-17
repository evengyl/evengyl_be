
<p style="font-size:17px; padding:10px; text-align:center;" class="bg-success">Liste des tickets &eacutecrit pour les notes PHP</p>
<table class='table-render table-hover table table-bordered'>
	<tr>
		<th style="width:10%;">Date</th>
		<th style="width:80%;">Notes</th>
		<th style="width:10%;">Modification</th>
	</tr>
	<?php
	$res_fx = $all_query->select_simple($var='*', $from='ticket_php', $where='', $order='ORDER BY id DESC', $type_return='object');
		

		
		foreach($res_fx as $key => $values)
		{
		?>		
			<tr>
				<td><p><?php echo html($values->date); ?></p></td>		
				<td><p><?php echo html($values->commentaire); ?></p></td>
				<td><p>
						<?php 
							if($_SESSION['level_user'] == '3')
							{
								echo "&nbsp;&nbsp;<a href='?nav=update_form&id=".$values->id."&table=".$from."'><span class='glyphicon glyphicon-refresh'></span></a>&nbsp;&nbsp;";
								
								echo "<a href='?nav=delete_into_table&id=".$values->id."&table=".$from."'><span class='glyphicon glyphicon-trash'></span></a>";
							}
							else
								echo '';
						?>
					</p></td>
			</tr>		
		<?php 
			
		}
	?>
</table>


