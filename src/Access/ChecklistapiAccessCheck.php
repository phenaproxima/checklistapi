<?php

/**
 * @file
 * Contains \Drupal\checklistapi\Access\ChecklistapiAccessCheck.
 */

namespace Drupal\checklistapi\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;

/**
 * An access check service determining access rules for checklist routes.
 */
class ChecklistapiAccessCheck implements AccessInterface {

  /**
   * {@inheritdoc}
   */
  public function access(Route $route, Request $request, AccountInterface $account) {
    $op = $request->attributes->get('op');
    $op = !empty($op) ? $op : 'any';

    return checklistapi_checklist_access($request->attributes->get('checklist_id'), $op) ? AccessResult::allowed() : AccessResult::forbidden();
  }
}