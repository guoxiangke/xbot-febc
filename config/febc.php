<?php
return [
	'group' => [
		//群转发配置
		'forward'=>[
			'from' => env('GROUP_FWD_FROM', '?@chatroom'),
			'to' => array_map('trim', explode(',', env('GROUP_FWD_TO',''))),
		],
	],
];
