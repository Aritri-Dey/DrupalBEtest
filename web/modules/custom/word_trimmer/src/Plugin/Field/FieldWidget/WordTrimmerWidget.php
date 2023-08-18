<?php

/**
 * @file
 * Contains \Drupal\mymodule\Plugin\Field\FieldWidget\WordTrimmerWidget.
 */
namespace Drupal\product_module\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'word_trimmer_default' widget.
 *
 * @FieldWidget(
 *   id = "word_trimmer_default",
 *   label = @Translation("Word trimmer default"),
 *   field_types = {
 *     "word_trimmer_field"
 *   }
 * )
 */
class WordTrimmerWidget extends WidgetBase { 

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['value'] = [
      '#title' => $this->t('Description (Word trimmer fieldtype)'),
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
    ];
    return $element;
  }

}
