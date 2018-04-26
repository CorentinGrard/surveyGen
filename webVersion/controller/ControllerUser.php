<?php
require_once (File::build_path(array ("model","Model.php")));
require_once (File::build_path(array ("model","ModelUsers.php")));
require_once (File::build_path(array ("model","ModelProfession.php")));
require_once (File::build_path(array ("lib","Util.php")));
require_once (File::build_path(array ("lib","Security.php")));
class ControllerUser {

	protected static $object='user';

	 /**
	 * Executes a default fonction when no action is specified in the URL
	 * 
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function default(){
        if(isset($_SESSION['email'])){
            ControllerDashboard::default();
        }else{
      		$postOrGet=Conf::getPostOrGet();
			require (File::build_path(array ("view",static::$object,"login.php")));
		}
    }

	 /**
	 * manages conection.
	 * Initializes the session and redirects the user to correct page.
	 * index.php if success
	 * login.php if failure
	 * 
	 * @throws "account isn't validated"
	 * @throws "Email or password incorrect"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
    public static function connected(){
	    if(Util::myGet('email')!='' && Util::myGet('password')!='' && ModelUsers::checkPassword(Util::myGet('email'),Security::encode(Util::myGet('password')))){
			$u=ModelUsers::select(Util::myGet('email'));
			if($u->get('nonce')==NULL){
			    $_SESSION['email'] = Util::myGet('email');
				header("location:index.php");
			}else{
				$error="Account isn't validated";
				$postOrGet=Conf::getPostOrGet();
				require (File::build_path(array ("view",static::$object,"login.php")));
			}
   		}else{
			$error="Email or password incorrect";
			$postOrGet=Conf::getPostOrGet();
			require (File::build_path(array ("view",static::$object,"login.php")));
   		}
    }
	 /**
	 * manages diconection.
	 * destroy the session
	 * redirects to index.php
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
    public static function disconnect(){
    	session_destroy();
    	header('Location:index.php');
    }
	 /**
	 * Email validation of an account.
	 * Succeeds if the nonce if the nonce in the Email sent is equal to the nounce of the user $u in the database
	 * @throws "Error validation account"
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function validate(){
		$u=ModelUsers::select(Util::myGet('email'));
		if($u!=false && $u->get('nonce')==Util::myGet('nonce')){
			if(ModelUsers::update(array(
				"email" => Util::myGet('email'),
				"nonce" => NULL,
			))){
				$validate="Account validated";
				$postOrGet=Conf::getPostOrGet();
				require (File::build_path(array ("view",static::$object,"login.php")));
			}else{
				$view=array("view", static::$object, "errorUpdate.php");//TO DO
				$pagetitle='User not updated';
				require(File::build_path(array ("view","view.php")));
			}
		}else{
			$error="Error validation account";
			$postOrGet=Conf::getPostOrGet();
			require (File::build_path(array ("view",static::$object,"login.php")));
		}
	}
	 /**
	 * prepare the details of the user connected by interacting with ModelUsers
	 * Transfer informations to a view via $u
	 * 
	 * @throws "User not found"
	 * 
	 * @author Esteban Legrand <esteban.legrand@outlook.fr>
	 */ 
    public static function read() {
        $email = $_GET['email'];
        $u = ModelUsers::select($email);
        if($u==false){
            $view=array("view", static::$object, "errorUser.php");
            $pagetitle='User not found';
        	require(File::build_path(array ("view","view.php")));
        }else{ 
            $view=array("view", static::$object, "userDetails.php");
            $pagetitle='Détail d\'un User';
    	    require(File::build_path(array ("view","view.php")));
 		}
    }
	 /**
	 * manages user creation form
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
  	public static function create(){
		if(isset($_SESSION['email'])){
			header('location:index.php');
		}else{
			$today = date('Y-m-d');
			$postOrGet=Conf::getPostOrGet();
			$professionTab=ModelProfession::selectAll();
			require(File::build_path(array ("view",static::$object,"register.php")));
		}
    }
	 /**
	 * manages conection of a user.
	 * 
	 * @throws "Email error"
	 * @throws "Password error"
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
    public static function created(){
			$email=Util::myGet('email');
			if(filter_var(Util::myGet('email'),FILTER_VALIDATE_EMAIL)==false){
				$view = array("view", static::$object, "errorEmail.php");
				$pagetitle = 'Email error';
				require(File::build_path(array ("view","view.php")));
			}
        	if(Util::myGet('password')!=Util::myGet('confPassword')){
				$view = array("view", static::$object, "connect.php");
				$pagetitle = 'Password error';
	      		require(File::build_path(array ("view","view.php")));
        	}else{
				$nonce=Security::generateRandomHex();
		    	if(ModelUsers::save(array(
					"email"=>$email,
					"idProfession" => Util::myGet('profession'),
					"name" => Util::myGet("fName"),
					"lastName" => Util::myGet("lName"),
		            "password"=>Security::encode(Util::myGet('password')),
					"birthDate"=>Util::myGet('birthdate'),
					"nonce"=>$nonce,
		       ))==false){
					$tab_u = ModelUsers::selectAll();
					$postOrGet=Conf::getPostOrGet();
		       		$view=array("view", static::$object, "errorSave.php");
		       		$pagetitle='Inscription';
		    		require(File::build_path(array ("view","view.php")));
		    	}else{
					$headers = 'MIME-Version: 1.0’ . "\r\n"';
					$headers .= 'Content-type: text/html; charset=iso-8859-1′ . "\r\n"';
					$headers .= 'From: sgs@corentin-grard.fr’ . "\r\n"';
					$mail='Click on the link to validate your account : http://sgs/webVersion/?controller=user&action=validate&email='.$email.'&nonce='.$nonce.'"';
					if(mail(Util::myGet('email'),"Activation SGS account",$mail,$headers)){
						header("location:index.php");
					}else{
						$view = array("view", static::$object, "errorSendEmail.php");
						$pagetitle = 'Error sending email';
						require(File::build_path(array ("view","view.php")));
					}
		  		}
		  	}
    }

    public static function update(){// TO DO
    	if(!isset($_SESSION['email'])){
			header('Location:index.php');
		}
		else {
	        $email=Util::myGet('email');
	        $User = ModelUsers::select($email);
	        if($User==false){
	            $view=array("view", static::$object, "errorUser.php");
	            $pagetitle='User non trouvé';
	            require(File::build_path(array ("view","view.php")));
	        }
			$postOrGet=Conf::getPostOrGet();
	        $view=array("view", static::$object, "updateInfos.php");
	        $pagetitle='Formulaire maj User';
	        require(File::build_path(array ("view","view.php")));
	    	}
    }

    public static function updated(){// TO DO
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
	        if(ModelUsers::select($email)){
	            $res=ModelUsers::update(array(
								"email"=>$email,
								"pass"=>Security::chiffrer(Util::myGet('pass')),
								"pseudo"=>Util::myGet('pseudo'),
								"email"=>Util::myGet('email'),
								"sexe"=>Util::myGet('sexe'),
								"profession"=>Util::myGet('profession'),
	                ));
	            if($res){
									$email = $_GET['email'];
									$u = ModelUsers::select($email);
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

    public static function delete(){// TO DO
    	if(!isset($_SESSION['email'])){
    		$view=array("view", static::$object, "connect.php");
	    	$pagetitle='Connexion';
	      	require(File::build_path(array ("view","view.php")));
	    }else if(!Session::is_user(Util::myGet('email'))){
	    	header('Location:index.php');
	    }else{
	    	$email = Util::myGet('email');
	    	if (ModelUsers::delete($email)) {
				if(Session::is_user($email))self::disconnect();
				$tab_u = ModelUsers::selectAll();
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
	
	/**
	 * Handles the case of password forgotten
	 * 
	 * @author Corentin Grard <corentin.grard@gmail.com>
	 */ 
	public static function forgotPassword(){
		if(isset($_SESSION['email'])){
			header("location:index.php");
		}else{
			$postOrGet=Conf::getPostOrGet();
			require(File::build_path(array ("view",static::$object,"forgot-password.php")));
		}
	}

	public static function resetPassword(){// TO COMPLETE
		$headers = 'MIME-Version: 1.0’ . "\r\n"';
		$headers .= 'Content-type: text/html; charset=iso-8859-1′ . "\r\n"';
		$headers .= 'From: sgs@corentin-grard.fr’ . "\r\n"';
		$mail='Click on the link to reset your password http://sgs/webVersion/?controller=user&action=validate&email='.$email.'&nonce='.$nonce.'"';
		if(mail(Util::myGet('email'),"Reset SGS password",$mail,$headers)){
			header("location:index.php");
		}else{
			$view = array("view", static::$object, "errorSendEmail.php");
			$pagetitle = 'Error sending email';
			require(File::build_path(array ("view","view.php")));
		}
	}


/**
 * Check if an user(email) exist in the database 
 *
 * @param String  $_POST['email] email that we need to check
 * 
 * @author Corentin Grard <corentin.grard@gmail.com>
 * @return Boolean true is user exist, else false
 */ 
	public static function existUser(){
		if(Util::myGet('email')!=NULL){
			$u=ModelUsers::select(Util::myGet('email'));
			echo $u!=false;
		}
	}
}
?>
