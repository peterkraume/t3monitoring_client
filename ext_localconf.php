<?php
defined('TYPO3_MODE') || die('Access denied.');


t3lib_div::requireOnce(t3lib_extMgm::extPath('t3monitoring_client', 'Classes/Provider/DataProviderInterface.php'));
t3lib_div::requireOnce(t3lib_extMgm::extPath('t3monitoring_client', 'Classes/Provider/ExtensionProvider.php'));
t3lib_div::requireOnce(t3lib_extMgm::extPath('t3monitoring_client', 'Classes/Provider/ServerInformationProvider.php'));

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['t3monitoring'] = 'EXT:t3monitoring_client/Classes/Client.php';
//
//
$GLOBALS['TYPO3_CONF_VARS']['EXT']['t3monitoring_client']['provider'][] = 'T3Monitor_T3monitoringClient_Provider_ServerInformationProvider';
$GLOBALS['TYPO3_CONF_VARS']['EXT']['t3monitoring_client']['provider'][] = 'T3Monitor_T3monitoringClient_Provider_ExtensionProvider';