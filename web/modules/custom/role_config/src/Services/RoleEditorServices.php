<?php

namespace Drupal\role_config\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\role_config\Services\AddRoleMail;

/**
 * Service description.
 */
class RoleEditorServices {

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

  public function makeEditor($account2) {
    // @DCG place your code here.
    // $role_already = false;
    $getRoles = $account2 ->getRoles();
    // dump($getRoles);
    // dump(in_array('content_editor', $getRoles));//true or false
    if(in_array('content_editor', $getRoles)){
      // $role_already = true;
      \Drupal::messenger()->addMessage(t('You have already present Role as Content editor'),'status');
      return 'Works fine Editor';
    }
    else{
      $addRole = $account2->addRole('content_editor');
      $account2->save();
    

      $assign_role = 'Content editor';
      $role_key = 'assign_editor';
      //Add from here services of mailFunctionality
      \Drupal::service('role_config.AddRoleMailExample')->AddMailService($assign_role,$role_key);

      return 'Works fine Editor';
      // $mailManager = \Drupal::service('plugin.manager.mail');
      // // dump($mailManager);
  
      // $module = 'role_config';
      // $key = 'assign_editor'; //key which is usage in rele_config.module file
      // $to = \Drupal::currentUser()->getEmail();
      // $params['role'] = 'Content editor';
      // /**
      //  * Add Message for Role assign
      //  */
      // /* if($role_already){
      //  *  $params['message'] = "You have already present Role as Content editor";
      //  * }
      //  * else{
      //  *  $params['message'] = "Congratulation! You have assign Role to Content editor";
      //  * }
      //  **/

      // $params['message'] = "Congratulation! You have assign Role to Content editor"/*. $addRole*/;
      // $langcode= \Drupal::currentUser()->getPreferredLangcode();
      // $send = true;
  
      // $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
      // // dump($result);

      // if($result['result'] !== true){
      //   \Drupal::messenger()->addMessage(t('There was problem in sending mail'),'error');
      // }
      // else{
      //   \Drupal::messenger()->addMessage(t('Mail send successfully'),'status');
      // }

      // return 'Works fine Editor';
    }
  
  }

}
