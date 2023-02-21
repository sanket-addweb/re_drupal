<?php

namespace Drupal\revise_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface; 

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "form_block",
 *   admin_label = @Translation("form block"),
 *   category = @Translation("form block")
 * )
 */

class CustomFormBlock extends BlockBase{

	/** 
	 *  {@inheritdoc} 
	 */ 
	public function build() { 
		$form = \Drupal::formBuilder()->getForm('Drupal\revise_module\Form\CustomerForm'); 
		return $form; 
	}
}




	// /**
	//  * {@inheritdoc}
	//  */
	// public function defaultConfiguration() {
	// 	return [
	// 	'enabled' => 1,
	// 	];
	// }

	// /**
 	// * {@inheritdoc}
 	// */

	// public function blockForm($form, FormStateInterface $form_state) {
	// 	$config = $this->getConfiguration();
	// 	$form['enabled'] = array(
	// 		'#type' => 'checkbox',
	// 		'#title' => $this->t('Enabled'),
	// 		'#description' => $this->t('Check this box if you want to enable this feature.'),
	// 		'#default_value' => $config['enabled'],
	// 	);
	// 	return $form;
	// }

	// /**
 	// * {@inheritdoc}
 	// */
	// public function blockSubmit($form, FormStateInterface $form_state) {
 	// 	$this->configuration['enabled'] = $form_state->getValue('enabled');
	// }

// }