<?php

if($_GET['nav'] == 'manage_bsd')
{

	if(!isset($_GET['table_selected']))
	{
		paragraphe_style("Veuillez Selectionner la Base De Données sur laquelle travailler");
		require_once 'select_db.php';    
		listing_bsd_for_manage();
		//on séléctionne la base de données à utiliser quand on arrive sur le manage bsd
		//la fonction listening bsd permet d'afficher les base et en auto reload la déléctionne pour afficher les données
		// la sélection de la base passe par le POST
		if(isset($_POST['db_name']))		
			$_SESSION['db_name'] = $_POST['db_name'];
		// on récupère le nom de la base choisie en SESSION on sais jamais 
		require('select_table.php');
		// et mtn on utilise cette db_name pour afficher la liste des tables avec un count dessus
	}
	if(isset($_GET['update_data']))
	{
		require('update_data.php');
	}
	if(isset($_GET['confirm_delete_data']))
	{
		require('delete_data.php');
	}
	if(isset($_GET['action']) == 'delete_complete')
	{
		require('delete_data.php');
	}
	if(isset($_GET['action']) == 'insert_new_data')
	{
		require('insert_data.php');
	}
	if(isset($_GET['action']) == 'add_new_column')
	{
		require('insert_column.php');
	}
	
}


if(isset($_GET['select_table']))
{

	if(isset($_GET['table_selected']))
	{
		require_once 'view_lines_table.php';
	}
}


//correct
