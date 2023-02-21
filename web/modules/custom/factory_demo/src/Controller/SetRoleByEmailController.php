<?php
namespace Drupal\factory_demo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\factory_demo\Services\SetRoleService;
use Drupal\Core\Session\AccountProxyInterface;
/**
 * Returns responses for factory_demo routes.
 */

class SetRoleByEmailController extends ControllerBase{

  private $setRoleByMail;
  private $account;

  /**
   *
   * @param \Drupal\factory_demo\Services\SetRoleService $setRoleByMail
   */
  public function __construct(SetRoleService $setRoleByMail, AccountProxyInterface $account) {
    $this->setRoleByMail = $setRoleByMail;
    $this->account = $account;
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
      $container->get('factory_demo.SetRoleService'),//For Making setRoleByemail object, we are calling SetRoleService class
      $container->get('current_user')
    );
  }

  /**
   * Builds the response.
   */
  public function build() {
    // $userId = \Drupal::currentUser()->id();
    $userId = $this->account->id();//works
    $account2= $this->account->getAccount();//works
    $email2 = $this->account->getEmail();

    // dump($email2);
    // $addRole = $account2->addRole('administrator');//Not works not found this method in accountInterface and acoountProxyInterface
    //I found addRole methods in Drupal\user\Entity\User class so I use that class in factory_demo.SetRoleService services
    // dump($addRole);
    // exit;
    $txt = $this->setRoleByMail-> RoleFactory($email2,$userId);
    // $txt = (\Drupal::service('factory_demo.example'))->RoleFactory($email2);
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t("It works! $txt"),
      '#cache' => [
        'max-age' => 0,//If you do not clear cache on this page then changes not reflected to admin/people
      ],
    ];

    return $build;
  }

}

?>