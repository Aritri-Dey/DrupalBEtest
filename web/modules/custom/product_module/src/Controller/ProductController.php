<?php 

/**
 * @file
 * Generates markup to be displayed. Functionality in this Controller 
 * is wired to drupal in product_module.routing.yml 
 */

namespace Drupal\product_module\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\product_module\CurrentUser;
use Drupal\product_module\FormAlterService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class to implement controller of mymodule.
 */
class ProductController extends ControllerBase {


  protected $formAlterService;
  protected $currentUser;

  public function __construct( CurrentUser $current_user) {
    $this->currentUser = $current_user;

  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('product_module.current_user')
    );
  }

  public function checkRole() {
    $roles = $this->currentUser->getRole();
    if (in_array('customer', $roles)) {
      return TRUE;
    }
    return FALSE;
  }

  public function apiCall() {
    $counter = 0;
    $client = \Drupal::httpClient();
    $request = $client->get('http://mod4test.com/api');
      $response = json_decode($request->getBody());
      foreach ($response as $arr => $item) {
        // dd($arr->body[0]);
        // dd($arr->body[0]->value);
        // dd($arr->field_product_price[0]->value);
        // dd($arr->title[0]->value);
        // $val[$counter]['title'] = $arr->title[0]->value;
        // $val[$counter]['body'] = $arr->body[0]->value;
        // $val[$counter]['price'] = $arr->field_product_price[0]->value;
        // $counter++;
        // dd($item->field_product_price[0]->value);
        
        $elements[$arr] = [
          '#theme' => 'api_view',
          '#title' => $item->title[0]->value,
          '#body' => $item->body[0]->value,
          '#price' => $item->field_product_price[0]->value,
        ];
      }
      // dd($elements);
      return $elements;
  }

}

