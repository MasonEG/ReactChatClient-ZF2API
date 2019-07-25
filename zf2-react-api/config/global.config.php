<?php

use Webdev\Authentication\Identity\IdentityInterface;

return [
	'auth' => [
		'adapter' => [
			'type' => 'Webauth',
			'options' => [
				'name' => 'wwwwebauth',
				'url' => 'https://webauth-its.sws.iastate.edu',
			],
		],
	],

	'project_deploy' => [
		//'default' => 'vwh-manXXX://XXX.iastate.edu/projects/XXX',
	],

];
