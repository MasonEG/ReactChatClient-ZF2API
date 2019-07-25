<?php

return [
	'routes' => [
		'app' => [
			'type' => 'Literal',
			'options' => [
				'route' => '/',
				'defaults' => [
					'controller' => 'App:Index',
				],
			],
			'child_routes' => [
				'create' => [
					'type' => 'literal',
					'options' => [
						'route' => 'create',
						'defaults' => [
							'action' => 'create',
						],
					],
				],
				'login' => [
					'type' => 'literal',
					'options' => [
						'route' => 'login',
						'defaults' => [
							'action' => 'login',
						],
					],
				],
				'view' => [
					'type' => 'literal',
					'options' => [
						'route' => 'view',
						'defaults' => [
							'action' => 'view',
						],
					],
				],
				'send' => [
					'type' => 'literal',
					'options' => [
						'route' => 'send',
						'defaults' => [
							'action' => 'send',
						],
					],
				]
			],
		],
	],
];
