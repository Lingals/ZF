<?php
namespace Album\Utility;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;


class AuthAdapter implements AdapterInterface
{
	protected $log;
	protected $pass;
	protected $role;
	/**
	 * Sets username and password for authentication
	 *
	 * @return void
	 */
	public function __construct($username, $password)
	{
		$this->log=$username;
		$this->pass=$password;
	}

	/**
	 * Performs an authentication attempt
	 *
	 * @return \Zend\Authentication\Result
	 * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface
	 *               If authentication cannot be performed
	 */
	public function authenticate()
	{
		//test de l'authetification
		//elle a réussi
		if (strcmp($this->log,'Fan')==0){
		$result = new Result(Result::SUCCESS,array(
			'login'=>$this->log,
				'role'=>'FANS',
		)
		);
		}elseif (strcmp($this->log,'Visiteur')==0){
		$result = new Result(Result::SUCCESS,array(
			'login'=>$this->log,
				'role'=>'VISITEUR',
		)
		);
		}elseif (strcmp($this->log,'Admin')==0){
		$result = new Result(Result::SUCCESS,array(
			'login'=>$this->log,
				'role'=>'ADMIN',
		)
		);
		}
		else{
		$result = new Result(Result::FAILURE,$this->log);	
		}
		return $result;
	}
}