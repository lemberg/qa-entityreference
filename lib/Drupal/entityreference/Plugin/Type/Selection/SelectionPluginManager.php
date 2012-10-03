<?php

/**
 * @file
 * Definition of Drupal\entityreference\Plugin\Type\Selection\SelectionPluginManager.
 */

namespace Drupal\entityreference\Plugin\Type\Selection;

use Drupal\Component\Plugin\PluginManagerBase;
use Drupal\Core\Plugin\Discovery\CacheDecorator;
use Drupal\Core\Plugin\Discovery\AnnotatedClassDiscovery;

/**
 * Plugin type manager for field widgets.
 */
class SelectionPluginManager extends PluginManagerBase {

  /**
   * Overrides Drupal\Component\Plugin\PluginManagerBase:$defaults.
   */
  protected $defaults = array(
    'force_enabled' => FALSE,
  );

  /**
   * The cache id used for plugin definitions.
   *
   * @var string
   */
  protected $cache_key = 'entityreference_selection';

  /**
   * Constructs a WidgetPluginManager object.
   */
  public function __construct() {
    $this->baseDiscovery = new AnnotatedClassDiscovery('entityreference', 'selection');
    $this->discovery = new CacheDecorator($this->baseDiscovery, $this->cache_key);
  }

  /**
   * Overrides Drupal\Component\Plugin\PluginManagerBase::getDefinition().
   *
   * @todo Remove when http://drupal.org/node/1778942 is fixed.
   */
  public function getDefinition($plugin_id) {
    $definition = $this->discovery->getDefinition($plugin_id);
    if (!empty($definition)) {
      $this->processDefinition($definition, $plugin_id);
      return $definition;
    }
  }

}
