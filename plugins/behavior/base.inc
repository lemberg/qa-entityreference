<?php

class EntityReference_BehaviorHandler_Generic implements EntityReference_BehaviorHandler {
  public function __construct(array $settings, array $field, array $instance = NULL) {
    $this->settings = $settings;
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

  public function access() {
    return TRUE;
  }
}
