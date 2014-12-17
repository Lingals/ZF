<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\I18n\Filter\Alpha;
use Album\Model\Album;
use Album\Model\UserTable;
use config\adapter;
use Zend\Authentication\Validator\Authentication;
use Album\Utility\AuthAdapter;



class AuthController extends AbstractActionController{
	
	public function indexAction(){
		$form = $this->createForm();
		
		$request = $this->getRequest();
		if ($request->isPost()){
			$data=$request->getPost();
			$form->setData($data);
			
						
			if ($form->isValid()){
				$serviceManager = $this->getServiceLocator();
				$auth=$serviceManager->get('AlbumAuth');
				$auth->setAdapter(new AuthAdapter($form->get('login')->getValue(),'pass'));
				$r=$auth->authenticate();  
				if ($r->isValid()){
					return $this->redirect()->toRoute('album');
				}else {
					return $this->redirect()->toRoute('auth');
				}
//				$adapter = new Adapter('login','password');
// 				$adapter->authentificate();			
// 				return $this->redirect()->toRoute('album');
				
			}else{
				
				$this->flashMessenger()->addErrorMessage('formulaire incorrect');
			}
		
			
		}else{
			return array('formAuth'=>$form);
		}
		return array('formAuth'=>$form);
	}
	
	protected function createForm(){
		$login = new Element('login');
		$login->setLabel('votre identifiant : ');
		$login->setAttribute('type','text');
		$login->setAttribute('placeholder', 'votre login ');
		
		$password = new Element('password'); 
		$password->setLabel('votre password : ');
		$password->setAttribute('type','password');
		$password->setAttribute('placeholder', 'votre password ');
		
		$mail = new Element('mail');
		$mail->setLabel('votre mail :');
		$mail->setAttribute('type', 'text');
		$mail->setAttribute('placeholder','votre adresse mail');
		
		$form= new Form('identification');
		$form->add($login);
		$form->add($password);
		$form->add($mail);
		
		$inputLogin = new Input('login');
		$inputLogin->setRequired(true);
		$inputLogin->getValidatorChain()->attachByName('alpha');	

		$inputPassword = new Input('password');
		$inputPassword->setRequired(true);
		$inputPassword->getValidatorChain()->attachByName('alnum');
		
		$inputMail = new Input('mail');
		$inputMail->setRequired(true);
		$inputMail->getValidatorChain()->attachByName('emailaddress');
				
		$inputFilter = new InputFilter();
		$inputFilter->add($inputLogin);
		$inputFilter->add($inputPassword);
		$inputFilter->add($inputMail);
		
		$form->setInputFilter($inputFilter);
		return $form;
	}
	public function addAction()
    {
    	$form = new UserForm();
    	$form->get('submitCreate')->setValue('Add');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$user = new UserTable();
    		$form->setInputFilter($user->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$user->exchangeArray($form->getData());
    			$this->getUserTable()->saveUser($user);
    	
    			// Redirect to list of albums
    			return $this->redirect()->toRoute('album');
    		}
    	}
    	return array('form' => $form);
    	 
    }
	
	public function getUserTable()
	{
		if (!$this->userTable) {
			$sm = $this->getServiceLocator();
			$this->userTable = $sm->get('Album\Model\UserTable');
		}
		return $this->userTable;
	}
	
}