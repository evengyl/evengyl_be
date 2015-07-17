<?php 

##########################################
#	Createur : Evengyl
#	Date de creation : 29-09-2014
#	Version : 18.2
#	Date de modif : 13-03-2015
##########################################

// le fichier security fait intervalle entre les fonction qui demande des requète et le fichier qui effectue les requete 

class security extends _db_connect
{
	public $level_session = 0;

	function __construct()
	{
		if (isset($_SESSION['user_lvl'])) $this->set_user_lvl($_SESSION['user_lvl']);
	}
	public function verif_req($req_sql)
	{

		$db_link = parent::get_db_link();
		if(is_array($req_sql))
			return;
		if(isset($req_sql))
		{
			$req_sql = htmlentities($req_sql,ENT_QUOTES, "UTF-8");
			$req_sql = htmlspecialchars($req_sql); 			
			return $req_sql;
		}
		else 
			return 'Erreur de requète SQl , il est possible que la requète n\'existe pas';	
	}

	public function html($string)
	{
		return htmlentities($string);
	}	

	public function set_user_lvl($lvl_user)
	{
		$this->level_session = $lvl_user;
		$_SESSION['user_lvl'] = $lvl_user;
	}

	public function require_on_lvl($require_file, $required_lvl=0)
	{
		
		if ($this->level_session < $required_lvl)
		{
			?>
			<p style="font-size:17px; padding:10px; text-align:center;" class="bg-warning">Page non accessible</p>		
			<p style="font-size:17px; padding:10px; text-align:center;" class="bg-warning">Vous allez être redirigé ...</p>		
			<script type="text/javascript">window.setTimeout("location=('http://evengyl.be/?nav=connect');",2000);</script>
			<?php
		}
		else
		{
			global $all_query, $_db_connect, $operation_sql, $traitement_post_ticket_php, $traitement_post_ticket_js, $traitement_post_adwords, $traitement_post_depenses;
			global $traitement_post_gain_lucie, $traitement_post_connect, $traitement_post_ifapme, $traitement_post_update, $ctx_global;
			
			$ctx_global = new stdClass();
			$ctx_global->version = $_SESSION['version'];
			require_once($_SESSION['version'].'/vue/templates/'.$require_file);
		}
	}
}





?>
