

<div class="row " style="margin-top:15px;">

	<div class="col-md-12 col-lg-12 content_general">

<?php
// require de base pour mvc



	if(empty($_GET['nav']))
	{
		$_GET['nav'] = "home";
	}
	if(empty($_GET['nav_intra']))
	{
		$_GET['nav_intra'] = "home";
	}
			if(!isset($_GET['nav']))
			{
				
			}
			else
			{			
				$action = $_GET['nav'];
				

				if($action == 'intranet')
				{
					$security->require_on_lvl('intranet.php', 3);
				}
				else if($action == 'finances')
				{
					$security->require_on_lvl('finances.php', 3);
				}
				else if($action == 'rapport_adwords')
				{
					$security->require_on_lvl('afficher_adwords.php', 2);
				}
								
				else if($action == 'ajout_depense')
				{
					$traitement_post_depenses->verif_post_add_depenses();
					require('ajout_depense.php');
				}
				else if(($action == 'ajouter_php') || ($action == 'ajouter_js'))
				{
					$traitement_post_ticket->verif_post_add_ticket($action);

					if($action == 'ajouter_js')
						$security->require_on_lvl('ajout_ticket_js.php', 1);
					if($action == 'ajouter_php')
						$security->require_on_lvl('ajout_ticket_php.php', 1);
				}
				else if($action == 'ajout_adwords')
				{				
					$traitement_post_adwords->verif_post_add_adwords();
					$security->require_on_lvl('ajout_adwords.php', 3);
				}
				else if($action == 'connect')
				{
					require('connect.php');
					$traitement_post_connect->verif_post_connect($_POST);

				}
				else if($action == 'disconnect')
				{
					session_destroy();
					unset($security);
					?>
					<SCRIPT LANGUAGE="JavaScript">
	     				document.location.href="../../" 
					</SCRIPT>
					<?php
				}

				else if($action == 'update_form')
				{					
					$traitement_post_update->verif_post_update();					
					$security->require_on_lvl('update.php', 3);
				}


				else if($action == 'delete_into_table')
				{
					
					$where = 'id="'.$_GET['id'].'"';
					$table = $_GET['table'];
					$all_query->delete_row($table, $where);
					if($table == 'compte')
					{					
					?>
						<SCRIPT LANGUAGE="JavaScript">
	 						document.location.href="javascript:history.go(-1)" 
						</SCRIPT>				
					<?php
					}
				}
				else if($action == 'aff_php')
				{				
					echo'tata';
					$security->require_on_lvl('afficher_php.php', 2);
				}
				else if($action == 'ajouter_matos')
				{
					$security->require_on_lvl('operation_ajouter_matos.php', 3);
				}
				else if($action == 'manage_bsd')
				{
					require_once 'management_bsd/manage_bsd.php';
				}				
			}?>		
	</div>
</div>
			

