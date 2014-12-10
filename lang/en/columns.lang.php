<?

/**
 * @author Alex Carrega <contact@alexcarrega.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

$columns_lang = [
	'code'				=> ['label' => 'Code'				],
	'description'	=> ['label' => 'Description'],
	'image'				=> ['label' => 'Image'			],
	'language'		=> ['label' => 'Language'		],
	'page'				=> ['label' => 'Page'				],
	'path'				=> ['label' => 'Path'				],
	'principal'		=> ['label' => 'Principal'	],
	'address'	=> ['label' => 'Address'],
	'number'	=> ['label' => 'Number'	],
	'title'		=> ['label' => 'Title'	],
	'type'		=> ['label' => 'Type'		],
	'url'			=> ['label' => 'URL'		],
	'value'		=> ['label' => 'Value'	],
	'position'		=> [
		'label'		=> 'Position',
		'title'		=> ['up' => 'Increment the position', 'down' => 'Decrement the position'],
		'updated'	=> 'Record position updated successfully'
	],
	'published' => [
		'label'		=> 'published',
		'handler'	=> [ 'title' => ['true' => 'Unpublish', 'false' => 'Publish'] ],
		'updated' => ['true' => 'Record published successfully', 'false' => 'Record unpublished successfully']
	],
	'timestamp' => [
		'createdStat'	=> ['label' => 'Created'		],
		'deletedStat'	=> ['label' => 'Deleted'		],
		'noUser'			=> ['label' => 'Automatic'	],
		'updatedStat'	=> ['label' => 'Last update']
	]
];