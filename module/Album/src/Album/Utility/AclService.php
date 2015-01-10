<?php
namespace  Album\Utility;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;
class AclService extends Acl{

	public function __construct(){
		
		$this->addResource(new GenericResource('Album\Controller\AlbumController::addAction'));
		$this->addResource(new GenericResource('Album\Controller\AlbumController::deleteAction'));
		$this->addResource(new GenericResource('Album\Controller\AlbumController::editAction'));
		
		
		$this->addRole(new GenericRole('FANS'));
		$this->addRole(new GenericRole('VISITEUR'));
		$this->addRole(new GenericRole('ADMIN'));
		//$parents = array('FANS','VISITEUR','ADMIN');
		
		
		
		$this->allow('ADMIN','Album\Controller\AlbumController::addAction');
		$this->allow('ADMIN','Album\Controller\AlbumController::editAction');
		$this->allow('ADMIN','Album\Controller\AlbumController::deleteAction');
			
		$this->allow('FANS','Album\Controller\AlbumController::addAction');
		$this->deny('FANS','Album\Controller\AlbumController::editAction');
		$this->deny('FANS','Album\Controller\AlbumController::deleteAction');
		
		$this->deny('VISITEUR','Album\Controller\AlbumController::addAction');
		$this->deny('VISITEUR','Album\Controller\AlbumController::editAction');
		$this->deny('VISITEUR','Album\Controller\AlbumController::deleteAction');
		
	}
}
