<?php

/**
 * Additional behaviors for a Entity Reference field.
 *
 * Implementations that wish to provide an implementation of this should
 * register it using CTools' plugin system.
 */
interface EntityReference_BehaviorHandler {
  /**
   * @TODO: document.
   */
  public function __construct(array $settings, array $field);

  /**
   * @TODO: document.
   */
  public function load($entity_type, $entities, $field, $instances, $langcode, &$items);

  /**
   * @TODO: document.
   */
  public function validate($entity_type, $entity, $field, $instance, $langcode, $items, &$errors);

  /**
   * @TODO: document.
   */
  public function presave($entity_type, $entity, $field, $instance, $langcode, &$items);

  /**
   * @TODO: document.
   */
  public function insert($entity_type, $entity, $field, $instance, $langcode, &$items);

  /**
   * @TODO: document.
   */
  public function update($entity_type, $entity, $field, $instance, $langcode, &$items);

  /**
   * @TODO: document.
   */
  public function delete($entity_type, $entity, $field, $instance, $langcode, &$items);
}
