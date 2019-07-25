<?php

return [
	'entity_managers' => [
		'managers' => [
			'App' => [
				'table_prefix' => 'app__',
			],
		],
	],

	'router' => include __DIR__ . '/router.php',

	'theme_App' => [
		'head_link' => [
			[
				'href' => '{{module_asset_path}}/app/css/app.css',
			],
		],
	],
];
