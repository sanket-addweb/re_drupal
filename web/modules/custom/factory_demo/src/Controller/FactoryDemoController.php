<?php

namespace Drupal\factory_demo\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for factory_demo routes.
 */
class FactoryDemoController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    $txt = \Drupal::service('factory_demo.CheckEmail')->demo32();//Works fine
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t("It works! $txt"),
    ];

    return $build;
  }

}
