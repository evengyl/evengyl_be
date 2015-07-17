<?php

if(isset($_GET['confirm_delete_data']))
{
	$var ="*";
	$from = $_GET['table_selected'];
	$where = 'id='.$_GET['id'];
	$res_fx = $all_query->select_simple($var, $from, $where, $order = '', $type ='object');
	paragraphe_style('Fonction Delete Row');

	render_tab($res_fx);?>
	<div class='row col-lg-12'>
		<div class='col-lg-offset-5 col-lg-2'>
			<div class="btn-group" role="group">
				<a href="?nav=manage_bsd&action=delete_complete&table_selected=<?php echo $from?>&<?php echo $where?>"><button type="button" class="btn btn-danger"><span style='font-size:30px;' class='glyphicon glyphicon-remove'></span></button></a>
			</div>		
		</div>
	</div><?
}	
if(isset($_GET['action']))
{
	if($_GET['action'] == 'delete_complete')
	{		
		$where = 'id ='.$_GET['id'];
	    $all_query->delete_row($_GET['table_selected'], $where);
	    paragraphe_style('Ligne Effacée');
	    paragraphe_style('Vous allez être redirigé...');
	    ?><script>					     				
			function return_after(){
				document.location.href="javascript:history.go(-4)";
			}
			setTimeout(return_after,1500);    				
		</script><?php
	}		
}

?>