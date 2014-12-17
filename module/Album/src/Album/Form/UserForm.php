<?php
namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form
{
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('user');

		$this->add(array(
				'name' => 'id',
				'type' => 'Hidden',
		));
		$this->add(array(
				'name' => 'login',
				'type' => 'Text',
				'options' => array(
						'label' => 'Login',
				),
		));
		$this->add(array(
				'name' => 'password',
				'type' => 'Password',
				'options' => array(
						'label' => 'password',
				),
		));
		$this->add(array(
				'name' => 'email',
				'type' => 'Text',
				'options' => array(
						'label' => 'email',
				),
		));
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Log on',
						'id' => 'submiAuthtbutton',
				),
		));
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Creer un compte',
						'id' => 'submitCreatebutton',
				),
		));
	}
}