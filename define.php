<?php
	
	// ====================== PATHS ===========================
	define ('DS'				, '/');
	define ('ROOT_PATH'			, dirname(__FILE__));						// Định nghĩa đường dẫn đến thư mục gốc
	define ('LIBRARY_PATH'		, ROOT_PATH . DS . 'libs' . DS);			// Định nghĩa đường dẫn đến thư mục thư viện
	define ('LIBRARY_EXT_PATH'	, LIBRARY_PATH . 'extends' . DS);			// Định nghĩa đường dẫn đến thư mục thư viện
	define ('PUBLIC_PATH'		, ROOT_PATH . DS . 'public' . DS);			// Định nghĩa đường dẫn đến thư mục public							
	define ('UPLOAD_PATH'		, PUBLIC_PATH . 'files' . DS);			// Định nghĩa đường dẫn đến thư mục public							
	define ('SCRIPT_PATH'		, PUBLIC_PATH . 'scripts' . DS);			// Định nghĩa đường dẫn đến thư mục public							
	define ('APPLICATION_PATH'	, ROOT_PATH . DS . 'application' . DS);		// Định nghĩa đường dẫn đến thư mục public							
	define ('MODULE_PATH'		, APPLICATION_PATH . DS . 'module' . DS);		// Định nghĩa đường dẫn đến thư mục public							
	define ('BLOCK_PATH'		, APPLICATION_PATH . 'block' . DS);		// Định nghĩa đường dẫn đến thư mục module							
	define ('TEMPLATE_PATH'		, PUBLIC_PATH . 'template' . DS);			// Định nghĩa đường dẫn đến thư mục public							
	
	// define	('ROOT_URL'			, DS . '---BaiMaucuaThayLan/HOANGY-MOBILE' . DS);
	// define	('ROOT_URL'			, DS . 'HOANGY-MOBILE' . DS);
	define	('ROOT_URL'			, 	"" );
	define	('APPLICATION_URL'	, ROOT_URL . 'application' . DS);
	define	('PUBLIC_URL'		, ROOT_URL . 'public' . DS);
	define	('UPLOAD_URL'		, PUBLIC_URL . 'files' . DS);
	define	('TEMPLATE_URL'		, PUBLIC_URL . 'template' . DS);
	
	define	('DEFAULT_MODULE'		, 'default');
	define	('DEFAULT_CONTROLLER'	, 'index');
	define	('DEFAULT_ACTION'		, 'index');

	// ====================== DATABASE ===========================
	define ('DB_HOST'			, 'us-cdbr-east-05.cleardb.net');
	define ('DB_USER'			, 'bf5dbc5d7a2f37');						
	define ('DB_PASS'			, '2b686b07');						
	define ('DB_NAME'			, 'heroku_5e3bb6d646de7a0');						
	define ('DB_TABLE'			, 'group');						
 
	// ====================== TABLE ===========================
	define ('TBL_GROUP'			, 'group');
	define ('TBL_USER'			, 'user');
	define ('TBL_CATEGORY'		, 'category');
	define ('TBL_PRODUCT'		, 'product');
	
	//DEFAULT ROOTH
	define	('PUBLIC_URL_DEFAULT'		, TEMPLATE_URL.'default/main/public');
	
	// ====================== CONFIG ===========================
	define ('TIME_LOGIN'		, 3600);
	