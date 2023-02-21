<?php

namespace Drupal\revise_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for revise_module routes.
 */
class ReviseModuleController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

  public function formDataDisplay(){
    $formBuilder = \Drupal:: formBuilder()-> getForm('Drupal\revise_module\Form\CustomerForm');

    return [
      '#theme' => 'customer-form',
      '#title' => 'Customer Form2',
      '#formData' => $formBuilder,
    ];
  }

}
