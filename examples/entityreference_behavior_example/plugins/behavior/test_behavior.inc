<?php

$plugin = array(
  'title' => t('Test behavior'),
  'class' => 'EntityReferenceBehaviorExample',
  'weight' => 10,
);

class EntityReferenceBehaviorExample implements EntityReference_BehaviorHandler {
  public function __construct(array $settings, array $field) {
    $this->settings = $settings;
    $this->field = $field;
  }

  public function load($entity_type, $entities, $field, $instances, $langcode, &$items) {
    drupal_set_message('Do something on load!');
  }

  public function validate($entity_type, $entity, $field, $instance, $langcode, $items, &$errors) {
    
  }

  public function presave($entity_type, $entity, $field, $instance, $langcode, &$items) {
    
  }

  public function insert($entity_type, $entity, $field, $instance, $langcode, &$items) {
    drupal_set_message('Do something on insert!');
  }

  public function update($entity_type, $entity, $field, $instance, $langcode, &$items) {
    drupal_set_message('Do something on update!');
  }

  public function delete($entity_type, $entity, $field, $instance, $langcode, &$items) {
    drupal_set_message('Do something on delete!');
  }
}
