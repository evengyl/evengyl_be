<?php
##########################################
#	Createur : Evengyl
#	Date de creation : 29-09-2014
#	Version : 1.2
#	Date de modif : 29-10-2014
##########################################

class all_query extends _db_connect
{
	

	public $ctx;
	public $erreur='';

	public function __construct(){
		$this->ctx = (object)array();
	}
	public function select($ctx)
	{
		// faire la fonction simplifée du select sous forme d'objet recu
	}

	public function select_simple($var, $from, $where='', $order='', $type_return='object')
	{	

		if($where != '')
			$req_sql = "SELECT ".$var." FROM ".$from." WHERE ".$where."";		
		else
			$req_sql = "SELECT ".$var." FROM ".$from."";			


		if($order != '')
			$req_sql = $req_sql." ".$order;

		// $security = new security(); // instancie le fichier de securiter 
		// $req_sql = $security->verif_req($req_sql); // return la requète sécurisée !		

		if($type_return == 'object')
		{
			$i = 0;
			while($row = parent::fetch_object($req_sql))
			{
				$res_fx[$i] = $row;
				$i++;
			}
		}
		else if($type_return == 'array')
		{
			$i = 0;
			while($row = parent::fetch_array($req_sql))
			{
				$res_fx[$i] = $row;
				$i++;
			}
		}
		else if($type_return == 'assoc')
		{	
			$i = 0;
			while($row = parent::fetch_assoc($req_sql))
			{
				$res_fx[$i] = $row;
				$i++;
			}
		}
		
		unset($req_sql); //vide le buffer de memoire $req_sql pour liberer de la place 
		if(!isset($res_fx))
			return;
		else 
			return $res_fx;		
	}

	public function insert_into($res_sql) // opérationnel et fonctionnel , reste à tester sur la validation
	{

		$key_all = "";
		$value_all = "";

		$security = new security();

		foreach($res_sql->ctx as $key => $values)
		{
			$values = $security->verif_req($values);
			$key_all = $key_all.", ".$key;
			$value_all = $value_all.", '".$values."'";			
		}

		$key_all = substr($key_all,2);

		if(isset($res_sql->date))
		{
			$key_all = $key_all.", date";
			$value_all = $value_all.", '".$res_sql->date."'";
			$value_all = substr($value_all,2);
			$req_sql = "INSERT INTO ".$res_sql->table." (".$key_all.") VALUES (".$value_all.")";
		}
		else
		{
			$value_all = substr($value_all,2);
			$req_sql = "INSERT INTO ".$res_sql->table." (".$key_all.") VALUES (".$value_all.")";
		}

		parent::query($req_sql);		
		unset($_POST);
		echo '<p style="font-size:17px; padding:10px; text-align:center;" class="bg-success">Ligne Ajoutée !</p>';
		$this->erreur = "Ligne Ajoutée !";
		
	}


	public function add_new_column($table, $lines_name)
	{
			$req_sql_create_column = "ALTER TABLE ".$table." ADD ".$lines_name." VARCHAR(255) NOT NULL";
			parent::query($req_sql_create_column);	
	}



	public function update($ctx) // en test et evolution
	{	

		$security = new security();
		$set_all = "";
		foreach($ctx->ctx as $key => $values)
		{
			$values = $security->verif_req($values);
			$set_all = $set_all.', '.$key.' = "'.$values.'"';
		}
		$set_all = substr($set_all,2);
		$where = $ctx->where;

		$req_sql = 'UPDATE '.$ctx->table.' SET '.$set_all.' WHERE '.$where;

		
		parent::query($req_sql);
		$this->erreur = "Votre Insertion c'est bien déroulée";

	}



	public function delete_row($table, $where)
	{
		$req_sql = "DELETE FROM ".$table." WHERE ".$where;
		parent::query($req_sql);
	}

	public function tri_before_update($ctx)
	{
		$ctx = (object) $ctx;
		if($ctx->table == 'compte')
		{
			if (isset($ctx->id))
			{
				$res_sql_affiche = $this->select_simple($var='*', $from = $ctx->table, $where = 'id = '.$ctx->id, $order='', $type_return='object');
				foreach($res_sql_affiche as $res_fx)
				$res_fx->type = 'before_edit';
				$res_fx->table = $ctx->table;

				if($res_fx->type == 'before_edit')
					{
						require $_SESSION['version'].'/vue/templates/edit_table.php';
						if(!empty($_POST))
						{
							if($_POST['type'] == 'go_to_edit')
							{
								$update = (object) $_POST;
								$update->id = $res_fx->id;
								$update->table = $res_fx->table;
								unset($res_fx);
								$set_var = 'nom="'.$update->nom.'", adresse="'.$update->adresse.'", login="'.$update->login.'", mdp="'.$update->mdp.'"';
								$where = 'id='.$update->id;													
								$this->update($update->table, $set_var, $where);
							}
						}
					}
								
			}
			else 
				return;
		}
		else 
			return;
	}

}

?>