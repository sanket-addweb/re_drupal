<?php

namespace Drupal\factory_demo\AddRolesByClass;

class EditorRole {
   
  public function setEditorRole($account){
    $addRole = $account->addRole('content_editor');
    $account->save();
    \Drupal::messenger()->addMessage(t('Editor role added'),'status');
    // \Drupal::messenger()->addMessage(t('You have already present Role as Content editor'),'status');
  }
}