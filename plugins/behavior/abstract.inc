<?php

/**
 * Additional behaviors for a Entity Reference field.
 *
 * Implementations that wish to provide an implementation of this should
 * register it using CTools' plugin system.
 */
interface EntityReference_BehaviorHandler {

  /**
   * Act on loading entity reference fields of entities.
   *
   * @see hook_field_load()
   */
  public function load($entity_type, $entities, $field, $instances, $langcode, &$items);

  /**
   * Act on validating an entity reference field.
   *
   * @see hook_field_validate()
   */
  public function validate($entity_type, $entity, $field, $instance, $langcode, $items, &$errors);

  /**
   * Act on presaving an entity reference field.
   *
   * @see hook_field_presave()
   */
  public function presave($entity_type, $entity, $field, $instance, $langcode, &$items);

  /**
   * Act after inserting an entity reference field.
   *
   * @see hook_field_insert()
   */
  public function insert($entity_type, $entity, $field, $instance, $langcode, &$items);

  /**
   * Act after updating an entity reference field.
   *
   * @see hook_field_update()
   */
  public function update($entity_type, $entity, $field, $instance, $langcode, &$items);

  /**
   * Act after deleting entity reference field.
   *
   * @see hook_field_delete()
   */
  public function delete($entity_type, $entity, $field, $instance, $langcode, &$items);

  /**
   * Generate a settings form for this handler.
   */
  public function settingsForm();

  /**
   * Determine if handler should appear.
   */
  public function access($selection_class);
}

/**
 * A null implementation of EntityReference_BehaviorHandler.
 */
class EntityReference_BehaviorHandler_Broken implements EntityReference_BehaviorHandler {

  public function load($entity_type, $entities, $field, $instances, $langcode, &$items) {

  }

  public function validate($entity_type, $entity, $field, $instance, $langcode, $items, &$errors) {

  }

  public function presave($entity_type, $entity, $field, $instance, $langcode, &$items) {

  }

  public function insert($entity_type, $entity, $field, $instance, $langcode, &$items) {

  }

  public function update($entity_type, $entity, $field, $instance, $langcode, &$items) {

  }

  public function delete($entity_type, $entity, $field, $instance, $langcode, &$items) {

  }

  public function settingsForm() {
    $form['behavior_handler'] = array(
      '#markup' => t('The selected behavior handler is broken.'),
    );
    return $form;

  }

  public function access($selection_class) {
    return FALSE;
  }
}
