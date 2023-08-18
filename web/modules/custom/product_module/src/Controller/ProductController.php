<?php 

/**
 * @file
 * Generates markup to be displayed. Functionality in this Controller 
 * is wired to drupal in product_module.routing.yml 
 */

namespace Drupal\product_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\product_module\CurrentUser;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class to implement controller of mymodule.
 */
class ProductController extends ControllerBase {

  /**
   * Variable to store object of CurrentUser class.
   */
  protected $currentUser;

  /**
   * Constructor to initialise variables.
   * 
   *  @param CurrentUser $current_user
   *    Stores object of CurrentUser class.
   */
  public function __construct( CurrentUser $current_user) {
    $this->currentUser = $current_user;

  }

  /**
   * Function to get the service container.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('product_module.current_user')
    );
  }

  /**
   * Function to check whether current user has customer role.
   */
  public function checkRole() {
    $roles = $this->currentUser->getRole();
    if (in_array('customer', $roles)) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Function to display the first item from the api.
   */
  public function apiCall() {
    $client = \Drupal::httpClient();
    $request = $client->get('http://mod4test.com/api');
      $response = json_decode($request->getBody());
      foreach ($response as $arr => $item) {
        return [
          '#type' => 'markup',
          '#cache' => [
            'max-age' => 0,
          ],
          '#markup' => t(string: 'Title: @title <br> Description:@des<br> Price:@price',args: [
            '@title' => $item->title[0]->value,
            '@des' => $item->body[0]->value,
            '@price' => $item->field_product_price[0]->value,
          ])
              
        ];
      }
  }

  /**
   * Function to redirect to a Thank you page after clicking buy now in product
   *  page.
   */
  public function menu() {
    $username = $this->currentUser->getUsername();
    $config = \Drupal::config('cart_form.settings');
    $nid = $config->get('nid');
    // Loading the details of the node from the node id fetched from cart_form.
    $node_details = Node::load($nid);
    // Fetching details of the node.
    $title = $node_details->getTitle();
    $price = $node_details->field_product_price->value;
    return [
      '#type' => 'markup',
      '#markup' => t(string: 'Thank You for purchasing from us, @user <br> Product name: @pname <br> Price:@price<br>',
          args: ['@user' => $username, '@pname' => $title, '@price' => $price]),
      '#cache' => [
        'tags' => $config->getCacheTags(),
      ],
    ];
  }
}
