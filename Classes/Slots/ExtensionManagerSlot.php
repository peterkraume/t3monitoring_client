<?php
namespace T3Monitor\T3monitoringClient\Slots;

/*
 * This file is part of the t3monitoring_client extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Configuration\ConfigurationManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ExtensionManagerSlot
 */
class ExtensionManagerSlot
{
    const SECRET_LENGTH = 50;

    /**
     * @param string $extensionKey
     */
    public function afterExtensionInstall($extensionKey)
    {
        if ($extensionKey === 't3monitoring_client') {
            if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['t3monitoring_client'])) {
                $configuration = array();
            } else {
                $configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['t3monitoring_client']);
            }

            if (empty($configuration['secret'])) {
                if (class_exists('TYPO3\\CMS\\Core\\Crypto\\Random')) {
                    $secret = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Crypto\\Random')->generateRandomHexString(self::SECRET_LENGTH);
                } else {
                    $secret = GeneralUtility::getRandomHexString(self::SECRET_LENGTH);
                }
                $configuration['secret'] = $secret;

                if (class_exists('TYPO3\\CMS\\Core\\Configuration\\ExtensionConfiguration')) {
                    // TYPO3 v9
                    GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Configuration\\ExtensionConfiguration')->set($extensionKey, '', $configuration);
                } else {
                    /** @var $configurationManager ConfigurationManager */
                    $configurationManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Configuration\\ConfigurationManager');
                    $configurationManager->setLocalConfigurationValueByPath(
                        'EXT/extConf/' . $extensionKey,
                        serialize($configuration)
                    );
                }
            }
        }
    }
}
