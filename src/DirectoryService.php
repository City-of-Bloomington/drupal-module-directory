<?php
/**
 * @copyright 2017 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE.txt
 */
namespace Drupal\directory;

use Drupal\Core\Site\Settings;

class DirectoryService
{
    /**
     * Returns contact information for a department
     *
     * We store the official contact information in Active Directory
     * This function requests data from the Directory web application's
     * restful web service.
     *
     * @param  string   $dn The DN for the department
     * @return stdClass     The JSON object from the response
     */
    public static function department_info($dn)
    {
        $DIRECTORY = Settings::get('directory_url');
        $url = $DIRECTORY.'/departments/view?format=json;dn='.urlencode($dn);

        $client   = \Drupal::httpClient();
        $response = $client->get($url);
        return json_decode($response->getBody());
    }

    /**
     * @param  string   $username Username in ActiveDirectory
     * @return stdClass           The JSON object from the response
     */
    function person_info($username)
    {
        $DIRECTORY = Settings::get('directory_url');
        $url = $DIRECTORY.'/people/view?format=json;username='.$username;

        $client = \Drupal::httpClient();
        $response = $client->get($url);
        return json_decode($response->getBody());
    }
}
