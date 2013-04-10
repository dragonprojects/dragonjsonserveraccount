<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccount
 */

namespace DragonJsonServerAccount;

/**
 * Klasse zur Initialisierung des Moduls
 */
class Module
{
    use \DragonJsonServer\ServiceManagerTrait;
	
    /**
     * Gibt die Konfiguration des Moduls zurück
     * @return array
     */
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }

    /**
     * Gibt die Autoloaderkonfiguration des Moduls zurück
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }
    
    /**
     * Wird bei der Initialisierung des Moduls aufgerufen
     * @param \Zend\ModuleManager\ModuleManager $moduleManager
     */
    public function init(\Zend\ModuleManager\ModuleManager $moduleManager)
    {
    	$sharedManager = $moduleManager->getEventManager()->getSharedManager();
    	$sharedManager->attach('DragonJsonServer\Service\Server', 'request', 
	    	function (\DragonJsonServer\Event\Request $eventRequest) {
	    		$serviceManager = $this->getServiceManager();
	    		$request = $eventRequest->getRequest();
	    		list ($classname, $methodname) = $serviceManager->get('Server')->parseMethod($request->getMethod());
	    		$classreflection = new \Zend\Code\Reflection\ClassReflection($classname);
	    		if (!$classreflection->getMethod($methodname)->getDocBlock()->hasTag('session')) {
	    			return;
	    		}
	    		$serviceSession = $serviceManager->get('Session');
	    		$session = $serviceSession->getSessionBySessionhash($request->getParam('sessionhash'));
	    		$serviceSession->setSession($session);
	    	}
    	);
    	$sharedManager->attach('DragonJsonServer\Service\Server', 'servicemap', 
    		function (\DragonJsonServer\Event\Servicemap $eventServicemap) {
	    		$serviceManager = $this->getServiceManager();
	    		$serviceServer = $serviceManager->get('Server');
		        foreach ($eventServicemap->getServicemap()->getServices() as $method => $service) {
	    			list ($classname, $methodname) = $serviceServer->parseMethod($method);
		            $classreflection = new \Zend\Code\Reflection\ClassReflection($classname);
		            if (!$classreflection->getMethod($methodname)->getDocBlock()->hasTag('session')) {
		                continue;
		            }
		            $service->addParams([
		                [
		                    'type' => 'string',
		                    'name' => 'sessionhash',
		                    'optional' => false,
		                ],
		            ]);
		        }
    		}
    	);
    }
}
