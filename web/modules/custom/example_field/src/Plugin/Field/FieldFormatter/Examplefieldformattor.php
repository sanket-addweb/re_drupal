<?php

namespace Drupal\example_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'ExampleFieldFormattor' formatter.
 *
 * @FieldFormatter(
 *   id = "example_field_examplefieldformattor",
 *   label = @Translation("ExampleFieldFormattor"),
 *   field_types = {
 *     "string",
 *     "text_long",
 *     "example_fieldtype",
 *   }
 * )
 */
class Examplefieldformattor extends FormatterBase {

  /**
  * {@inheritdoc}
  */
  public static function defaultSettings(){
    return [
        'concatenated' => 1, 
        //Implement default settings
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state){
    return [
      //Implement settings form.
      'concatenated' => [
        '#type' => 'checkbox',
        '#title' => $this->t('Concatenated'),
        '#description' => $this->t('Whether to concatenate the code and number into a single string separated by a space. Otherwise the two are broken up into separate span tags.'),
        '#default_value' => $this->getSetting('concatenated'),
      ],
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary(){
    $summary = [];
    //Implement settings summary.
    $summary[] = $this->t('Concatenated: @value', ['@value' =>(bool) $this->getSetting('concatenated') ? $this->t('Yes') : $this->t('No')]);
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    // dump($items);
    // dump($element);
    
    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#markup' => '<h1>'. $item->value . '</h1>',
      ];
      // dump($item);
    }
    // dump($element);
    // exit;
    return $element;
  }

  /**
   * Generate the output appropriate for one field item.
   * 
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   one field item.
   * 
   * @return string
   *   The textual output generated.
   */
  public function viewValue(FieldItemInterface $item){
    return [
      '#markup' => $item->value,
    ];
  }

}
