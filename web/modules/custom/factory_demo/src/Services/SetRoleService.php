<?php

namespace Drupal\factory_demo\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\user\Entity\User;
use Drupal\factory_demo\AddRolesByClass\EditorRole;
use Drupal\user\UserStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

use Drupal\factory_demo\AddRolesByClass\adminRole;

/**
 * Service description.
 */
class SetRoleService {

  /**
   * The container.
   *
   * @var \Symfony\Component\DependencyInjection\ContainerInterface
   * @var \Drupal\factory_demo\AddRolesByClass\adminRole
   */
  protected $container;
  protected $user;
  protected $role;
  protected $editorRole;
  protected $user_storage;
  protected $entityTypeManager;
  protected $roleEditor;

  protected $adminRole;

  /**
   *
   * @param \Drupal\factory_demo\AddRolesByClass\adminRole $adminRole
   * @param \Drupal\factory_demo\AddRolesByClass\ContainerInterface $container
   */
  public function __construct(adminRole $adminRole,EditorRole $editorRole,ContainerInterface $container){
    $this -> adminRole = $adminRole;
    $this -> editorRole = $editorRole;
    $this-> container = $container;
  }

  public static function create(/*ContainerInterface $container*/){
    return new static(
      $this->container-> get('factory_demo.adminRole'),
      $this->container -> get('factory_demo.editorRole'),
    );
  }

  /**
   * Constructs an ExampleService object.
   *
   * @param \Drupal\user\Entity\User $user
   * @param Drupal\factory_demo\AddRolesByClass\editorRole $editor
   * 
   * * Entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   * 
   */
  // public function __construct(UserStorageInterface $user_storage) {
  //   // $this->container = $container;
  //   // $this->editorRole = $editorRole;
  //   // $this->user = $user;
  //   $this -> $user_storage = $user_storage;
  // }
  // public function __construct(editorRole $editorRole){
  //   // $this->roleEditor = $roleEditor;
  //   $this->editorRole = $editorRole;
  // }

  // public static function create(ContainerInterface $container){
  //   return new static(
  //     //     // $container -> get('module_name.service_mc_name'),
  //       $container -> get('factory_demo.editorRole'),
  //       // $container->get('entity_type.manager'),
  //     );
  // }

  // public function __construct(EntityTypeManagerInterface $entity_type_manager) {
  //   $this->entityTypeManager = $entity_type_manager;
  // }

  // /**
  //  * {@inheritdoc}
  //  *
  //  * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
  //  *   The Drupal service container.
  //  *
  //  * @return static
  //  */

  // public static function create(ContainerInterface $container){
  //   return new static(
  //     // $container -> get('module_name.service_mc_name'),
  //     // $container -> get('factory_demo.editorRole'),
  //     $container->get('entity_type.manager'),
  //   );
  // }

  /**
   * Method description. 
   */
  public function RoleFactory($email,$userId) {
    // @DCG place your code here.
    // $userId = \Drupal::currentUser()->id();
		$account = \Drupal\user\Entity\User::load($userId);
    // $userx = $this->userStorage->load($userId);

    // $addRole = $this->user->addRole('administrator');
    // dump($addRole);
    // exit;
		// $email= $account->getInitialEmail();

    //If pattern is match then preg_split will make part wherever this pattern is found
    //If one match, then give two part, if two matches then give then parts as array
    // $email12 = "sanket@gmail.com";
    $pattern = "/[@\s:]/";
    $components = preg_split($pattern, $email);
    // dump($components[0]);//sanket
    // dump($components[1]);//gmail.com
    // exit;

		if($components[1]=='addwebsolution.in'){
			//Administrator
      // return new adminRole($account);
      $this->adminRole->setAdminRole($account);
			// $addRole = $account->addRole('administrator');
      // $account->save();
		} 
    elseif($components[1] == 'gmail.com'){
      //content_editor
      // $editor= new editorRole();//not works
      $roleAddFun ='';
      // $roleAddFun = $this->editorRole-> setEditorRole($account);//not works
      // return (\Drupal::service('factory_demo.editorRole'))->setEditorRole($account);

      // return $editor->setEditorRole($account);
      // return $this->editorRole->setEditorRole($account);

      $this->editorRole-> setEditorRole($account);
      // $addRole = $account->addRole('content_editor');
      // $account->save();
    }
		else{
      // return new moderatorRole($account);
      $addRole = $account->addRole('moderator');
      $account->save();
		}
    return "works" && $roleAddFun;
    return "works";
  }

}
