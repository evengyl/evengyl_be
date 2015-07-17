<?php

if($_GET['action'] == 'insert_new_data')
{
		paragraphe_style('Completer les champs d\'insertion');

		$res_fx = $all_query->select_simple($var='COLUMN_NAME', $from = 'INFORMATION_SCHEMA.COLUMNS', $where='table_name="'.$_GET['table_selected'].'"', $order='', $type='object');

		render_tab($res_fx);
		paragraphe_style('Formulaire d\'insertion');

		render_form_insert($res_fx);

		if(isset($_POST) && !empty($_POST))
		{
			$ctx_post = new stdClass();
			$ctx_post->table = $_GET['table_selected'];
			$ctx_post->ctx = $_POST;

			if($_GET['table_selected'] == 'campagnes')
			{
				if(empty($_POST['nom']))
					$_POST['nom'] = 'Non Connue';
				if(empty($_POST['mot']))
					$_POST['mot'] = 'Non Connue';
				if(empty($_POST['date_debut']))
					$_POST['date_debut'] = 'Non Connue';
				if(empty($_POST['date_fin']))
					$_POST['date_fin'] = 'Non Connue';
				if(empty($_POST['clics']))
					$_POST['clics'] = 'Non Connue';
				if(empty($_POST['rentabilite']))
					$_POST['rentabilite'] = 'Non Connue';
				if(empty($_POST['active']))
					$_POST['active'] = 'Non Connue';

			}
			$all_query->insert_into($ctx_post);
		}
}
require 'view_lines_table.php';
?>