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

class DummyDataProvider implements DataProviderInterface
{

    public function get(array $data)
    {
        $data['extra']['warning']['Warning 1'] = 'This is a warning';
        $data['extra']['warning']['Warning 2'] = 'This is another warning';
        $data['extra']['danger']['Danger 2'] = 'This is a critical message';

        return $data;
    }

}