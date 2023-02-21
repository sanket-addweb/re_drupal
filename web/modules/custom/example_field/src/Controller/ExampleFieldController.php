<?php

namespace Drupal\example_field\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for example_field routes.
 */
class ExampleFieldController extends ControllerBase {

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

}
