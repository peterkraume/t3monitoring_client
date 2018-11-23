<?php

namespace T3Monitor\T3monitoringClient\Provider;

/*
 * This file is part of the t3monitoring_client extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extensionmanager\Utility\EmConfUtility;
use TYPO3\CMS\Extensionmanager\Utility\ListUtility;

/**
 * Class Extension7xProvider
 */
class ExtensionProvider implements DataProviderInterface
{

    /**
     * @param array $data
     * @return array
     * @throws \BadFunctionCallException
     */
    public function get(array $data)
    {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $listUtility = $objectManager->get(ListUtility::class);

        $allExtensions = $listUtility->getAvailableExtensions();

        $emConfUtility = GeneralUtility::makeInstance(EmConfUtility::class);
        foreach ($allExtensions as $key => $f) {
            if (is_dir(PATH_site . 'typo3/sysext/' . $key . '/')) {
                continue;
            }
            $data['extensions'][$key] = $emConfUtility->includeEmConf($f);
            $data['extensions'][$key]['isLoaded'] = (int)ExtensionManagementUtility::isLoaded($key);
        }

        return $data;
    }
}
