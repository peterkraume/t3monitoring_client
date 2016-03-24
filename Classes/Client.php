<?php

class T3Monitor_T3monitoringClient_Client
{

    /**
     * Entry point
     */
    public function run()
    {
        if (!$this->checkAccess()) {
            die;
        }

        $data = $this->collectData();
        echo json_encode($data);
    }

    /**
     * Collect data
     *
     * @return array
     */
    protected function collectData()
    {
        $data = array();
        $classes = (array)$GLOBALS['TYPO3_CONF_VARS']['EXT']['t3monitoring_client']['provider'];

        if (empty($classes)) {
            $data['error'] = 'No providers';
        } else {

            foreach ($classes as $class) {
                /** @var DataProviderInterface $call */
                $call = t3lib_div::makeInstance($class);
                if (!$call instanceof T3Monitor_T3monitoringClient_Provider_DataProviderInterface) {
                    $data['error'] = sprintf('The class "%s" does not implements "%s"!', $call, $class);
                    return $data;
                }
                $data = $call->get($data);
            }
        }
        return $data;
    }

    /**
     * Check if access is allowed to the endpoint
     *
     * @return bool
     */
    protected function checkAccess()
    {
        $settings = (array)unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['t3monitoring_client']);

        try {
            // secret
            if (isset($settings['secret']) && !empty($settings['secret']) && strlen($settings['secret']) >= 5) {
                $secret = t3lib_div::_GET('secret');
                if ($secret !== $settings['secret']) {
                    throw new Exception(sprintf('Secret wrong, provided was "%s"', $secret));
                }
            } else {
                throw new Exception('No secret or too small secret defined');
            }

            if (!isset($settings['allowedIps']) || empty($settings['allowedIps'])) {
                throw new Exception('No allowed ips defined');
            }
            $remoteIp = t3lib_div::getIndpEnv('REMOTE_ADDR');
            if (!t3lib_div::cmpIP($remoteIp, $settings['allowedIps'])) {
                throw new Exception(sprintf('IP comparison failed, remote IP: %s!', $remoteIp));
            }
        } catch (Exception $e) {
            if (isset($settings['enableDebugForErrors']) && (int)$settings['enableDebugForErrors'] === 1) {
                die('ERROR: ' . $e->getMessage());
            }
            return false;
        }

        return true;
    }

}

/** @var T3Monitor_T3monitoringClient_Client $client */
$client = t3lib_div::makeInstance('T3Monitor_T3monitoringClient_Client');
$client->run();