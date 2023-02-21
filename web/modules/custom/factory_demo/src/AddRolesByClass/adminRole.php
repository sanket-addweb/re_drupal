<?php

namespace Drupal\factory_demo\AddRolesByClass;

class adminRole {
  public function setAdminRole($account){
    $addRole = $account->addRole('administrator');
    $account->save();
    \Drupal::messenger()->addMessage(t('Administrator role added'),'status');
  }
}