<?php
defined('TYPO3_MODE') || die('Access denied.');


$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['t3monitoring'] = 'EXT:t3monitoring_client/Classes/Client.php';


$GLOBALS['TYPO3_CONF_VARS']['EXT']['t3monitoring_client']['provider'][] = 'T3Monitor\\T3monitoringClient\\Provider\\ServerInformationProvider';
if (\TYPO3\CMS\Core\Utility\GeneralUtility::compat_version('7.0')) {
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['t3monitoring_client']['provider'][] = 'T3Monitor\\T3monitoringClient\\Provider\\ComposerInformationProvider';
}

if (\TYPO3\CMS\Core\Utility\GeneralUtility::compat_version('7.0')) {
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['t3monitoring_client']['provider'][] = 'T3Monitor\\T3monitoringClient\\Provider\\Extension7xProvider';
} else {
    $GLOBALS['TYPO3_CONF_VARS']['EXT']['t3monitoring_client']['provider'][] = 'T3Monitor\\T3monitoringClient\\Provider\\Extension6xProvider';
}
