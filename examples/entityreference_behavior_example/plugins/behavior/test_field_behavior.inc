<?php

$plugin = array(
  'title' => t('Test behavior'),
  'class' => 'EntityReferenceFieldBehaviorExample',
  'weight' => 10,
  'behavior type' => 'field',
);

class EntityReferenceFieldBehaviorExample extends EntityReference_BehaviorHandler_Generic {

  public function load($entity_type, $entities, $field, $instances, $langcode, &$items) {
    drupal_set_message('Do something on load!');
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
  public function settingsForm() {
    $form['test_field'] = array(
      '#type' => 'checkbox',
      '#title' => t('Field behavoir setting'),
    );
    return $form;
  }
}
