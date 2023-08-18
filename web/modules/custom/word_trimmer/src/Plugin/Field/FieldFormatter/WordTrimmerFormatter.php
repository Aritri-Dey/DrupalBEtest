<?php 

/**
 * @file
 * Contains \Drupal\product_module\Plugin\Field\FieldFormatter\WordTrimmerFormatter.
 */
namespace Drupal\product_module\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'word_trimmer_default' formatter.
 *
 * @FieldFormatter(
 *   id = "word_trimmer_default",
 *   label = @Translation("Word Trimmer"),
 *   field_types = {
 *     "word_trimmer_field"
 *   }
 * )
 */
class WordTrimmerFormatter extends FormatterBase { 

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#type' => 'markup',
        '#markup' => '<p>' . $item->value . '</p>',
      ];
    }
    return $elements;
  }

}
