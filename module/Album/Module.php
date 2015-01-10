<?php
namespace Album;

//use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
//use Zend\ModuleManager\Feature\ConfigProviderInterface;

// Add these import statements:
use Album\Model\Album;
use Album\Model\AlbumTable;
use Album\Model\UserTable;
use Album\Model\User;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;
use Zend\Permissions\Acl\Acl;
use Album\Utility\AclService;

class Module
{
 public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }

	// Add this method:
	public function getServiceConfig()
	{
		return array(
				'factories' => array(
						'Album\Model\AlbumTable' =>  function($sm) {
							$tableGateway = $sm->get('AlbumTableGateway');
							$table = new AlbumTable($tableGateway);
							return $table;
						},
						'AlbumTableGateway' => function ($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Album());
							return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
						},
// 						'Album\Model\UserTable' =>  function($sm) {
// 							$tableGateway = $sm->get('AlbumTableGateway');
// 							$table = new UserTable($tableGateway);
// 							return $table;
// 						},
// 						'UserTableGateway' => function ($sm) {
// 							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
// 							$resultSetPrototype = new ResultSet();
// 							$resultSetPrototype->setArrayObjectPrototype(new Album());
// 							return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
// 						},
						'AlbumAuth'=>function($sm){
							$auth=new AuthenticationService();
							$auth->setStorage(new Session());
							return $auth;
						},
						'AclService'=>function($m){
							$acl=new AclService();
							return $acl;
						},
				),
		);
	}
}