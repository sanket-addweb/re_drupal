<?php

namespace Drupal\role_config\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\role_config\Services\AddRoleMail;

/**
 * Service description.
 */
class RoleAdminServices {

  protected $container;
  protected $addMail;

  // /**
  //  * Constructs a RoleEditorServices object.
  //  *
  //  * @param  Drupal\role_config\Services\AddRoleMail $addMail
  //  *   The container.
  //  */

  public function __construct(AddRoleMail $addMail){
    $this->addMail = $addMail;
  }

  /**
   * {@inheritdoc}
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The Drupal service container.
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container -> get('role_config.AddRoleMailExample')

    );
  }

  /**
   * Method description.
   */

  public function makeAdministrator($account2) {

    $getRoles = $account2 ->getRoles();

    if(in_array('administrator', $getRoles)){

      \Drupal::messenger()->addMessage(t('You have already present Role as Administrator'),'status');
      return 'Works fine Administrator';
    }
    else{
      $addRole = $account2->addRole('administrator');
      $account2->save();
    
      $assign_role = 'Administrator';
      $role_key = 'assign_admin';
      //Add from here services of mailFunctionality
      // \Drupal::service('role_config.AddRoleMailExample')->AddMailService($assign_role,$role_key);
      $this->addMail->AddMailService($assign_role,$role_key);
      return 'Works fine Administrator';

    }

  }

}

