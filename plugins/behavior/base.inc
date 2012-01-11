<?php

class EntityReference_BehaviorHandler_Generic implements EntityReference_BehaviorHandler {

  public function __construct($behavior, array $field, array $instance = NULL) {
    ctools_include('plugins');
    $plugin = ctools_get_plugins('entityreference', 'behavior', $behavior);
    $this->plugin = $plugin;

    if ($plugin['settings level'] == 'field') {
      $this->settings = !empty($field['settings']['handler_settings']['behavior']) ? $field['settings']['handler_settings']['behavior'] : array();
    }
    else {
      $this->settings = !empty($instance['settings']['behavior']) ? $instance['settings']['behavior'] : array();
    }

    $this->status = !empty($settings['status']) ? $settings['status'] : FALSE;
    unset($this->settings['status']);

    $this->field = $field;
    $this->instance = $instance;
  }

  public function load($entity_type, $entities, $field, $instances, $langcode, &$items) {}

  public function validate($entity_type, $entity, $field, $instance, $langcode, $items, &$errors) {}

  public function presave($entity_type, $entity, $field, $instance, $langcode, &$items) {}

  public function insert($entity_type, $entity, $field, $instance, $langcode, &$items) {}

  public function update($entity_type, $entity, $field, $instance, $langcode, &$items) {}

  public function delete($entity_type, $entity, $field, $instance, $langcode, &$items) {}

  public function settingsForm() {}

  public function access($selection_class) {
    return TRUE;
  }
}
