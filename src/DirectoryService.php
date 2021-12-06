<?php
/**
 * @copyright 2017-2021 City of Bloomington, Indiana
 * @license http://www.gnu.org/licenses/agpl.txt GNU/AGPL, see LICENSE
 */
namespace Drupal\directory;

use Drupal\Core\Site\Settings;

class DirectoryService
{
    private static function doJsonQuery($url)
    {
        $client   = \Drupal::httpClient();
        try {
            $response = $client->get($url);
            return json_decode($response->getBody(), true);
        }
        catch (\Exception $e) {
            return [];
        }
    }
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
    public static function department_info(string $dn)
    {
        $config    = \Drupal::config('directory.settings');
        $DIRECTORY = $config->get('directory_url');
        $path      = self::pathForDn($dn);
        $url       = $DIRECTORY."/departments$path?format=json;promoted=1";
        return self::doJsonQuery($url);
    }

    public static function pathForDn(string $dn): string
    {
        $path = '';
        preg_match_all("|OU=([^,]+),|", $dn, $matches);
        if (count($matches[1]) > 1) {
            // Matches will also include the OU=Departments,
            // which we don't want to be part of the path.
            array_pop($matches[1]);

            foreach ($matches[1] as $name) {
                $name = str_replace(' ', '_', strtolower($name));
                $path = "/$name$path";
            }
        }
        return $path;
    }
}
