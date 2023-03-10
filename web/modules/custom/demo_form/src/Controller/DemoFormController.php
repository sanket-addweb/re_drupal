<?php

namespace Drupal\demo_form\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for demo_form routes.
 */
class DemoFormController extends ControllerBase {

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
