<?php
namespace Drupal\factory_demo;

class AssignRole{
	public function checkUserEmail(){
		$userId = \Drupal::currentUser()->id();
		$account = \Drupal\user\Entity\User::load($userId);
		$email2= $account->getInitialEmail();

		$reverse = strrev($email2);
		$contents = explode('@', $reverse);
		$emailExt = strrev($contents[0]);
		if($emailExt=='addwebsolution.in'){
			//content_editor
			$addRole = $account->addRole('content_editor');
      		$account->save();
		}
		else{
			//Administrator
		}
	}
}


?>