<?php

namespace Drupal\role_config\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for role_config routes.
 */
class RoleConfigController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $config = \Drupal::config('role_config.settings');
    // Will print 'Hello'.
    // dump($config->get('message'));//works

    $config = \Drupal::service('config.factory')->getEditable('role_config.settings');

    // Set and save new message value.
    //Comment this otherwise every time hitting url, change config
    // $config->set('message', 'Hi new')->save();

    // Now will print 'Hi'.
    $msg= $config->get('message');
    // dump($msg);//works
    // exit;
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t("It works and $msg!"),
    ];

    return $build;
  }

}
