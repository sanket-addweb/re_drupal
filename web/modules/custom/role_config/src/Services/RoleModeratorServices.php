<?php

namespace Drupal\role_config\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\role_config\Services\AddRoleMail;

/**
 * Service description.
 */
class RoleModeratorServices {

  /**
   * The container.
   *
   * @var \Symfony\Component\DependencyInjection\ContainerInterface
   */
  protected $container;

  /**
   * Constructs a RoleEditorServices object.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The container.
   */
  public function __construct(ContainerInterface $container, AddRoleMail $addMail) {
    $this->container = $container;
    $this -> addMail = $addMail;
  }

  public static function create(){
    return new static(
      $this->container->get('role_config.AddRoleMailExample'),
    );
  }

  /**
   * Method description.
   */
  // public function doSomething($account2) {
  public function makeModerator($account2) {

    $getRoles = $account2 ->getRoles(); 
    // moderator
    //make sure you have create Role moderator for user

    if(in_array('moderator', $getRoles)){

      \Drupal::messenger()->addMessage(t('You have already present Role as Moderator'),'status');
      return 'Works fine Moderator';
    }
    else{
      $addRole = $account2->addRole('moderator');
      // $addRole = $account2->addRole('invester');
      $account2->save();
    
      $assign_role = 'Moderator';
      $role_key = 'assign_moderator';
      //Add from here services of mailFunctionality
      // \Drupal::service('role_config.AddRoleMailExample')->AddMailService($assign_role,$role_key);
      $this->addMail->AddMailService($assign_role,$role_key);
      return 'Works fine Moderator';

    }
  }

}
