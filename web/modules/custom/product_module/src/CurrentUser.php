<?php 

namespace Drupal\product_module;

use Drupal\Core\Session\AccountProxyInterface;

/**
 * Service class to get role of current user.
 * 
 *  @var string $currentUser
 *    To store curent user.
 */
class CurrentUser {

  /**
   * Variable to store current user.
   */ 
  protected $currentUser;

  /**
   * Constructor to initialise class variable.
   * 
   *  @param object $current_user
   *    Instance of AccountProxyInterface class. 
   */
  public function __construct(AccountProxyInterface $current_user) {
    $this->currentUser = $current_user;
  }
  /**
   * Function to get role of the current user.
   */
  public function getRole() {
    return $this->currentUser->getRoles();
  }

   /**
   * Function to get username of the current user.
   */
  public function getUsername() {
    return $this->currentUser->getAccountName();
  }
}
