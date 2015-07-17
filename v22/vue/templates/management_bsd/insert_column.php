<?php
if($_GET['action'] == 'add_new_column')
{

	$afficher_form = 1;

	if($afficher_form == 1)
	{
		paragraphe_style('Fonction Add column to '.$_GET['table_selected']);?>
		<div class='contenu_compte'>
			<div class="row">
					<div class="col-lg-12">
					<form class="form-inline" style="margin:auto;" role="form" action="?nav=manage_bsd&action=add_new_column&table_selected=<?php echo $_GET['table_selected']?>" method="POST">
						<div class="form-group has-success" style="margin-right:30px;">
							<div class="input-group">
								<div style="width: 200px;" class="input-group-addon"><?php echo $_GET['table_selected'] ?></div>
									<input style='width:450px;' type="text" class="form-control" name="lines">
								</div>
							</div> 
							<button style="width: 650px; margin-top:15px;" type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div><?php
		$afficher_form = 0;
	}

	if(isset($_POST['lines']))
	{
		$table = $_GET['table_selected'];
		$lines_name = $_POST['lines'];
		$all_query->add_new_column($table, $lines_name);
		return_by_js('-4');
	}
}

?>