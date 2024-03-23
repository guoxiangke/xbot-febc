<?php
return [
    'xbot' => [
        'endpoint' => env('XBOT_ENDPOINT'),
        'token' => env('XBOT_TOKEN'),
    ],
	'group' => [
		//群转发配置
		'forward'=>[
			'from' => env('GROUP_FWD_FROM', '?@chatroom'),
			'to' => array_map('trim', explode(',', env('GROUP_FWD_TO',''))),
		],
		'forward2'=>[
			'from' => env('GROUP_LU_FROM', '?@chatroom'),
			'to' => array_map('trim', explode(',', env('GROUP_LU_TO',''))),
		],
	],
];
