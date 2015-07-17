
<?php

if(isset($_GET['update_data']))
{	

	paragraphe_style('Veuillez Noter les modifications ajoutées');
	paragraphe_style('La ligne choisie');

	$where = 'id ='.$_GET['id'];					
	$from = $_GET['table_selected'];
	$var = '*';


	$res_fx = $all_query->select_simple($var, $from, $where, $order ='', $type='object');

	render_tab($res_fx);
	paragraphe_style('Formulaire de remplacement');
	render_form_update($res_fx); 
	// ici mettre les verif
	if (!count($res_fx))
	{
		echo 'Error: Record not found nothing to update !';
	}
	else
	{
		$prefix = '';
		$field2update = array();

		foreach($res_fx[0] as $col_name => $value)
		{
			if ($col_name == 'id') 
			{
				continue;
			}
			if (isset($_POST[$prefix.$col_name]) && $_POST[$prefix.$col_name] != $value)
			{
				$field2update[$col_name] = $_POST[$prefix.$col_name];
			}
		}
		if (count($field2update) == 0 && (isset($_POST['post_data'])&&$_POST['post_data']==1))
		{
			echo 'Nothing to update';
		}
		elseif(count($field2update) > 0)
		{
			$ctx_res = new stdClass();
			$ctx_res->table = $_GET['table_selected'];
			$ctx_res->where = 'id ='.(int)$_GET['id'];
			$ctx_res->ctx = $field2update;
			$all_query->update($ctx_res);
		}
		
	}
}




