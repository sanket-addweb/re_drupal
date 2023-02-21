<?php

namespace Drupal\factory_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Factory demo form.
 */
class UserLoginForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'factory_demo_user_login';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = [
      '#type'=>'textfield',
      '#title'=>t('Name'),
      '#default_value'=> '',
      '#required'=> true,
      '#attributes'=> [
        'placeholder'=>'Enter Your Name',
      ]
    ];

    $form['email'] = [
      '#type'=>'textfield',
      '#title'=>t('email'),
      '#default_value'=> '',
      '#required'=> true,
      '#attributes'=> [
        'placeholder'=>'Enter Your email',
      ]
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Register'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // if (mb_strlen($form_state->getValue('message')) < 10) {
    //   $form_state->setErrorByName('message', $this->t('Message should be at least 10 characters.'));
    // }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('The message has been sent.'));
    // $form_state->setRedirect('<front>');

    $userId = \Drupal::currentUser()->id();
    $account = \Drupal\user\Entity\User::load($userId);
    $userName2 = $account->getAccountName();
    $email2= $account->getInitialEmail();
    // $email = 'test@domain.co.uk';
    // $email = 'sanket@addwebsolution.in';
    // $email = 'sanet@gmail.com';
    // $extention = pathinfo($email, PATHINFO_EXTENSION);
    // echo $extention;//works

    $reverse = strrev($email2);
    $contents = explode('@', $reverse);
    $emailExt = strrev($contents[0]);
    echo $emailExt;
    // exit;

    // echo($form_state->getValue('email'));
    // dump($email2);//works
    // exit;

    // class emailFactory{
    //   function setRoleByEmail($emailExt){
    //     if($emailExt=='addwebsolution.in'){
    //       // $assignRoles=$account->getRoles();
    //       // dump($assignRoles);
    //       $addRole = $account->addRole('content_editor');
    //       $account->save();
    //     }
    //     else{
    //       // $addRole = $account->addRole('Anonymous');
    //     }
    //   }
    // }
    // if($form_state->getValue('email')=='addwebsolution.in'){
    if($emailExt=='addwebsolution.in'){
      // $assignRoles=$account->getRoles();
      // dump($assignRoles);
      $addRole = $account->addRole('content_editor');
      $account->save();
    }
    else{
      // $addRole = $account->addRole('Anonymous');
    }
  }
  // mayank@addwebsolution.in
}
