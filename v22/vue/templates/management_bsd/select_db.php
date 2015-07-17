<?php


function listing_bsd_for_manage()
{

	$sql="SHOW DATABASES";
	$link_test = mysqli_connect('localhost' , 'root' , 'darkevengyl');

	$test = mysqli_query($link_test, $sql);
	$i='0';
	$res_fx = array();
	while($row = mysqli_fetch_object($test))
	{
		$res_fx[$i] = $row;		    
	    $i++;
	}
	foreach($res_fx as $row => $values)
	{		
		foreach($values as $row )
		{
			$new_res_fx[$row] = $row;
		}
	}
	unset($new_res_fx['information_schema']);
	unset($new_res_fx['phpmyadmin']);
	unset($new_res_fx['mysql']);
	unset($new_res_fx['performance_schema']);
	unset($new_res_fx['cdcol']);
	unset($new_res_fx['webauth']);?>
	
	<div class="col-lg-12">
		<div class="col-lg-offset-3 col-lg-6">
			<form method="post" action="?nav=manage_bsd"><?php				
				foreach($new_res_fx as $values)
				{?>
					 <div class="checkbox-inline">
						<label>
						    <input name='db_name' onchange="this.form.submit()" type="checkbox" value='<?php echo $values; ?>'>
						    <?php echo $values; ?>
						</label>
					</div><?php					
				}?>				
			</form>
		</div>
	</div><?php
}


?>