<?php

//define rootes to array
return array(
    'admin/update/([0-9]+)' => 'admin/update/$1', 	// actionUpdate at AdminController
    'admin/done/([0-9]+)' 	=> 'admin/done/$1', 	// actionDone at AdminController
    'admin/renew/([0-9]+)' 	=> 'admin/renew/$1', 	// actionRenew at AdminController
    'admin/delete/([0-9]+)' => 'admin/delete/$1', 	// actionDelete at AdminController
    'admin/logout' 			=> 'admin/logout', 		// actionLogout at AdminController
    'admin/([a-zA-Z0-9]+)' 	=> 'admin/index/$1', 	// actionIndex at AdminController

    'index/([a-z_]+)/page-([0-9]+)' 		=> 'main/index/$1/$2', 	// actionIndex at TaskController
    'index/([a-z]+)' 		=> 'main/index/$1', 	// actionIndex at TaskController

    'login' 			    => 'main/login', 		// actionIndex at TaskController

    'index.php' 			=> 'main/index', 		// actionIndex at TaskController
    'index' 				=> 'main/index', 		// actionIndex at TaskController
    '' 						=> 'main/index/$1', 	// actionIndex at TaskController
    '([a-zA-Z0-9-]+)'		=> 'main/index',  		// any key/string


);
