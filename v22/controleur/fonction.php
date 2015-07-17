<?php
##########################################
#	Createur : Evengyl
#	Date de creation : 29-09-2014
#	Version : 1.1
#	Date de modif : 29-10-2014
##########################################

//liste des fonction nécessaire

function affiche_pre($var_a_print)
{
	?><pre><?php print_r($var_a_print); ?></pre><?php
}

function info_php()
{
	echo phpinfo();
}
function paragraphe_style($txt)
{
	echo '<p style="font-size:17px; padding:10px; text-align:center;" class="bg-success">'.$txt.'</p>';
}
function return_by_js($delay)
{
		echo "cette classe n'existe plus!";
}
function render_tab($res_sql_ctx)// attend un objet construit voir DOC
{
	foreach($res_sql_ctx as $key_floor => $values_floor)
	{
		foreach($values_floor as $key => $values)
		{
			$th[] = $key;
			$td[] = $values;
		}
	}

	echo '<table class="table-bordered table" style="background:white;">';
		echo '<tr>';
			foreach ($th as $row)
			{
				echo '<th>'.$row.'</th>';
			}
		echo '</tr>';
		echo '<tr>';
			foreach($td as $row)
			{
				echo '<td>'.$row.'</td>';
			}
		echo '</tr>';
	echo '</table>';
}
function render_form_update($res_sql)
{
?>
	<div class='contenu_compte'>
		<div class="row">
				<div class="col-lg-5 col-lg-offset-4">
				<form class="form-inline" style="margin:auto;" role="form" action="" method="POST">
					<input type='hidden' name='post_data' value='1'>
					<br><?php
						foreach($res_sql as $row)
						{											
							foreach($row as $key => $values)
							{?>											
								<div class="form-group <?php echo ($key == 'id')?'has-error':'has-success'; ?>" style="margin-right:30px;">
								    <div class="input-group">
								      	<div style="width: 50%;" class="input-group-addon"><?php echo $key ?></div>
										<input style='width:450px;' type="text"
											<?php echo ($key == 'id')? 'disabled id="disabledInput"':'id="inputSuccess1"'; ?> class="form-control" name="<?php echo $key ?>" value="<?php echo $values ?>">
								    </div>
								</div>
								<br><?php											
							}										
						}?>													
									
									<button style="width: 296px;" type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
	</div>
<?php
}
function render_form_insert($res_fx)
{?>
	<div class='contenu_compte'>
		<div class="row">
				<div class="col-lg-12">
				<form class="form-inline" style="margin:auto;" role="form" action="" method="POST">
					<br><?php
						foreach($res_fx as $row)
						{											
							foreach($row as $key => $values)
							{?>		
							
								<div class="form-group <?php echo ($values == 'id')?'has-error':'has-success'; ?>" style="margin-right:30px;">
								    <div class="input-group">
								      	<div style="width: 200px;" class="input-group-addon"><?php echo $values ?></div>
										<input style='width:450px;' type="text"
											<?php echo ($values == 'id')? 'disabled id="disabledInput"':'id="inputSuccess1"'; ?> class="form-control" name="<?php echo $values ?>">
								    </div>
								</div> 
								<br><?php											
							}										
						}?>													
									
									<button style="width: 650px; margin-top:15px;" type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
	</div>
<?php
}
function render_form_insert_champ_uniquement($list_champ)
{
	if(!$list_champ)
	{
		paragraphe_style('Erreur cette table ne contient aucun champs');
		return;
	}
	?>
	<div class='contenu_compte'>
		<div class="row">
				<div class="col-lg-12">
				<form class="form-inline" style="margin:auto;" role="form" action="" method="POST">
					<br><?php
						foreach($list_champ as $key => $value)
						{		
							foreach($value as $key_2 => $value_2)
							{?>		
							
								<div class="form-group 
										<?php 
											if(($key_2 == 'id') || ($key_2 ==  'id_category')) 
												echo  'has-error'; 
											else 
												echo 'has-success';
											?>" style="margin-right:30px;">

								    <div class="input-group">
								      	<div style="width: 200px;" class="input-group-addon"><?php echo $key_2 ?></div>
										<input style='width:450px;' type="text"
											<?php echo ($key_2 == 'id')? 'disabled id="disabledInput"':'id="inputSuccess1"'; ?>
											<?php echo ($key_2 == 'id_category')? 'disabled id="disabledInput" placeholder="'.$value_2.'"':'id="inputSuccess1"'; ?> 
											 class="form-control" name="<?php echo $key_2 ?>">

								    </div>
								</div> 
								<br><?php											
							}										
						}?>													
									
								<button style="width: 650px; margin-top:15px;" type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
	</div>
<?php
}
function render_tab_key($array)
{
	foreach($array as $key_floor => $values_floor)
	{
		foreach($values_floor as $key => $values)
		{
			$champ[] = $key;
		}
	}
	return $champ;
}

function cpu_usage()
{
	$buf = file_get_contents('/proc/loadavg');
    $result = explode(' ', $buf, 4);
    // don't need the extra values, only first three
    unset($result[3]);

    $oneM = $result[0];
    $fiveM = $result[1];
    $fiftyM = $result[2];

    $oneM = floatval($oneM)*100;
    $fiveM = floatval($fiveM)*100;
    $fiftyM = floatval($fiftyM)*100;

    ?>
    <table class="table-responsive table table-bordered">
		<tr>
			<th>Server Load Average Last 1 minute</th>

			<th>Server Load Average Last 5 minutes</th>

			<th>Server Load Average Last 15 minutes</th>
		</tr>
		<tr>
			<td><?php echo $oneM."%"; ?></td>

			<td><?php echo $fiveM."%"; ?></td>

			<td><?php echo $fiftyM."%"; ?></td>
		</tr>
	</table>
	<?php
}
function mem_info()
{
	$buf = file_get_contents('/proc/meminfo');
	$buf = preg_replace("(\r\n|\n|\r)",'',$buf);

    $results = explode('kB', $buf);    
    $i = 3;
    while($i < 34)
    {
    	unset($results[$i]);

    	$i++;
    }
    ?>
    <table class="table-responsive table table-bordered">
		<tr>
			<th>Memories Server Infos</th>
		</tr>
		<tr>
			<td><?php echo $results[0]; ?></td>
		</tr>
		<tr>
			<td><?php echo $results[1]; ?></td>
		</tr>
		<tr>
			<td><?php echo $results[2]; ?></td>
		</tr>
	</table>
	<?php    
   
}
function cpu_info()
{
	$buf = file_get_contents('/proc/cpuinfo');
	$buf = preg_replace("(\r\n|\n|\r)",'\n',$buf);	
	$results = explode('\n', $buf);
	unset($results[8]);
	unset($results[10]);
	
    ?>
    <table class="table-responsive table table-bordered">
		<tr>
			<th>Memories Server Infos</th>
		</tr><?php
		foreach($results as $row)
		{
			?>
			<tr>
				<td><?php echo $row; ?></td>
			</tr>
			<?php
		}
		?>
		
	</table>
	<?php    
   
}



function render_eval()
{
	$eval = isset($_POST['eval'])?$_POST['eval']:"";
	
?>
	<form method="post" action="">
		<textarea rows="20" cols="100" name="eval"><?php echo htmlentities($eval) ?></textarea>
		<br>
		<input type="submit" value="eval"/>
	</form>
	<pre><?php eval($eval); ?></pre>
<?php
	
}

function render_mois($ctx , $type_of_render = '')
{
	if($type_of_render == '')
	{
		Echo 'Error in Render_mois Function At Line 122';	
	}
	else if($type_of_render == 'txt_to_int')
	{
		$months = array('1'=>'Janvier', '2'=>'Fevrier', '3'=>'Mars', '4'=>'Avril',
				 '5'=>'Mai', '6'=>'Juin', '7'=>'Juillet', '8'=>'Aout', '9'=>'Septembre', '10'=>'Octobre', '11'=>'Novembre', '12'=>'Decembre');		
		foreach($months as $key => $values)
		{	
			if($ctx == $key)
			{
				return $ctx;
				affiche_pre($ctx);
			}			
		}
	}
	else if($type_of_render == 'int_to_txt')
	{
			$months_txt = array(1=>'janvier', 2=>'Fevrier', 3=>'Mars', 4=>'Avril', 5=>'Mai', 6=>'Juin', 7=>'Juillet', 8=>'Aout', 9=>'Septembre', 10=>'Octobre', 11=>'Novembre', 12=>'Decembre');

			foreach($ctx as $rows)
			{				
				foreach($rows as $row)
				{
					if ($row->mois < 13 && $row->mois > 0) 
					{
						$row->mois = $months_txt[$row->mois];
					}
					else
					{
						$row->mois = 'Mauvais mois['.$row->mois.']';
					}
				}
			}	
			
		return $ctx;
	}	
}

function count_total($depenses_annees)
{	
	$total_depenses_annees = array();
	affiche_pre($depenses_annees);
	foreach ($depenses_annees as $annee => $depenses_annee);
	{
		
		$total_depenses_annees[$annee] = array();
		
		
		// boucle sur les annees et en cree des tableaux 
		foreach($depenses_annee as $mois => $depenses_mois)
		{
			$total_mois = 0;
			foreach($depenses_mois->depenses as $depense){
				$total_mois += $depense->depense;
			}
			$total_depenses_annees[$annee][$mois] = $total_mois;
		}
	}
	affiche_pre($total_depenses_annees);
}

function render_date($jours, $mois, $annee)
{ //verifie la date et le renvoi sous un format 00-00-0000 elle dois être comprise entre 2000 2100

	if(strlen($annee) < 4)
	{
		$annee = '0'.$annee;
	}
	if(strlen($jours) < 2)
	{
		$jours = '0'.$jours;
	}
	if(strlen($mois) < 2)
	{
		$mois = '0'.$mois;
	}
	
	$render_date = $jours."-".$mois."-".$annee;
	return $render_date;
}


function html($txt)
{
	return htmlentities($txt, ENT_COMPAT , 'utf-8');
}
function rendu_tutos_ifapme($text, $title, $type)
{	
	$text = str_replace('*dt*', '<p style="margin-left:15px;">', $text);
	$text = str_replace('*ft*', '</p>', $text);
	$text = str_replace('*dc*', '<pre class="brush: '.$type.'">', $text);
	$text = str_replace('*fc*', '</pre>', $text);
	$text = str_replace('<script>', '&#60;script&#62;', $text);
	$text = str_replace('</script>', '&#60;/script&#62;', $text);
	?>
	<div class='row col-lg-12' style='box-shadow: 5px 2px 8px grey; background:white; height:auto; margin:auto; margin-bottom:15px;  padding:0 0 0 0;'>
		<div style="width:100%; background:#417F85;">
			<p style='font-family:Source Sans Pro; font-size:20px; color:white; padding:5px; text-align:center;'><?php echo ucfirst($title.'.'); ?></p>
		</div>	
			<br>			
				<?php print_r($text); ?>			
		</div>
	<?php
}
function rendu_liens_ifapme($text, $title, $where)
{?>
	<div class='row col-lg-12' style='box-shadow: 5px 2px 8px grey; background:white; height:auto; margin:auto; margin-bottom:15px;  padding:0 0 0 0;'>
		<div style="width:100%; background:#417F85;">
			<p style='font-family:Source Sans Pro; font-size:20px; color:white; padding:5px; text-align:center;'><?php echo ucfirst($title.'.'); ?></p>
		</div>
		<p style='font-family:Source Sans Pro; font-size:20px;  padding:5px; text-align:center;'><a href="<?php echo $text; ?>"><?php echo $text; ?></a></p>
	</div>
<?php	
}

function info_table()
{
	$_db_connect = new _db_connect();
	$base_name = $_db_connect->get_name_base();
	$req_sql = ("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='".$base_name."'");
	while($row = $_db_connect->fetch_object($req_sql))
	{
		unset($row->TABLE_CATALOG);
		unset($row->ENGINE);
		unset($row->VERSION);
		unset($row->AVG_ROW_LENGTH);
		unset($row->INDEX_LENGTH);
		unset($row->DATA_FREE);
		unset($row->CHECK_TIME);
		unset($row->CHECKSUM);
		unset($row->CREATE_OPTIONS);
		unset($row->TABLE_COMMENT);
		affiche_pre($row);
	}
	unset($row);		
	unset($req_sql);
}


?>
