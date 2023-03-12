<?php

namespace Drupal\demo_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomerForm extends FormBase{
	public function getFormId(){
		return 'customer_form';
	}
	public function buildForm(array $form, FormStateInterface $form_state){
		$form['name'] = [
			'#type' => 'textfield',
			'#title' => t('Name'),
			'#default_value' => '',
			'#required' => true,
			'#attributes' => [
				'placeholder' => 'Enter you Name',
			],
		];
		$form['email'] = [
			'#type' => 'textfield',
			'#title' => t('Email'),
			'#required' => true,
			'#attributes' => [
				'placeholder' => 'Enter Email',
			],
		];
		$form['save'] = [
			'#type' => 'submit',
			'#value' => 'Register Now',
      '#button_type' => 'primary',
		];
		return $form;
	}

	public function validateForm(array &$form, FormStateInterface $form_state){
		$name = $form_state->getValue('name');
		$email = $form_state->getValue('email');
		if(empty($form_state->getValue('name'))){
			$form_state->setErrorByName('name', $this->t('Name is required'));
		}
		elseif(!preg_match("/^[a-zA-Z ]*$/",$name)){
			$form_state->setErrorByName('name', $this->t('Please enter valid name'));
		}
		elseif(trim($email)==''){
			$form_state->setErrorByName('email', $this->t('Email is required'));
		}
		elseif(!preg_match('/@.+\./', $email)){
			$form_state->setErrorByName('email', $this->t('Please enter valid Email'));
		}
	}

	public function submitForm(array &$form, FormStateInterface $form_state){
		$name = $form_state->getValue('name');
		$email = $form_state->getValue('email');
		echo "$name and email is $email";

		\Drupal::database()->insert('customers')
			->fields(['name','email'])
			->values([
				$form_state ->getValue('name'),
				$form_state -> getValue('email'),
			])
			->execute();
		
		\Drupal::Messenger()-> addMessage(t("$name your form is submitted successfully"));
	}


}