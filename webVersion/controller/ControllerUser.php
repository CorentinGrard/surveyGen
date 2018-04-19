<?php
require_once (File::build_path(array ("model","Model.php")));
require_once (File::build_path(array ("model","ModelUser.php")));
require_once (File::build_path(array ("model","ModelProfession.php")));
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerUser {

	protected static $object='user';

	public static function default(){
        if(isset($_SESSION['email'])){
            ControllerDashboard::default();
        }
        $postOrGet=Conf::getPostOrGet();
        require (File::build_path(array ("view",static::$object,"login.php")));
    }

    public static function connected(){
	    if(Util::myGet('email')!='' && Util::myGet('password')!='' && ModelUser::checkPassword(Util::myGet('email'),Security::encode(Util::myGet('password')))){
			$u=ModelUser::select(Util::myGet('email'));
			if($u->get('nonce')==NULL){
			    $_SESSION['email'] = Util::myGet('email');
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

    public static function disconnect(){
    	session_destroy();
    	header('Location:index.php');
    }

	public static function validate(){
		$u=ModelUser::select(Util::myGet('email'));
		if($u!=false && $u->get('nonce')==Util::myGet('nonce')){
			if(ModelUser::update(array(
				"email" => Util::myGet('email'),
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
        $email = $_GET['email'];
        $u = ModelUser::select($email);
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
		$today = date('Y-m-d');
		$postOrGet=Conf::getPostOrGet();
		$professionTab=ModelProfession::selectAll();
    	require(File::build_path(array ("view",static::$object,"register.php")));
    }

    public static function created(){
			$email=Util::myGet('email');
			if(filter_var(Util::myGet('email'),FILTER_VALIDATE_EMAIL)==false){
				$view = array("view", static::$object, "errorEmail.php");
				$pagetitle = 'Erreur Email';
				require(File::build_path(array ("view","view.php")));
			}
        	if(Util::myGet('password')!=Util::myGet('confPassword')){
				$view = array("view", static::$object, "connect.php");
	        	$pagetitle = 'Erreur mot de passe';
	      		require(File::build_path(array ("view","view.php")));
        	}else{
				$nonce=Security::generateRandomHex();
		    	if(ModelUser::save(array(
					"email"=>$email,
					"idProfession" => Util::myGet('profession'),
					"name" => Util::myGet("fName"),
					"lastName" => Util::myGet("lName"),
		            "password"=>Security::encode(Util::myGet('password')),
					"birthDate"=>Util::myGet('birthdate'),
					"nonce"=>$nonce,
		       ))==false){
					$tab_u = ModelUser::selectAll();
					$postOrGet=Conf::getPostOrGet();
		       		$view=array("view", static::$object, "errorSave.php");
		       		$pagetitle='Inscription';
		    		require(File::build_path(array ("view","view.php")));
		    	}else{
					$mail='Click on the link to validate your account : http://sgs/webVersion/?controller=user&action=validate&email='.$email.'&nonce='.$nonce.'"';
					if(mail(Util::myGet('email'),"Activation SGS account",$mail)){
						$tab_u = ModelUser::selectAll();
			       		$view = array("view", static::$object, "created.php");
						$pagetitle = 'User créé';
			        	require(File::build_path(array ("view","view.php")));
					}else{
						$view = array("view", static::$object, "errorSendEmail.php");
						$pagetitle = 'Error sending email';
						require(File::build_path(array ("view","view.php")));
					}
		  		}
		  	}
    }

    public static function update(){
    	if(!isset($_SESSION['email'])){
    		$view=array("view", static::$object, "connect.php");
	      	$pagetitle='Connexion';
	      	require(File::build_path(array ("view","view.php")));
	    }else if(!Session::is_user(Util::myGet('email'))){
	    	header('Location:index.php');
	    }else{
	        $email=Util::myGet('email');
	        $User = ModelUser::select($email);
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
    	if(!isset($_SESSION['email'])){
    		$view=array("view", static::$object, "connect.php");
	        $pagetitle='Connexion';
	        require(File::build_path(array ("view","view.php")));
	    }else if(!Session::is_user(Util::myGet('email'))){
	    	header('Location:index.php');
	    }else{
					if(filter_var(Util::myGet('email'),FILTER_VALIDATE_EMAIL)==false){
						$view = array("view", static::$object, "errorEmail.php");
						$pagetitle = 'Erreur Email';
						require(File::build_path(array ("view","view.php")));
					}
					$email=Util::myGet('email');
	        if(ModelUser::select($email)){
	            $res=ModelUser::update(array(
								"email"=>$email,
								"pass"=>Security::chiffrer(Util::myGet('pass')),
								"pseudo"=>Util::myGet('pseudo'),
								"email"=>Util::myGet('email'),
								"sexe"=>Util::myGet('sexe'),
								"profession"=>Util::myGet('profession'),
	                ));
	            if($res){
									$email = $_GET['email'];
									$u = ModelUser::select($email);
									$email=htmlspecialchars($email);
									$urlemail=rawurlencode($u->get('email'));
									$up = "";
									if(Session::is_user($email)){
										$up = '<a href="?controller=User&action=update&email='.$urlemail.'">Cliquer ici pour mettre à jour votre profil</a> <br>  <a href="?controller=User&action=delete&email='.$urlemail.'">Cliquer ici pour supprimer votre profil</a>';
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
    	if(!isset($_SESSION['email'])){
    		$view=array("view", static::$object, "connect.php");
	      $pagetitle='Connexion';
	      require(File::build_path(array ("view","view.php")));
	    }else if(!Session::is_user(Util::myGet('email'))){
	    	header('Location:index.php');
	    }else{
	    	$email = Util::myGet('email');
	    	if (ModelUser::delete($email)) {
					if(Session::is_user($email))self::disconnect();
	        $tab_u = ModelUser::selectAll();
	        $view = array("view", static::$object, "deleted.php");
	        $pagetitle = 'User supprimé';
	        require(File::build_path(array ("view","view.php")));
	    	}else{
	        $view=array("view", static::$object, "erreurDelete.php");
	        $pagetitle='Erreur suppression';
	    		require(File::build_path(array ("view","view.php")));
	    	}
	    }
	}
	
	public static function forgotPassword(){
		require(File::build_path(array ("view",static::$object,"forgot-password.php")));
	}

	public static function existUser(){
		if(Util::myGet('email'!=NULL)){
			$u=ModelUser::select(Util::myGet('email'));
			echo $u!=false;
		}
	}
}
?>
