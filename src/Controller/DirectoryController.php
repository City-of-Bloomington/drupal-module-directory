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
        return [
            '#type' => 'markup',
            '#markup' => "<h2>Staff</h2>"
        ];
    }
}
