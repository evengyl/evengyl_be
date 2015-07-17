
<?php	

//appel la fonction qui recupere les infos demandée , renvoi un objet de type stdClass
		$all_depenses = $operation_sql->query_select_depense();
		
		
		
		
//âppel la fonction ajout depenses juste pour afficher en print r l'objet 
		echo "<div class='content_finance' style='padding:15px;'>";
		foreach($all_depenses as $annee=> $depenses_annee)
		{	
			echo "<div class='annee'>";
				echo "<p>Année : ".$annee."</p>";
				
					foreach($depenses_annee as $depenses_mois)
					{						
						echo "<div style='padding:10px;' class='mois'>";
							echo "<p style='float:left;'>Mois : ".$depenses_mois->mois."</p>";
							echo "<p style='float:right;'>D&eacutepenses Total : ".$depenses_mois->total_depenses."</p>";
							echo "<div style='clear:both;' class='salaire'>";
								echo '<p>Salaire : '.$depenses_mois->salaire.'</p>';

								echo "<table class='table-render table-hover table table-bordered'>";
									echo '<th>Dépenses</th>';
									echo '<th>Commentaires</th>';							
										foreach($depenses_mois->depenses as $depense)
										{
											echo '<tr>';
												echo '<td style="width:50%;"><span style="margin-left:200px;">'.$depense->depense.'  €</span></td>';
												echo '<td style="width:50%;"><span style="margin-left:30%;">'.$depense->commentaire.'</span></td>';
											echo'</tr>';											
										}
								echo "</table>";
							echo '</div>';
						echo "</div>";
					}
				echo "</div>";
			echo "</div>";					
		}
		
?>
