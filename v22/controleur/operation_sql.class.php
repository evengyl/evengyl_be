<?php


class operation_sql extends _db_connect
{
	public $_query_all;
	public $mois;
	public $ctx;


	public function __construct(){
		$this->ctx = (object)array();
	}

	public function query_select_depense()
	{		
		$req_sql = "SELECT * FROM somme_total ORDER BY mois DESC";
		$tmp_res = array();
		while($row = $this->fetch_object($req_sql))
		{
			$row->depenses = array();
			$row->total_depenses = 0;
			$tmp_res[$row->id] = $row;
		}	
		
		$req_sql ="SELECT * FROM depenses ORDER BY id DESC";

		while($row = $this->fetch_object($req_sql))
		{
			$tmp_res[$row->parent_id]->total_depenses += $row->depense;
			$tmp_res[$row->parent_id]->depenses[$row->id] = $row;
		}		
		// permet que le tableau d'objet déjà créer soit remis dans un tableau avec les clé , les année de res_fx
		$new_res_fx = array();
		foreach($tmp_res as $row)
		{
			
			if(!isset($new_res_fx[$row->annee]))
			{
				$new_res_fx[$row->annee] = array();
			}
			$new_res_fx[$row->annee][$row->mois] = $row;
		}

		unset($tmp_res);	

		$new_res_fx = render_mois($new_res_fx , $type_of_render = 'int_to_txt');

		$new_res_fx_temp = $new_res_fx;

		
		return $new_res_fx;
	}
	public function ajout_depenses($ctx)
	{		

		$annee = $ctx->annee;
		$mois_in_int = render_mois($ctx->mois, $type_of_return = 'txt_to_int'); // return un mois envoyer en lettre par un int correspondant

		$req_sql = 'SELECT id FROM somme_total WHERE mois='.(int)$mois_in_int.' AND annee='.(int)$annee;	
		
		$res_obj = $this->fetch_object($req_sql);	//return un objet ou la requete à été faite	
		
		if (is_object($res_obj))
			$parent_id = $res_obj->id;
		else
		{
			$req_sql = 'INSERT INTO somme_total (salaire,mois,annee) VALUES (0, '.(int)$mois_in_int.', '.(int)$annee.')';
			$this->query($req_sql);
			$parent_id = $this->get_last_insert_id();
		}
		
		$commentaire = $ctx->commentaire;
		$montant = $ctx->montant;
			
		
		$req_sql = "INSERT INTO depenses (parent_id, depense, commentaire)
					VALUES (".$parent_id.", ".$montant.", '".$this->escape_string($commentaire)."')";
					
		$this->query($req_sql);	
		 
	}
	
}


?>