<?php

/**
 * @file
 * Definition of Drupal\entityreference\Plugin\field\formatter\EntityReferenceFormatterLabel.
 */

namespace Drupal\entityreference\Plugin\field\formatter;

use Drupal\Core\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;
use Drupal\field\Plugin\Type\Formatter\FormatterBase;
use Drupal\Core\Entity\EntityInterface;

/**
 * Plugin implementation of the 'entity-reference label' formatter.
 *
 * @Plugin(
 *   id = "entityreference_label",
 *   module = "entityreference",
 *   label = @Translation("Label"),
 *   description = @Translation("Display the label of the referenced entities."),
 *   field_types = {
 *     "entityreference"
 *   },
 *   settings = {
 *     "link" = "FALSE"
 *   }
 * )
 */
class EntityReferenceFormatterLabel extends FormatterBase {

  /**
   * Implements Drupal\field\Plugin\Type\Formatter\FormatterInterface::settingsForm().
   */
  public function settingsForm(array $form, array &$form_state) {
    $elements['link'] = array(
      '#title' => t('Link label to the referenced entity'),
      '#type' => 'checkbox',
      '#default_value' => $this->getSetting('link'),
    );

    return $elements;
  }

  /**
   * Implements Drupal\field\Plugin\Type\Formatter\FormatterInterface::settingsForm().
   */
  public function settingsSummary() {
    $summary = array();
    $summary[] = $this->getSetting('link') ? t('Link to the referenced entity') : t('No link');

    return implode('<br />', $summary);
  }

  /**
   * Implements Drupal\field\Plugin\Type\Formatter\FormatterInterface::viewElements().
   */
  public function viewElements(EntityInterface $entity, $langcode, array $items) {
    $elements = array();

    $handler = entityreference_get_selection_handler($field, $instance, $entity->entityType(), $entity);
    foreach ($items as $delta => $item) {
      $entity = $item['entity'];
      $label = $entity->label();
      // If the link is to be displayed and the entity has a uri, display a link.
      // Note the assignment ($url = ) here is intended to be an assignment.
      if ($display['settings']['link'] && ($uri = $entity->uri())) {
        $elements[$delta] = array('#markup' => l($label, $uri['path'], $uri['options']));
      }
      else {
        $elements[$delta] = array('#markup' => check_plain($label));
      }
    }

    return $elements;
  }

}
