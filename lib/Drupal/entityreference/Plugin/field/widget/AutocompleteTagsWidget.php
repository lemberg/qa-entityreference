<?php

/**
 * @file
 * Definition of Drupal\entityreference\Plugin\field\widget\AutocompleteTagsWidget.
 */

namespace Drupal\entityreference\Plugin\field\widget;

use Drupal\Core\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;
use Drupal\field\Plugin\Type\Widget\WidgetBase;

/**
 * Plugin implementation of the 'entityreference autocomplete-tags' widget.
 *
 * @todo: Check if the following statement is still correct
 * The autocomplete path doesn't have a default here, because it's not the
 * the two widgets, and the Field API doesn't update default settings when
 * the widget changes.
 *
 * @Plugin(
 *   id = "entityreference_autocomplete_tags",
 *   module = "entityreference",
 *   label = @Translation("Autocomplete (Tags style)"),
 *   description = @Translation("An autocomplete text field."),
 *   field_types = {
 *     "entityreference"
 *   },
 *   settings = {
 *     "match_operator" = "CONTAINS",
 *     "size" = 60,
 *     "path" = ""
 *   },
 *   behaviors = {
      "multiple values" = FIELD_BEHAVIOR_CUSTOM,
    }
 * )
 */
class AutocompleteTagsWidget extends AutocompleteWidget {

  /**
   * Implements Drupal\field\Plugin\Type\Widget\WidgetInterface::formElement().
   */
  public function formElement(array $items, $delta, array $element, $langcode, array &$form, array &$form_state) {
    $instance = $this->instance;
    $field = $this->field;
    $entity = isset($element['#entity']) ? $element['#entity'] : NULL;

    // Prepare the autocomplete path.
    $autocomplete_path = !empty($instance['widget']['settings']['path']) ? $instance['widget']['settings']['path'] : 'entityreference/autocomplete/tags';

    $autocomplete_path .= '/' . $field['field_name'] . '/' . $instance['entity_type'] . '/' . $instance['bundle'] . '/';
    // Use <NULL> as a placeholder in the URL when we don't have an entity.
    // Most webservers collapse two consecutive slashes.
    $id = 'NULL';
    if ($entity) {
      if ($eid = $entity->id()) {
        $id = $eid;
      }
    }
    $autocomplete_path .= $id;

    $element += array(
      '#type' => 'textfield',
      '#maxlength' => 1024,
      '#default_value' => implode(', ', $this->getLabels($items)),
      '#autocomplete_path' => $autocomplete_path,
      '#size' => $instance['widget']['settings']['size'],
      '#element_validate' => array('_entityreference_autocomplete_tags_validate'),
    );
    return $element;
  }
}
