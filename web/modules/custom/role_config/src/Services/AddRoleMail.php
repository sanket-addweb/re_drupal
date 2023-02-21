<?php
namespace Drupal\role_config\Services;

class AddRoleMail{
	public function AddMailService($assign_role, $role_key){
		$mailManager = \Drupal::service('plugin.manager.mail');
		// dump($mailManager);
	
		$module = 'role_config';
		// $key = 'assign_admin'; //key which is usage in rele_config.module file
		$key = $role_key;
		$to = \Drupal::currentUser()->getEmail();
		// $params['role'] = 'Administrator';
		$params['role'] = $assign_role;
	
		$params['message'] = "Congratulation! You have assign Role to $assign_role"/*. $addRole*/;
		$langcode= \Drupal::currentUser()->getPreferredLangcode();
		$send = true;
	
		$result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
		// dump($result);
	
		if($result['result'] !== true){
			\Drupal::messenger()->addMessage(t('There was problem in sending mail'),'error');
		}
		else{
			\Drupal::messenger()->addMessage(t('Mail send successfully by mail services'),'status');
		}

	}
}