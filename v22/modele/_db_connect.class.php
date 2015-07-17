<?php

##########################################
#	Createur : Evengyl
#	Date de creation : 29-09-2014
#	Version : 1.1
#	Date de modif : 29-10-2014
##########################################

class _db_connect
{
	private $db_link;	
	private $is_connected = false;
	private $last_res_sql = null;
	private $last_req_sql = null;
	private $base = 'gets_code';

	

	public function get_version()
	{
		global $version;
		return $this->version;
	}

	public function set_version($ver)
	{		
		$this->version = $ver;	
		$_SESSION['version'] = $ver;
	}

	public function set_base()
	{
		if(!isset($_SESSION['db_name']))
		{
			$this->base = 'gets_code';
		}
		$this->base = $_SESSION['db_name'];
	}
	public function connect()
	{

		$hote = "localhost";
		$user = "root";
		$Mpass = "darkevengyl";	
		if(isset($_SESSION['db_name']))
		{
			if($_SESSION['db_name'] != $this->base)
			{
				$this->base = $_SESSION['db_name'];
			}
		}
		$this->db_link  = mysqli_connect($hote, $user, $Mpass, $this->base)or die('erreur');
		$this->is_connected = true;
		mysqli_set_charset($this->db_link, 'utf8');
		
	}

	//cette fonction va permettre de remplacer dans toute les boucle de fetch, par mysqli_fetch_object
	//elle recois la requete envoyer par l'appelant  
	public function fetch_object($req_sql)  // elle recois la requète sql sous forme de string
	{	

		if($this->is_connected == false) // vérifie si la connection à la DB est établie si pas , elle le fait
			$this->connect(); //appel la fonction

		if(is_null($this->last_req_sql) || is_null($this->last_res_sql) || $req_sql != $this->last_req_sql)
		{
			$this->last_req_sql = $req_sql; // enregistre une copie temporaire de la requete
			$this->last_res_sql = mysqli_query($this->db_link, $req_sql)or die('Problème de requète');// enregistre une copie temporaire de la reponse requete
		}// si les valeurs sont null ou différente , enregistre les variable correctement

		$res = mysqli_fetch_object($this->last_res_sql);  //enregistre les lignes de la requète sur un object
		if (is_null($res))
		 // fetch va vider l'objet envoyer donc on vérifie si le resultat est null , 
		//si c'est le cas on vide le buffer et remet la variable a null pour une prochaine requète
		{
			mysqli_free_result($this->last_res_sql);
			$this->last_res_sql = null;
		}
		
		return $res; // renvoi un tableau d'objet
	}
	public function fetch_array($req_sql)
	{
		
		if($this->is_connected == false)
			$this->connect();
	
		if(is_null($this->last_req_sql) || is_null($this->last_res_sql) || $req_sql != $this->last_req_sql)
		{
			$this->last_req_sql = $req_sql;
			$this->last_res_sql = mysqli_query($this->db_link, $req_sql);
		}
		$res = mysqli_fetch_array($this->last_res_sql);
		if (is_null($res))
		{
			mysqli_free_result($this->last_res_sql);
			$this->last_res_sql = null;
		}
		return $res; // renvoi des trucs bizarre petite erreur quelque part
	}
	public function fetch_assoc($req_sql)
	{
		if($this->is_connected == false)
			$this->connect();
	
		if(is_null($this->last_req_sql) || is_null($this->last_res_sql) || $req_sql != $this->last_req_sql)
		{
			$this->last_req_sql = $req_sql;
			$this->last_res_sql = mysqli_query($this->db_link, $req_sql);
		}
		$res = mysqli_fetch_assoc($this->last_res_sql);
		if (is_null($res))
		{
			mysqli_free_result($this->last_res_sql);
			$this->last_res_sql = null;
		}
		return $res; //renvoi un tableau de tableau assosiatif
	}

	public function query($req_sql)
	{
		$this->connect();

		return mysqli_query($this->db_link, $req_sql)or die(mysql_error());
		
	}
	
	public function get_last_insert_id()
	{
		return mysqli_insert_id($this->db_link);
	}
	public function get_db_link()
	{
		if($this->is_connected == false) // vérifie si la connection à la DB est établie si pas , elle le fait
			$this->connect(); //appel la fonction
		return $this->db_link;
	}
	
	public function escape_string($txt)
	{
		if($this->is_connected == false)
			$this->connect();
		return mysqli_real_escape_string($this->db_link, $txt);
	}
	public function get_name_base()
	{
		return htmlspecialchars($this->base);
	}
}

?>
