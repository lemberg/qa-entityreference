<?php

$plugin = array(
  'title' => t('Test behavior'),
  'class' => 'EntityReferenceFieldBehaviorExample',
  'weight' => 10,
  'settings level' => 'field',
);

class EntityReferenceFieldBehaviorExample implements EntityReference_BehaviorHandler {
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

  /**
   * Generate a settings form for this handler.
   */
  public static function settingsForm($field, $instance) {
    $form['test_field'] = array(
      '#type' => 'checkbox',
      '#title' => t('Field behavoir setting'),
    );
    return $form;
  }

  public function access() {
    return TRUE;
  }
}
