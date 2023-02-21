<?php

namespace Drupal\example_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the 'example_field_widget' field widget.
 *
 * @FieldWidget(
 *   id = "example_field_widget",
 *   label = @Translation("RGB value as #ffffff"),
 *   field_types = {
 *    "string",
 *    "example_fieldtype",
 *    "text_long",
 *   },
 * )
 */
class ExampleFieldWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Create the custom setting 'size', and
      // assign a default value of 60
      'size' => 60,
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['size'] = [
      '#type' => 'number',
      '#title' => $this->t('Size of textfield'),
      '#default_value' => $this->getSetting('size'),
      '#required' => TRUE,
      '#min' => 1,
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $summary[] = $this->t('Textfield size: @size', array('@size' => $this->getSetting('size')));

    return $summary;
  }


  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    // dump($items);//got the array [#list]
    // dump($delta);//got the array index
    // dump(($items[$delta]->value));//got the value while editing node if we added previously 
    // exit;

    $element['value'] = $element + [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
      '#description' => t('Please enter color code in # value'),
      '#prefix' => 'Write Your # color code in below textbox',
      '#size' => 7,
      '#maxlength' => 7,
      '#element_validate' => [
        [static::class, 'validate'],
      ],
    ];

    return $element;
  }

  /**
   * Validate the color text field.
   */
  public static function validate($element, FormStateInterface $form_state) {
    // dump($element);//Got '#value' inside that got field value
    // exit;
    $value = $element['#value'];
    if (strlen($value) == 0) {
      $form_state->setValueForElement($element, 'Please enter value');
      return;
    }
    if (!preg_match('/^#([a-f0-9]{6})$/iD', strtolower($value))) {
      $form_state->setError($element, t("Color must be a 6-digit hexadecimal value, suitable for CSS."));
    }
  }

  

  // /**
  //  * {@inheritdoc}
  //  */
  // public function defaultSettings(){
  //   return [
  //     'size' => 60,
  //     // 'placeholder' => '',
  //   ]+ parent::defaultSettings();
  // }

  // /**
  //  * {@inheritdoc}
  //  */
  // public function settingsForm(array $form, FormStateInterface $form_state){
  //   $elements = [];

  //   $elements['size'] = [
  //     '#type' => 'number',
  //     '#title' => t('Size of textfield'),
  //     '#default_value' => getSettings('size'),
  //     '#required' => TRUE,
  //     '#min' => 1,
  //   ];

  //   return $elements;

  // }
  // public function settingsSummary() {
  //   $summary = [];

  //   $summary = t('Textfield Size: @size', ['@size' => $this->getSetting('size')]);
  //   return $summary;
  // }
  

  // public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
  //   $value = isset($items[$delta]->value) ? $items[$delta]->value : '';
  //   $element += [
  //     '#type' => 'textfield',
  //     '#default_value' => $value,
  //     '#size' => 7,
  //     '#maxlength' => 7,
  //     '#element_validate' => [
  //       [static::class, 'validate'],
  //     ],
  //   ];
  //   return ['value' => $element];
  // }


}
