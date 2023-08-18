<?php
/**
 * @file
 * Contains \Drupal\product_module\Plugin\Block\FormBlock.
 */

namespace Drupal\product_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'Form' block.
 *
 * @Block(
 *   id = "form_block",
 *   admin_label = @Translation("Form block"),
 *   category = @Translation("Custom Form block example")
 * )
 */
class FormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Fetching custom form to be shown in the block.
    $form = \Drupal::formBuilder()->getForm('Drupal\product_module\Form\CartForm');
    
    return $form;
   }
}
