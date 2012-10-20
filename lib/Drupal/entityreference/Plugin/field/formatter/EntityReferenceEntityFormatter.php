<?php

/**
 * @file
 * Definition of Drupal\entityreference\Plugin\field\formatter\EntityReferenceEntityFormatter.
 */

namespace Drupal\entityreference\Plugin\field\formatter;

use Drupal\Core\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Entity\EntityInterface;

use Drupal\entityreference\EntityReferenceRecursiveRenderingException;
use Drupal\entityreference\Plugin\field\formatter\EntityReferenceFormatterBase;

/**
 * Plugin implementation of the 'entity-reference rendered entity' formatter.
 *
 * @Plugin(
 *   id = "entityreference_entity_view",
 *   module = "entityreference",
 *   label = @Translation("Rendered entity"),
 *   description = @Translation("Display the referenced entities rendered by entity_view()."),
 *   field_types = {
 *     "entityreference"
 *   },
 *   settings = {
 *     "view_mode" = "",
 *     "link" = "FALSE"
 *   }
 * )
 */
class EntityReferenceEntityFormatter extends EntityReferenceFormatterBase {

  /**
   * Implements Drupal\field\Plugin\Type\Formatter\FormatterInterface::settingsForm().
   */
  public function settingsForm(array $form, array &$form_state) {
    $entity_info = entity_get_info($this->field['settings']['target_type']);
    $options = array();
    if (!empty($entity_info['view modes'])) {
      foreach ($entity_info['view modes'] as $view_mode => $view_mode_settings) {
        $options[$view_mode] = $view_mode_settings['label'];
      }
    }

    $elements['view_mode'] = array(
      '#type' => 'select',
      '#options' => $options,
      '#title' => t('View mode'),
      '#default_value' => $this->getSetting('view_mode'),
      '#required' => TRUE,
    );

    $elements['links'] = array(
      '#type' => 'checkbox',
      '#title' => t('Show links'),
      '#default_value' => $this->getSetting('links'),
    );

    return $elements;
  }

  /**
   * Implements Drupal\field\Plugin\Type\Formatter\FormatterInterface::settingsForm().
   */
  public function settingsSummary() {
    $summary = array();
    $settings = $this->settings;

    $entity_info = entity_get_info($this->field['settings']['target_type']);
    $summary[] = t('Rendered as @mode', array('@mode' => isset($entity_info['view modes'][$settings['view_mode']]['label']) ? $entity_info['view modes'][$settings['view_mode']]['label'] : $settings['view_mode']));
    $summary[] = !empty($settings['links']) ? t('Display links') : t('Do not display links');

    return implode('<br />', $summary);
  }

  /**
   * Implements Drupal\field\Plugin\Type\Formatter\FormatterInterface::viewElements().
   */
  public function viewElements(EntityInterface $entity, $langcode, array $items) {
    // Remove un-accessible items.
    parent::viewElements($entity, $langcode, $items);

    $instance = $this->instance;
    $field = $this->field;
    $settings = $this->settings;

    $target_type = $field['settings']['target_type'];

    $elements = array();

    foreach ($items as $delta => $item) {
      // Protect ourselves from recursive rendering.
      static $depth = 0;
      $depth++;
      if ($depth > 20) {
        throw new EntityReferenceRecursiveRenderingException(format_string('Recursive rendering detected when rendering entity @entity_type(@entity_id). Aborting rendering.', array('@entity_type' => $entity_type, '@entity_id' => $item['target_id'])));
      }

      $entity = clone $item['entity'];
      unset($entity->content);
      $elements[$delta] = entity_view($entity, $settings['view_mode'], $langcode);

      if (empty($settings['links']) && isset($result[$delta][$target_type][$item['target_id']]['links'])) {
        // Hide the element links.
        $elements[$delta][$target_type][$item['target_id']]['links']['#access'] = FALSE;
      }
      $depth = 0;
    }


    return $elements;
  }
}
