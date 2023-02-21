<?php
namespace Drupal\role_config\AddRoleClass;

class editorRole {
	public function getUserNameWithRole($account){
		$addRole = $account->addRole('content_editor');
    $account->save();
	}
}
?>