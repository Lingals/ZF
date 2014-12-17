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
		if (strcmp($this->log,'lingals')==0){
		$result = new Result(Result::SUCCESS,$this->log);
		}else{
		$result = new Result(Result::FAILURE,$this->log);	
		}
		return $result;
	}
}