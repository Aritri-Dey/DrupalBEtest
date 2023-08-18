<?php
/**
 * @file
 * Contains \Drupal\product_module\Form\CartForm.
 */
namespace Drupal\product_module\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Routing\TrustedRedirectResponse;

class CartForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cart_form';
  }

  /**
   * {@inheritDoc}
   */
  public function getEditableConfigNames() {
    return [
      'cart_form.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['add_to_cart'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add to cart'),
      '#suffix' => '<div id="msg">',
      '#ajax' => [
        'callback' => '::showMsg',
      ],
    ];

    $form['buy_now'] = [
      '#type' => 'submit',
      '#value' => $this->t('Buy Now'),
      '#prefix' => '<br>',
      '#submit' => ['::submitForm'],
    ];

    // Hidden field to store the node id of the current node.
    $form['nid'] = [
      '#type' => 'hidden',
      '#value' => '',
    ];

    return $form;
  }

  /**
   * Function to show message when add_to_cart button is clicked.
   * 
   *  @param $form
   *    Stores the form
   *  @param FormStateInterface $form_state
   *    Stores form_state values.
   */
  public function showMsg($form, FormStateInterface $form_state) {
    $ajax_res = new AjaxResponse();
    $ajax_res->addCommand(new HtmlCommand('#msg', 'Product has been added to cart'));
    return $ajax_res;
  }


   /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('cart_form.settings');
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof \Drupal\node\NodeInterface) {
      $nid = $node->id();
    }
    // Setting the value of node id to retrieve in controller.
    $config->set('nid', $nid);
    $config->save();
    $form_state->setRedirect('product_module.admin');
    return;
  }
}
