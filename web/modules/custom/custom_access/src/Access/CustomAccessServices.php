<?php
namespace Drupal\custom_access\Access;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

class CustomAccessServices implements AccessInterface{
	// public function access($account){
	public function access(AccountInterface $account){
		// dump($account);//Got Account details of current user
		// dump($account->hasPermission('allow custom access'));//True for ADMINISTRATOR
		// exit;
		return $account->hasPermission('allow custom access') ? AccessResult::allowed() : AccessResult::forbidden();
	}
}

?>