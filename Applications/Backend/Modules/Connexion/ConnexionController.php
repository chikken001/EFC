<?php
namespace Applications\Backend\Modules\Connexion;

use \Library\Crypt ;
use Library\Form ;

class ConnexionController extends \Library\BackController
{
	public function executeIndex(\Library\HTTPRequest $request)
	{
		if(!$this->user->isAdmin())
		{
			$this->page->addVar('title', 'Connexion');
			
			$form_connexion = array('connexion' => array('form','form-horizontal'),
						  'div login' => array('div','form-group'),
							'label login' => array('label', 'Login', 'col-lg-2 control-label', 'login'),
							'div input login' => array('div','col-lg-10'),
						  		'login' => array('text','',array('email'=>'Login invalide'),'',array('class' => 'form-control')),
							'fin div input login' => array('/div'),
						  'fin div login' => array('/div'),
						  'div password' => array('div','form-group'),
							'label password' => array('label', 'Mot de passe', 'col-lg-2 control-label', 'password'),
							'div input password' => array('div','col-lg-10'),
						  		'password' => array('password','',array('string'=>'Mot de passe invalide'),'',array('class' => 'form-control')),
							'fin div input password' => array('/div'),
						  'fin div password' => array('/div'),
						  'div submit' => array('div','text-center'),
						  	'Connexion' => array('submit','connexion','btn btn-default'),
					      'fin div submit' => array('/div')
						 );
			
			$Form_connexion = new Form(array(), $form_connexion, $this->app, $this->managers) ;
		  
			if ($request->postExists('Connexion'))
			{
				$this->processConnexion($request, $form_connexion) ;
			}
			else
			{
				$this->page->addVar('Connexion_form', $Form_connexion->form());
			}
		}
		else
		{
			$this->app->httpResponse()->redirect('/');
		}
	}
	
	public function executeDeconnexion(\Library\HTTPRequest $request)
	{
		unset($_SESSION['auth']);	
		session_destroy() ;
		$this->app->httpResponse()->redirect('/admin/');
	}
	
	public function processConnexion(\Library\HTTPRequest $request, array $form)
	{
		if(!$this->user->isAdmin())
		{
			$login = $request->postData('login');
			$password = $request->postData('password');
			
			$fields = array ('login' => $login, 'password' => $password) ;
			
			$Form_connexion = new Form($fields, $form, $this->app, $this->managers) ;
			
			$erreur = $Form_connexion->bol() ;
			
			if($erreur === false)
			{
				$user = $this->em('User')->DEF->getUnique(array('login' => $login, 'admin' => true));
				
				if($user)
				{
					$crypt = new Crypt ;
					
					$salt = $user->salt();
					$pass = $crypt->pass($password, $salt, $this->encrypt_key) ;

					if($pass == $user->password())
					{
						$this->user->setAuthenticated(true,'Admin');
						$this->user->setAttribute('id', $user->id());
						
						$this->user->setAttribute('nom', $user->prenom()) ;
						
						$this->app->httpResponse()->redirect('/admin/');
					}
					else
					{
						$this->user->setFlash('Identifiants inccorects');
					}
				}
				else
				{
					$this->user->setFlash('Identifiants inccorects');
				}
			}
			
			$this->page->addVar('Connexion_form', $Form_connexion->form());
		}
		else
		{
			$this->app->httpResponse()->redirect('/');
		}
	}
}