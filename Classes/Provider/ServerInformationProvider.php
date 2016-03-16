<?php

namespace T3Monitor\T3monitoringClient\Provider;

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

use TYPO3\CMS\Core\Database\DatabaseConnection;

class ServerInformationProvider implements DataProviderInterface
{

    public function get(array $data)
    {
        $data['core']['typo3Version'] = TYPO3_version;
        $data['core']['phpVersion'] = substr(phpversion(), 0, strpos(phpversion() . '-', '-'));
        $data['core']['mysqlClientVersion'] = mysqli_get_client_version($this->getDatabaseConnection()->getDatabaseHandle());

        return $data;
    }

    /**
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }

}