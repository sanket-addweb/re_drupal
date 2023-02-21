<?php

namespace Drupal\role_config;

class ContentFactory {
    protected $user;

    public function MakeUserRole($account=null, $email){

        if($emailExt =='addwebsolution.in'){
            return $this->user = new editorRole($account);
        }
        else{
            return $this->user = new otherUserRole();
        }
    }
}