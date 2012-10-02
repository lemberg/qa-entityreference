<?php

class EntityReferenceBehaviorAutoCreate extends EntityReference_BehaviorHandler_Abstract {

 /**
  * Override EntityReference_BehaviorHandler_Abstract::access().
  */
  public function access($field, $instance) {
    if ($field['settings']['target_type'] != 'taxonomy_term' && count($field['settings']['handler_settings']['target_bundles']) != 1) {
      return;
    }
    if ($instance['widget']['type'] == 'entityreference_autocomplete_tags') {
      return;
    }

    $entity_info = entity_get_info($instance['entity_type']);
    return !empty($entity_info['entityreferene autocreate']);
  }

 /**
  * Override EntityReference_BehaviorHandler_Abstract::is_empty_alter().
  */
  public function is_empty_alter(&$empty, $item, $field) {
    if (!empty($item['target_id']) && $item['target_id'] == 'autocreate') {
      $empty = FALSE;
    }
  }

 /**
  * Override EntityReference_BehaviorHandler_Abstract::presave().
  */
  public function presave($entity_type, $entity, $field, $instance, $langcode, &$items) {
    foreach ($items as $delta => $item) {
      if ($item['target_id'] == 'autocreate') {
        $wrapper = entity_property_values_create_entity($target_type, $item);
        $wrapper->save();
        $items[$delta]['target_id'] = $wrapper->getIdentifier();
      }
    }
  }
}
