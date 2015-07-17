<?php
/*
public function select_simple($var, $from, $where='', $order='', $type_return='object') 

// la fonction si dessus a pour but de préparer les requete de type select simple , avec le controle de sécurité des données ext
// en sois même appel les fonction parente de requete fetchée
// retourne le resutat des requete sql sous la forme désirée appelée
// elle demande en paramettre , 
			$var : la liste des variable a selectionnée sous la forme d'un string $var = 'id, login, foo'
			$from : le nom de la table à toucher sous la forme d'un string , $from = 'liste_foo'
			$where : la condition de retour sur where sous la forme d'une string , $where= 'foo = '.$foo;
			$order : le choix pour la sortie de la requete dans quelle ordre sous la forme d'un string  : $order = "ORDER BY DESC"
																										  $order = "ORDER BY $var"
			$type_return : laisse le choix sous forme de string de la valeur de retour de la requete , object assoc array

*/
/*
	La fonction insert into attend un objet contenant la table [table], un context avec comme [ctx] étant aussi un objet , les porpriété de cet objet portant
	le nom des champs et la valeurs de ses porpiétés , la valeur des champs comme ceci [ctx] => champ1 = "blabla"
																								champ2 = "balbla"
	si il y a une date à rentrer de type date alors ajouter un objet de type date dans la requete comme ça [date] = date('Y-m-d')

	La fonction Update fonctionne de la meme maniere , envoi d'un objet avec [table] , [where] sous la forme d'un string , id = 45 ; par ewxemple 
			envoi également d'un objet [ctx] avec les propriétés et valeur représantant les SET Values

	La fonction paragraphe_style revois un élement de type string pour en faire un titre vers a la bootstrap renvoi le rendu en direct
	la fonction render_tab , renvoi directement le rendu sous forme de tableau TH TD ou les clé sont les th et les td sont toute les lignes
	render_form_update recoi un objet de select_simple et génère le formulaire d'update , donc forcément ne recois q'une donnée sql , pour la modifier en UPDATE
	
*/

?>