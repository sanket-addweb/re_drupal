<?php

namespace Drupal\custom_access\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for custom_access routes.
 */
class CustomAccessController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    // // Returns a Drupal\Core\Datetime\DateFormatter object.
    // $date = \Drupal::service('date.formatter');

    // $account=\Drupal::service('current user')->getAccount();
    // $account = \Drupal::currentUser();
    // $result = \Drupal::service('custom_access.custom_access_services')->access($account);
    // dump($result);//If it has custom access then return object of AccessResultAllowed else AccessResultForbidden
    // exit;
    // if($result){
    //   return;
    // }

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
