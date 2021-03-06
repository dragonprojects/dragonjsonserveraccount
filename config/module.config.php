<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccount
 */

/**
 * @return array
 */
return [
    'dragonjsonserveraccount' => [
        'betakeys' => false,
        'namelength' => [
            'min' => '3',
            'max' => '255',
        ],
    ],
	'dragonjsonserver' => [
	    'apiclasses' => [
            '\DragonJsonServerAccount\Api\Account' => 'Account',
            '\DragonJsonServerAccount\Api\Betakey' => 'Betakey',
            '\DragonJsonServerAccount\Api\BetakeyAdmin' => 'BetakeyAdmin',
            '\DragonJsonServerAccount\Api\Session' => 'Session',
	    ],
	],
	'service_manager' => [
		'invokables' => [
            '\DragonJsonServerAccount\Service\Account' => '\DragonJsonServerAccount\Service\Account',
            '\DragonJsonServerAccount\Service\Betakey' => '\DragonJsonServerAccount\Service\Betakey',
            '\DragonJsonServerAccount\Service\BetakeyAdmin' => '\DragonJsonServerAccount\Service\BetakeyAdmin',
            '\DragonJsonServerAccount\Service\Session' => '\DragonJsonServerAccount\Service\Session',
		],
	],
	'doctrine' => [
		'driver' => [
			'DragonJsonServerAccount_driver' => [
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => [
					__DIR__ . '/../src/DragonJsonServerAccount/Entity'
				],
			],
			'orm_default' => [
				'drivers' => [
					'DragonJsonServerAccount\Entity' => 'DragonJsonServerAccount_driver'
				],
			],
		],
	],
];
