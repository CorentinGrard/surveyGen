<?php
require_once (File::build_path(array ("model","Model.php")));
require_once (File::build_path(array ("model","ModelUser.php")));
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerUser {

	protected static $object='User';

    public static function connected(){
	    if($_GET['login']!='' && $_GET['pass']!='' && ModelUser::checkPassword($_GET['login'],Security::encode($_GET['pass']))){
			$u=ModelUser::select($_GET['login']);
			if($u->get('nonce')==NULL){
			    $_SESSION['login'] = $_GET['login'];
		   		$view=array("view", static::$object, "connected.php");
		        $pagetitle='Connexion réussie';
		      	require (File::build_path(array ("view","view.php")));
			}else{
				$view=array("view", static::$object, "errorNonce.php");
				$pagetitle='Email non validé';
				require (File::build_path(array ("view","view.php")));
			}
   		}else{
	   		$view=array("view", static::$object, "erreurConnect.php");
			$pagetitle='Erreur connexion';
			require (File::build_path(array ("view","view.php")));
   			}
    }

    public static function deconnect(){
    	session_destroy();
    	header('Location:index.php');
    }

	public static function validate(){
		$u=ModelUser::select($_GET['login']);
		if($u!=false && $u->get('nonce')==$_GET['nonce']){
			if(ModelUser::update(array(
				"login" => $_GET['login'],
				"nonce" => NULL,
			))){
				$view=array("view", static::$object, "validate.php");
				$pagetitle='Email validé';
				require (File::build_path(array ("view","view.php")));
			}else{
				$view=array("view", static::$object, "errorUpdate.php");
				$pagetitle='User non maj';
				require(File::build_path(array ("view","view.php")));
			}
		}else{
			$view=array("view", static::$object, "errorValidate.php");
			$pagetitle='Erreur validation email';
			require(File::build_path(array ("view","view.php")));
		}
	}

    public static function read() {
        $login = $_GET['login'];
        $u = ModelUser::select($login);
        if($u==false){
            $view=array("view", static::$object, "errorUser.php");
            $pagetitle='User non trouvé';
        	require(File::build_path(array ("view","view.php")));
        }else{ 
            $view=array("view", static::$object, "detail.php");
            $pagetitle='Détail d\'un User';
    	    require(File::build_path(array ("view","view.php")));
 		}
    }

  	public static function create(){
			$postOrGet=Conf::getPostOrGet();
      		$view=array("view", static::$object, "create.php");
      		$pagetitle='Inscription';
    		require(File::build_path(array ("view","view.php")));
    }

    public static function created(){
    		$login=Util::myGet('login');
				if(filter_var(Util::myGet('email'),FILTER_VALIDATE_EMAIL)==false){
					$view = array("view", static::$object, "errorEmail.php");
					$pagetitle = 'Erreur Email';
					require(File::build_path(array ("view","view.php")));
				}
        	if(Util::myGet('pass')!=Util::myGet('confpass')){
				$view = array("view", static::$object
				., "connect.php"); /*errorpass.php*/
	        	$pagetitle = 'Erreur mot de passe';
	      		require(File::build_path(array ("view","view.php")));
        	}else{
				$nonce=Security::generateRandomHex();
		    	if(ModelUser::save(array(
		            "login"=>$login,
		            "pass"=>Security::chiffrer(Util::myGet('pass')),
					"pseudo"=>Util::myGet('pseudo'),
		            "email"=>Util::myGet('email'),
					"nonce"=>$nonce,
		       ))==false){
					$tab_u = ModelUser::selectAll();
					$postOrGet=Conf::getPostOrGet();
		        $view=array("view", static::$object, "errorSave.php");
		        $pagetitle='Inscription';
		    	require(File::build_path(array ("view","view.php")));
		    	}else{
					$mail='Mail de validation de REV, Cliquez ici pour valider votre compte : https://webinfo.iutmontp.univ-montp2.fr/~phunvongm/videoludique/?controller=User&action=validate&login='.$login.'&nonce='.$nonce.'"';
					if(mail(Util::myGet('email'),"Validation de votre compte REV",$mail)){
						$tab_u = ModelUser::selectAll();
			       		$view = array("view", static::$object, "created.php");
						$pagetitle = 'User créé';
			        	require(File::build_path(array ("view","view.php")));
					}else{
						$view = array("view", static::$object, "errorSendEmail.php");
						$pagetitle = 'Erreur envoi email';
						require(File::build_path(array ("view","view.php")));
					}
		  		}
		  	}
    }

    public static function update(){
    	if(!isset($_SESSION['login'])){
    			$view=array("view", static::$object, "connect.php");
	      	$pagetitle='Connexion';
	      	require(File::build_path(array ("view","view.php")));
	    }else if(!Session::is_user(Util::myGet('login'))){
	    	header('Location:index.php');
	    }else{
	        $login=Util::myGet('login');
	        $User = ModelUser::select($login);
	        if($User==false){
	            $view=array("view", static::$object, "errorUser.php");
	            $pagetitle='User non trouvé';
	            require(File::build_path(array ("view","view.php")));
	        }
			$postOrGet=Conf::getPostOrGet();
	        $view=array("view", static::$object, "update.php");
	        $pagetitle='Formulaire maj User';
	        require(File::build_path(array ("view","view.php")));
	    	}
    }

    public static function updated(){
    	if(!isset($_SESSION['login'])){
    		$view=array("view", static::$object, "connect.php");
	        $pagetitle='Connexion';
	        require(File::build_path(array ("view","view.php")));
	    }else if(!Session::is_user(Util::myGet('login'))){
	    	header('Location:index.php');
	    }else{
					if(filter_var(Util::myGet('email'),FILTER_VALIDATE_EMAIL)==false){
						$view = array("view", static::$object, "errorEmail.php");
						$pagetitle = 'Erreur Email';
						require(File::build_path(array ("view","view.php")));
					}
					$login=Util::myGet('login');
	        if(ModelUser::select($login)){
	            $res=ModelUser::update(array(
								"login"=>$login,
								"pass"=>Security::chiffrer(Util::myGet('pass')),
								"pseudo"=>Util::myGet('pseudo'),
								"email"=>Util::myGet('email'),
								"sexe"=>Util::myGet('sexe'),
								"profession"=>Util::myGet('profession'),
	                ));
	            if($res){
									$login = $_GET['login'];
									$u = ModelUser::select($login);
									$login=htmlspecialchars($login);
									$urlLogin=rawurlencode($u->get('login'));
									$up = "";
									if(Session::is_user($login)){
										$up = '<a href="?controller=User&action=update&login='.$urlLogin.'">Cliquer ici pour mettre à jour votre profil</a> <br>  <a href="?controller=User&action=delete&login='.$urlLogin.'">Cliquer ici pour supprimer votre profil</a>';
									}
	                $view = array("view", static::$object, "updated.php");
	                $pagetitle = 'User mis à jour';
	                require(File::build_path(array ("view","view.php")));
	            }else{
	                $view=array("view", static::$object, "errorUpdate.php");
	                $pagetitle='User non maj';
	                require(File::build_path(array ("view","view.php")));
	            }
	        }else{
	            $view=array("view", static::$object, "errorUser.php");
	            $pagetitle='User non trouvé';
	            require(File::build_path(array ("view","view.php")));
	        }
	    }
    }

    public static function delete(){
    	if(!isset($_SESSION['login'])){
    		$view=array("view", static::$object, "connect.php");
	      $pagetitle='Connexion';
	      require(File::build_path(array ("view","view.php")));
	    }else if(!Session::is_user(Util::myGet('login'))){
	    	header('Location:index.php');
	    }else{
	    	$login = Util::myGet('login');
	    	if (ModelUser::delete($login)) {
					if(Session::is_user($login))self::deconnect();
	        $tab_u = ModelUser::selectAll();
	        $view = array("view", static::$object, "deleted.php");
	        $pagetitle = 'User supprimé';
	        require (File::build_path(array ("view","view.php")));
	    	}else{
	        $view=array("view", static::$object, "erreurDelete.php");
	        $pagetitle='Erreur suppression';
	    		require (File::build_path(array ("view","view.php")));
	    	}
	    }
    }
}
?>
