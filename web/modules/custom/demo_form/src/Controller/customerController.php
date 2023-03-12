<?php
namespace Drupal\demo_form\Controller;

use Drupal\Core\Controller\ControllerBase;

class customerController extends ControllerBase{

	public function customerList(){
		$data = [];
		$results = \Drupal::database() -> select('customers', 'c')
			-> fields('c')
			-> execute();
		$no = 1;
		foreach($results as $rows){
			$data[] = [
				's_no' => $no,
				'name' => $rows -> name,
				'email' => $rows -> email,
				'edit'=>t("<a href='edit-customer/$rows->id'>Edit</a>"),
        'delete'=>t("<a href='delete-customer/$rows->id'>delete</a>"),
			];
			$no = $no + 1;
		}

		$header = ['S.No', 'Name', 'Email','Edit','Delete'];
		return [
			'#type' => 'table',
			'#header' => $header,
			'#rows' => $data,
			'#cache'=> [
				'max-age'=> 0,
			],
		];
	}

	public function deleteCustomer(){

		// return [
		//   '#type' => 'item',
		//   '#markup' => $this->t('It works!'),
		// ];
		// exit; 
		$id = \Drupal::routeMatch()->getParameter('id_here');
		\Drupal::database()->delete('customers')
		  ->condition('id',$id)
			->execute();
    //Above works okay and deleted data successfully
		//But redirection path not got, It show this path, so remove demo-form from RedirectResponse()
		//http://localhost/web/re_drupal/web/demo-form/demo-form/customers-list 
		$response = new \Symfony\Component\HttpFoundation\RedirectResponse('../customers-list');
		$response->send();
		\Drupal:: Messenger()->addMessage(t('Your record deleted successfully'));
		
	}
}





?>