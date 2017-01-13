<?php
/**
 * @copyright 2017 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 */
namespace Drupal\directory\Controller;

use Drupal\Core\Controller\ControllerBase;

class DirectoryController extends ControllerBase
{
    public function staff()
    {
        $query = \Drupal::entityQuery('node')
                 ->condition('status', 1)
                 ->condition('type', 'department');
        $nids = $query->execute();
        $departments = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($nids);

        return [
            '#theme'       => 'directory_staff',
            '#departments' => $departments
        ];
    }
}
