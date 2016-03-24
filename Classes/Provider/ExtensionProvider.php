<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

class T3Monitor_T3monitoringClient_Provider_ExtensionProvider implements T3Monitor_T3monitoringClient_Provider_DataProviderInterface
{

    public function get(array $data)
    {
        $extList = t3lib_div::get_dirs(PATH_site . 'typo3conf/ext/');

        foreach ($extList as $key) {
            $path = PATH_site . 'typo3conf/ext/' . $key . '/';
            if (is_file($path . 'ext_emconf.php')) {
                include($path . 'ext_emconf.php');

            }
            $data['extensions'][$key] = array(
                'isLoaded' => t3lib_extMgm::isLoaded($key),
                'version' => $EM_CONF['']['version'],
                'state' => $EM_CONF['']['state']
            );
        }

        return $data;
    }

}