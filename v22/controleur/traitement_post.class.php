<?php
class traitement_post_ticket extends all_query
{
	public function __construct()
	{
		$this->ctx_post = (object)array();
	}
	public function verif_post_add_ticket($type_ticket)
	{
		if(!isset($_POST['action']) || ($_POST['action'] != 'ajouter_php') || ($_POST['action'] != 'ajouter_js')) 
			return;
		else
		{
			if($type_ticket == 'ajouter_php')
				$table = 'ticket_js';
			else if($type_ticket == 'ajouter_js')
				$table = 'ticket_php';
		}
		if(isset($_POST['commentaire']))
			(is_string($_POST['commentaire']))? $commentaire = $_POST['commentaire'] : $commentaire = '0' ;
		
		$req_sql = new stdClass();
		$req_sql->table = $table;
		$req_sql->ctx = array('commentaire' => $commentaire);
		$req_sql->date = date('Y-m-d');

		parent::insert_into($req_sql);		
	}
}

class traitement_post_adwords extends all_query
{
		public function __construct()
		{
			$this->ctx_post = (object)array();
		}
		
		public function verif_post_add_adwords()
		{				
			if(!isset($_POST['action']) || $_POST['action'] != 'ajout_adwords') return; 
			// tout ce joue ici , lors du premier passage cette variable est analisée et 
			//return a false vu que elle ne contient rien car le post n'a pas encore ete fait
			// recupere les éléments du post et les parse
			// les converti dans un contexte verifier						
			if(isset($_POST['jours']))
				(is_string($_POST['jours']))? $jours = $_POST['jours'] : $jours = '0';

			if(isset($_POST['mois']))
				(is_string($_POST['mois']))? $mois = $_POST['mois'] : $mois = '0';

			if(isset($_POST['annee']))
				(is_string($_POST['annee']))? $annee = $_POST['annee'] : $annee = '0';
			
			if(isset($_POST['clic']))
				(is_string($_POST['clic']))? $clic = $_POST['clic'] : $clic = '0';

			if(isset($_POST['impression']))
				(is_string($_POST['impression']))? $impression = $_POST['impression'] : $impression = '0' ;

			if(isset($_POST['rentabilite']))
				(is_string($_POST['rentabilite']))? $rentabilite = $_POST['rentabilite'] : $rentabilite = '0' ;

			if(isset($_POST['cm']))
				(is_string($_POST['cm']))? $cout_moyen = $_POST['cm'] : $cout_moyen = '0' ;

			if(isset($_POST['ct']))
				(is_string($_POST['ct']))? $cout_total = $_POST['ct'] : $cout_total = '0' ;

			if(isset($_POST['pos_m']))
				(is_string($_POST['pos_m']))? $position_m = $_POST['pos_m'] : $position_m = '0' ;

			$ctx_post_array = array();
			$ctx_post_array['clics'] = $clic;
			$ctx_post_array['impression'] = $impression;
			$ctx_post_array['rentabilite'] = $rentabilite;
			$ctx_post_array['cout_moyen'] = $cout_moyen;
			$ctx_post_array['cout_total'] = $cout_total;
			$ctx_post_array['pos_moyenne'] = $position_m;			
			
			$ctx_post = new stdClass();	
			$ctx_post->table = 'adwords';				
			$ctx_post->date = $jours.'-'.$mois.'-'.$annee;
			$ctx_post->ctx = $ctx_post_array;
			

			parent::insert_into($ctx_post);
		}
}

class traitement_post_connect extends all_query
{
		
		const LEVEL_SUPER_ADMIN = 3;
		const LEVEL_ADMIN = 2;
		const LEVEL_MODO = 1;
		const LEVEL_USER = 0;

		public function __construct()
		{
			$this->ctx_post = (object)array();
		}

		public function verif_post_connect()
		{
			
			if(!isset($_POST['action']) || $_POST['action'] != 'connection')
			{
				return;
			}
			if($_POST['action'] == 'connection')
			{
				$login = strip_tags($_POST['login']);
				$mdp = strip_tags($_POST['password']);
				unset($_POST);
				$message = '';
				$login = strtolower($login);
				$mdp = strtolower($mdp);

				if((isset($login) && $login != '') && (isset($mdp) && $mdp != ''))
				{
					$res_fx_login = parent::select_simple($var='id, login', $from='login', $where='', $order='', $type_return='object');					
					
					foreach($res_fx_login as $login_fx)
					{
						if($login == $login_fx->login)
						{
							//ici ok 
							$res_fx_mdp = parent::select_simple($var='id, mdp', $from='login', $where='', $order='', $type_return='object');							
							foreach($res_fx_mdp as $mdp_fx)
							{
								//ici ok
								if($mdp == $mdp_fx->mdp)
								{
									$id = $mdp_fx->id;
									$where= 'id = '.$id;
									$level_user = parent::select_simple($var='auth', $from='login', $where, $order='', $type_return='object');
									if(isset($_SESSION['login']))
									{
										session_unset();
									}
									else
									{										
										$_SESSION['login'] = $login;
										$_SESSION['SERVER_NAME'] = $_SERVER['SERVER_NAME'];
		    							$_SESSION['SERVER_ADDR'] = $_SERVER['SERVER_ADDR'];
		    							$security = new security();		    							
		    							$ban_ip  = true;
		    							if($ban_ip == 'true')
		    							{
			    							$_SESSION['SERVER_PORT'] = $_SERVER['SERVER_PORT'];
			    							

					    					if($level_user[0]->auth == self::LEVEL_MODO)
											{
												$_SESSION['level_user'] = self::LEVEL_MODO;
												$security->set_user_lvl(self::LEVEL_MODO);
											}
											else if($level_user[0]->auth == self::LEVEL_ADMIN)
											{
												$_SESSION['level_user'] = self::LEVEL_ADMIN;
												$security->set_user_lvl(self::LEVEL_ADMIN);
											}
											else if($level_user[0]->auth == self::LEVEL_SUPER_ADMIN)
											{
												$_SESSION['level_user'] = self::LEVEL_SUPER_ADMIN;
												$security->set_user_lvl(self::LEVEL_SUPER_ADMIN);
											}
											else
											{
												$_SESSION['level_user'] = self::LEVEL_USER;
												$security->set_user_lvl(0);	
											}
										}
									}
									?>
									<p style="font-size:17px; padding:10px; margin-top:15px; text-align:center;" class="bg-warning">Vous êtes bien connecté !</p>
									<p style="font-size:17px; padding:10px; text-align:center;" class="bg-warning">Bienvenue <?php echo $login; ?></p>
									
									<script>
					     				
					    				function return_after(){
					    					document.location.href="../../";
					    				}	
					    				setTimeout(return_after,1000);				     				
					     				
									</script>
									<?php
									break;
								}								
							}							
						}				
					}
				}
				else
				{					
					$message = 'Erreur de connection , vérifiez vos données !';
					echo '<div class="alert alert-danger" role="alert">'.$message.'</div>';	
				}			
			}			
		}

}

class traitement_post_ifapme extends all_query
{
	public function __construct()
	{
		$this->ctx_post = (object)array();
	}
	public function verif_post_ifapme()
	{	
		if(!isset($_POST['action']) || $_POST['action'] != 'ajout_tuto_ifapme')
		{
			return;
		}
		else
		{
			$nb_negatif = '0';
			$nb_positif = '0';
			$ctx_post_array = array();			
			$ctx_post_array['type'] = $_POST['type'];
			$ctx_post_array['language'] = $_POST['language'];
			$ctx_post_array['title'] = $_POST['titre'];
			$ctx_post_array['text'] = $_POST['text'];
			$ctx_post_array['nb_positif'] = $nb_positif;
			$ctx_post_array['nb_negatif'] = $nb_negatif;

			$ctx_post = new stdClass();
			$ctx_post->table = 'ifapme';
			$ctx_post->ctx = $ctx_post_array;			
			
			parent::insert_into($ctx_post);
		}
	}
}
class traitement_post_update extends all_query
{
	public function __construct()
	{
		$this->ctx_post = (object)array();
	}

	public function verif_post_update()
	{
		if(!isset($_POST['action']) || $_POST['action'] != 'update_complete')
		{
			return;
		}
		else
		{ 
			$req_sql = new stdClass;
			$req_sql->table = $_GET['table'];
			$req_sql->where = 'id = '.$_GET['id'];
			
				if(isset($_POST['action']))
					unset($_POST['action']);
				if(isset($_POST['actions']))
					unset($_POST['actions']);
			$req_sql->ctx = $_POST;
			parent::update($req_sql);			
		}
	}
}
class traitement_post_depenses extends operation_sql
{		

		public function __construct()
		{
			$this->ctx_post = (object)array();
		}

		public function verif_post_add_depenses()
		{
			if(!isset($_POST['action']) || $_POST['action'] != 'ajout_depense') return;
			// recupere les éléments du post et les parse
			// les converti dans un contexte verifier
										echo 'En travaux pour le moment !';
										
			$montants = (float)$_POST['montant'];


			if(isset($montant))
			{
				if(is_float($montant))
					$montant = $montant;
			}
			if(isset($montant))
				(is_string($_POST['somme']))?$montant = $montants : $somme = '0';

			if(isset($_POST['commentaire']))
			{
				if(is_string($_POST['commentaire']))
					$commentaire = $_POST['commentaire'];
				else
					$commentaire = 'Undefined';
			}
			if(isset($_POST['annee']))
			{
				$annee = $_POST['annee'];
			}

			if(isset($_POST['mois']))
			{
				if(is_string($_POST['mois']))
					$mois = $_POST['mois'];
				else
					$mois = 'Undefined';
			}
			$ctx_post = (object)array();
			$ctx_post->montant = $montant;
			$ctx_post->commentaire = $commentaire;
			$ctx_post->mois = $mois;
			$ctx_post->annee = $annee;

			parent::ajout_depenses($ctx_post);
		}
}

$traitement_post_ticket = new traitement_post_ticket();
$traitement_post_adwords = new traitement_post_adwords();
$traitement_post_depenses = new traitement_post_depenses();
$traitement_post_connect = new traitement_post_connect();
$traitement_post_ifapme = new traitement_post_ifapme();
$traitement_post_update = new traitement_post_update();


?>
