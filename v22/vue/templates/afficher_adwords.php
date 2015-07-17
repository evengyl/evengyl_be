<div>
	<p style="font-size:17px; padding:10px; text-align:center;" class="bg-success">Ceci est un rapport non d&eacutetaill&eacute des Campagne Adwords , n'oublier de remplir le tableau &agrave; partir du menu "ajouter rapport"</p>
	<table class='table-render table-hover table table-bordered table-child'>
		<tr>
			<th width='10%'>Date</th>
			<th width='8%'>Clics</th>
			<th width='15%'>Impression</th>
			<th width='14%'>Rentabilit&eacute</th>
			<th width='14%'>Cout Moyens par clic</th>
			<th width='15%'>Cout totale de la journ&eacutee</th>
			<th width='14%'>Position moyenne</th>
			<th width='10%'>Evolution journalière en taux de clics</th>
			<?php echo ($_SESSION['level_user'] == '3')?'<th>Modification</th>':''; ?>
		</tr>
		<?php 
		$row = $all_query->select_simple($var='*', $from='adwords', $where='', $order='ORDER BY id ASC', $type_return='object');

		$temp_clics = 0;
		$sumClics=0;
		$sumImp=0;
		$sumTot=0;
		$compteur_row = 0;
		$sumMoyen = 0;
		$sumPos = 0;
		$sumRent = 0;
		 // se serait int�ressant de recup le tableau et inverser toute les entrer mais les affiche quand meme dans le bon ordre
		// ne pas oublier que ce templates est appeler par le nav qui est appaler du home donc les entr�e se font sur le dossier index
		foreach($row as $key =>$rows)
		{
			
			if($temp_clics == 0)
			{
				$evol = 'First Printed date';
			}
			else if($temp_clics <= $rows->clics)
			{
				$evol = '<img src="'.$_SESSION['version'].'/vue/images/icon_v.png">&nbsp;Up';
			}
			else 
			{
				$evol = '<img src="'.$_SESSION['version'].'/vue/images/icon_x.gif">&nbsp;Down';
			}

			?>	

			<tr>
				<td><p><?php echo $rows->date; ?></p></td>
				<td><p><?php echo $rows->clics; ?></p></td>
				<td><p><?php echo $rows->impression; ?></p></td>
				<td><p><?php echo $rows->rentabilite; ?>&nbsp; %</p></td>
				<td><p><?php echo $rows->cout_moyen; ?>&nbsp; €</p></td>
				<td><p><?php echo $rows->cout_total; ?>&nbsp; €</p></td>
				<td><p><?php echo $rows->pos_moyenne; ?></p></td>
				<td><p><?php echo $evol; ?></p></td>
				<?php echo ($_SESSION['level_user'] == '3')?'<td>
																<a href="?nav=update_form&id='.$rows->id.'&table='.$from.'"><span class="glyphicon glyphicon-refresh"></span></a>								
																<a href="?nav=delete_into_table&id='.$rows->id.'&table='.$from.'"><span class="glyphicon glyphicon-trash"></span></a>
															</td>':''; ?>
			</tr>	
			<?php 
			$temp_clics = $rows->clics;
			$compteur_row ++;
			$sumClics += $rows->clics;
			$sumImp += $rows->impression;
			$sumTot += $rows->cout_total;
			$sumMoyen += $rows->cout_moyen;
			$sumPos += $rows->pos_moyenne;
			$sumRent += $rows->rentabilite;
		}
			$sumMoyen = $sumMoyen/$compteur_row;
			$sumPos = $sumPos/$compteur_row;
			$sumRent = $sumRent/$compteur_row;
		?>
	</table>

	<table class='table-render table-hover table table-bordered'>
	<tr>
		<th width='10%'>Date</th>
		<th width='8%'>Total Clics</th>
		<th width='15%'>Total Impression</th>
		<th width='14%'>Rentabilit&eacute</th>
		<th width='14%'>Cout Moyens par clic</th>
		<th width='15%'>Cout totale de la Campagne</th>
		<th width='14%'>totale Position moyenne</th>
		<th width='10%'>Evolution journalière en taux de clics</th>
	</tr>
	
	<tr>
		<td><p>-</p></td>
		<td><p><?php echo $sumClics; ?></p></td>
		<td><p><?php echo $sumImp; ?></p></td>
		<td><p><?php echo number_format($sumRent, 2, ',', ' '); ?>&nbsp; %</p></td>
		<td><p><?php echo number_format($sumMoyen, 2, ',', ' '); ?>&nbsp; €</p></td>
		<td><p><?php echo $sumTot; ?>&nbsp; €</p></td>
		<td><p><?php echo number_format($sumPos, 1, ',', ' '); ?></p></td>
		<td><p>-</td>
	</tr>
</div>
