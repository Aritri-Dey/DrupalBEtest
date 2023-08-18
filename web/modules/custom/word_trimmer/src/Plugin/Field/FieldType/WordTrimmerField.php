<?php 

/**
 * @file
 * Contains \Drupal\product_module\Plugin\Field\FieldType\WordTrimmerField.
 */

namespace Drupal\product_module\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'word_trimmer' field type.
 *
 * @FieldType(
 *   id = "word_trimmer_field",
 *   label = @Translation("Word trimmer field"),
 *   description = @Translation("This field stores words upto 50."),
 *   category = @Translation("Text"),
 *   default_widget = "word_trimmer_default",
 *   default_formatter = "word_trimmer_default"
 * )
 */
class WordTrimmerField extends FieldItemBase { 

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field) {
    return [
      'columns' => [
        'value' => [
          'type' => 'varchar',
          'length' => 256,
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Word trimmer filed value'));

    return $properties;
  }
  
}
