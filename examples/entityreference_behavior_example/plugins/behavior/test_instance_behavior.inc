<?php

$plugin = array(
  'title' => t('Test instance behavior'),
  'class' => 'EntityReferenceInstanceBehaviorExample',
  'weight' => 10,
  'settings level' => 'instance',
  'access callback' => 'entityreference_behavior_example_instance_behavior_access',
);

class EntityReferenceInstanceBehaviorExample implements EntityReference_BehaviorHandler {
  public function __construct(array $settings, array $field) {
    $this->settings = $settings;
    $this->field = $field;
  }

  public function load($entity_type, $entities, $field, $instances, $langcode, &$items) {
    drupal_set_message('Do something on load, on the instance level!');
  }

  public function validate($entity_type, $entity, $field, $instance, $langcode, $items, &$errors) {

  }

  public function presave($entity_type, $entity, $field, $instance, $langcode, &$items) {

  }

  public function insert($entity_type, $entity, $field, $instance, $langcode, &$items) {
    drupal_set_message('Do something on insert, on the instance level!');
  }

  public function update($entity_type, $entity, $field, $instance, $langcode, &$items) {
    drupal_set_message('Do something on update, on the instance level!');
  }

  public function delete($entity_type, $entity, $field, $instance, $langcode, &$items) {
    drupal_set_message('Do something on delete, on the instance level!');
  }
}

/**
 * Access callback to determine if behavior should be available.
 */
function entityreference_behavior_example_instance_behavior_access($select_class, $field, $instance) {
  return TRUE;
}
