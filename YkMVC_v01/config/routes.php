<?php

//set not found action:
Router::setNotFoundAction("error", "notFound");

//routes:
// Router::map(
// 'file/{filename}',
// 'file',
// 'xml',
// null,
// //array('filename'=>'((\\w+)|(\\w+\\.\\w+))')
// array('filename'=>'\w+\.xml')
// );

Router::map(
'config',
'user',
'details'

);

Router::map(
	'user/{user_id}',
	'user',
	'details',
	null,
	array('user_id'=>'\\d+')
);

Router::map(
	'user/{user_id}/favs',
	'user',
	'favs',
	array('page_index'=>0,'count'=>10),
	array('user_id'=>'\\d+')
);

Router::map(
	'user/{user_id}/favs/{page_index}',
	'user',
	'favs',
	array('count'=>10),
	array('user_id'=>'\\d+','page_index'=>'\\d+')
);

Router::map(
	'user/{user_id}/favs/{page_index}/{count}',
	'user',
	'favs',
	null,
	array('user_id'=>'\\d+','page_index'=>'\\d+','count'=>'\\d+')
);

Router::map(
'user/{user_name}',
'user',
'details',
null,
null
);

Router::map(
'user/{user_name}/{album_id}',
'ablum',
'details',
null,
array('album_id'=>'\\d+')
);

Router::map(
'user/{user_name}/{album_name}',
'ablum',
'details',
null,
null
);
