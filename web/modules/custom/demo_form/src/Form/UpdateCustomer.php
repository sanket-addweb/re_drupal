<?php

namespace Drupal\demo_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class UpdateCustomer extends FormBase{
	public function getFormId(){
		return 'customer_form';
	}
	public function buildForm(array $form, FormStateInterface $form_state){
		$id = \Drupal::routeMatch()->getParameter('id_here');

		$results = \Drupal::database() -> select('customers', 'c')
			-> fields('c')
			-> condition('id', $id)
			-> execute();
		foreach($results as $rows){
			$name = $rows -> name;
			$email = $rows -> email;
		}
		
		$form['id'] = [
			'#type' => 'number',
			'#title' => t('Userid'),
			'#default_value' => $id,
			'#disabled' => true,
		];
		$form['name'] = [
			'#type' => 'textfield',
			'#title' => t('Name'),
			'#default_value' => $name,
			'#required' => true,
			'#attributes' => [
				'placeholder' => 'Enter you Name',
			],
		];
		$form['email'] = [
			'#type' => 'textfield',
			'#title' => t('Email'),
			'#required' => true,
			'#default_value' => $email,
			'#attributes' => [
				'placeholder' => 'Enter Email',
			],
		];
		$form['save'] = [
			'#type' => 'submit',
			'#value' => 'Update Now',
			'#button_type' => 'primary',
		];
		return $form;
	}

	public function submitForm(array &$form, FormStateInterface $form_state){
		$name = $form_state->getValue('name');
		$email = $form_state->getValue('email');

		$id = \Drupal::routeMatch()->getParameter('id_here');
		\Drupal::database()->update('customers')
			->fields(['name'=>$name,'email' => $email])
			->condition('id',$id)
			->execute(); 
		$response = new \Symfony\Component\HttpFoundation\RedirectResponse('../customers-list');
		$response->send();
		\Drupal::Messenger()-> addMessage(t("$name your form is updated successfully"));
	}


}