<?php

/**
 * @file
 * Definition of Drupal\entityreference\Plugin\entityreference\selection\SelectionEntityTypeFile.
 *
 * Provide entity type specific access control of the file entity type.
 */

namespace Drupal\entityreference\Plugin\entityreference\selection;

use Drupal\Core\Entity\EntityFieldQuery;
use Drupal\entityreference\Plugin\entityreference\selection\SelectionBase;


class SelectionEntityTypeFile extends SelectionBase {

  public function entityFieldQueryAlter(SelectQueryInterface $query) {
    // Core forces us to know about 'permanent' vs. 'temporary' files.
    $tables = $query->getTables();
    $base_table = key($tables);
    $query->condition('status', FILE_STATUS_PERMANENT);

    // Access control to files is a very difficult business. For now, we are not
    // going to give it a shot.
    // @todo: fix this when core access control is less insane.
    return $query;
  }

  public function getLabel($entity) {
    // The file entity doesn't have a label. More over, the filename is
    // sometimes empty, so use the basename in that case.
    return $entity->filename !== '' ? $entity->filename : basename($entity->uri);
  }
}
