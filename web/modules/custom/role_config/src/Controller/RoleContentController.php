<?php

namespace Drupal\role_config\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\role_config\ContentFactory;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\role_config\Services\RoleEditorServices;
use Drupal\Core\Session\AccountProxyInterface;

use Drupal\role_config\Services\RoleAdminServices;
use Drupal\role_config\Services\RoleModeratorServices;
// use Drupal\user\UserStorageInterface;
// use Drupal\Core\Entity\EntityTypeManager;

/**
 * Returns responses for role_config routes.
 */
class RoleContentController extends ControllerBase {

  // private $content;
  private $editor;
  private $account;
  private $administrator;
  private $moderator;
  // private $userStorage;
  // protected $entityTypeManager;

  public function __construct(RoleEditorServices $editor, RoleAdminServices $administrator, AccountProxyInterface $account, RoleModeratorServices $moderator /*, UserStorageInterface $user_storage,*/ /* EntityTypeManager $entityTypeManager */){
    // $this->content = new ContentFactory();
    $this -> editor = $editor;
    $this -> administrator = $administrator;
    $this -> account = $account;
    $this -> moderator = $moderator;
    // $this -> userStorage = $user_storage;
    // $this -> entityTypeManager = $entityTypeManager;
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
      $container -> get('role_config.editorExample'),
      $container -> get('role_config.adminExample'),
      $container -> get('current_user'),
      $container -> get('role_config.moderatorExample'),
      // $container -> get('entity_type.manager')->getStorage('user'),
      // $container -> get('entity_type.manager'),
    );
  }

  public function getRoleFactory(){

    //For UserStorageInterface implementation
    // $userIdx = $this->account->id();
    // dump($userIdx);
    // // dump($this->userStorage);//works
    // $userx = $this->userStorage->load($userIdx);//works
    // dump($userx);
    // dump($userx->getRoles());
    // $addRole = $userx->addRole('moderator');
    // dump($addRole);
      // $account2->save();

    //For entityTypeManager implementation
    // dump($user = $this -> entityTypeManager->getStorage('user')->load($this->account->id()));
    // dump($user->getRoles());//works
    // $addrole = $user -> addRole('adad');//Not works
    // dump($addRole);


    // exit;

    //Drupal global methods

    // $user = \Drupal::currentUser();
    // // dump($user);

    // $userId = $user->id();
    // // dump($userId);

    // $account2 = \Drupal\user\Entity\User::load($userId);
    // // dump($account2);

    // // $email = $user->getEmail();
    // $email = $user->getEmail();
    // dump($email);
    // $account2->addRole('roleToAdd');
    // $newRole=$account2->getRoles();
    // dump($newRole);
    // $user->save();
    // exit;


    //By using dependency injection
    $userId22 = $this->account->id();//works
    $account2 = \Drupal\user\Entity\User::load($userId22);
    // $account22= $this->account->getAccount();//works but not containt addRole methods
    $email22 = $this->account->getEmail();
    // dump($email22);//works


    $pattern = "/[@\s:]/";
    $components = preg_split($pattern, $email22);

    if($components[1]=='addwebsolution.in'){
			//Administrator
      // return new adminRole($account);
      $txt = $this->administrator->makeAdministrator($account2);
		} 
    elseif($components[1] == 'gmail.com'){
      //content_editor 
      // return (\Drupal::service('role_config.example'))->doSomething($account2);//works

      //Check using global services
      // $txt = (\Drupal::service('role_config.editorExample'))->makeEditor($account2);

      $txt = $this->editor->makeEditor($account2);
    }
		elseif($components[1] == 'realestate.in'){
      // return new moderatorRole($account);
      $txt = $this->moderator->makeModerator($account2);
      // $addRole = $account2->addRole('moderator');
      // $account2->save();
		}

    return [
      '#markup' => "This is works and $txt",
      '#cache' => [
        'max-age' => 0,
      ],
    ];
  }
  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t("It works!"),
    ];

    return $build;
  }

}
