<?php
/**
 * @copyright 2017 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 */
namespace Drupal\directory\Plugin\Block;

use Drupal\directory\DirectoryService;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * @Block(
 *     id = "staff_block",
 *     admin_label = "Department Staff",
 *     context = {
 *         "node" = @ContextDefinition("entity:node")
 *     }
 * )
 */
class StaffBlock extends BlockBase implements BlockPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $node = $this->getContextValue('node');
        if ($node->hasField( 'field_directory_dn')) {
            $dn = $node->get('field_directory_dn')->value;
            if ($dn) {
                $json = DirectoryService::department_info($dn);

                return [
                    '#theme'      => 'directory_staff',
                    '#department' => $json
                ];
            }
        }
    }
}
