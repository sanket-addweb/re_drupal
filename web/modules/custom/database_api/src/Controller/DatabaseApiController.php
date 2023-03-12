<?php

namespace Drupal\database_api\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for database_api routes.
 */
class DatabaseApiController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {


    //Normal method insert query builder
    // $database = \Drupal::database();
    // \Drupal::database()->insert('players')
    //   ->fields(
    //     ['name' => 'Mohit', 'data' => serialize(['known for' => 'Hand of god'])],
    //     )
    //   ->execute();

    // $fields = ['name' => 'Diego M', 'data' => serialize(['known
    // for' => 'Hand of God'])];
    // $id = $database->insert('players')
    //   ->fields($fields)
    //   ->execute();

    // //Added fields and values seperatly
    // $values =['name' => 'Novak D.', 'data' => serialize(['sport' =>'tennis'])];
    // $fields = ['name', 'data'];
    
    // \Drupal::database()->insert('players')
    //   ->fields($fields)
    //   ->values($values)
    //   ->execute();

    // // //Added more than one record at a time
    // $values = [
    //   ['name' => 'Novak D.asasasa', 'data' => serialize(['sport' =>
    //   'tennis'])],
    //   ['name' => 'Michael Pasasas.', 'data' => serialize(['sport' =>
    //   'swimming'])]
    // ];
    // $fields = ['name', 'data'];

    // $query=\Drupal::database()->insert('players')
    //   ->fields($fields);
    
    // foreach($values as $value){
    //   $query->values($value)
    //     ->execute();
    // }

    $database=\Drupal::database();

    //Delete query
    // $result = $database->delete('players')
    //   ->condition('name', 'Mohit')
    //   ->execute();

    // $database->query('delete from players where id = 7');
    // $database->query("insert into players (`name`) values('Mohan')");


    //Insert query over we truncate table by
    // \Drupal::database()->query("truncate table players");
    //Make sure that You This will remove record from table


    //Select query start
    $results = $database->select('players','p')
      ->fields('p')
      ->execute()->fetchAll();
    echo 'pre';
    dump($results);

    $data12 = [];
    foreach($results as $rows){
      // $data['name']=$rows->name;
      // $data['id'] = $rows->id;
      $data12[] = [
        $rows ->name,
        $rows ->id,
        $rows -> data,
      ];
    }
    dump($data12);

    //fetch record with conditions
    $results = $database->select('players','p')
      ->fields('p')
      ->condition('id',2)
      ->execute()->fetchAll();

    dump($results);
    dump($results[0]->name);//"Diego M"

    //Update query
    $result = $database->update('players')
      ->fields(['data' => serialize([
        'sport' => 'swimming',
        'feature' => 'This guy can swim'
      ])])
      ->condition('name', 'Manoj')
      ->execute();
    

    $results1 = $database->select('players','p')
      ->fields('p')
      ->condition('id',6)
      ->execute()->fetchAll();

    dump($results1[0]->data);

    $result122 = $database->query("SELECT * FROM {players} p JOIN
    {teams} t ON t.[id] = p.[team_id] WHERE p.[id] = :id", [':id'
    => 1]); 

    dump($result122);
    $data122 = [];
    foreach($result122 as $rows){
      // $data['name']=$rows->name;
      // $data['id'] = $rows->id;
      $data122[] = [
        $rows ->name,
        $rows ->id,
        $rows -> data,
      ];
    }
    dump($data122);

    print_r('success');
    exit;


    $database = \Drupal::database();
    $result = $database->query("SELECT * FROM {players} WHERE [id]= :id", [':id' => 1]);

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
