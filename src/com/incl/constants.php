<?php

namespace Kwerqy\Ember\com\incl;

defined('DIR_ROOT') || define('DIR_ROOT', ROOTPATH);
defined('DIR_EMBER') || define('DIR_EMBER', __DIR__."/../..");
defined('DIR_COM') || define('DIR_COM', DIR_EMBER."/com");
defined('DIR_APP') || define('DIR_APP', DIR_EMBER.'/app');
//defined('DIR_APP_APP') || define('DIR_APP_APP', DIR_ROOT.'/app/app');
//defined('DIR_UI') || define('DIR_UI', DIR_COM.'/ui');
//defined('DIR_UI_INCL') || define('DIR_UI_INCL', DIR_UI.'/incl');
//
//defined('DIR_ASSETS') || define('DIR_ASSETS', WRITEPATH."assets");
//defined('DIR_ASSETS_FILES') || define('DIR_ASSETS_FILES', DIR_ASSETS."/files");
//defined('DIR_ASSETS_IMG') || define('DIR_ASSETS_IMG', DIR_ASSETS_FILES."/img");
//defined('DIR_TEMP') || define('DIR_TEMP', WRITEPATH."temp");
//
//defined('DIR_VENDOR') || define('DIR_VENDOR', ROOTPATH.'vendor');


define("TYPE_KEY"		, 1);
define("TYPE_STRING"	, 2);
define("TYPE_VARCHAR"	, 2);
define("TYPE_ENUM"		, 3);
define("TYPE_TINYINT"	, 3);
define("TYPE_REFERENCE"	, 4);
define("TYPE_DATE"		, 5);
define("TYPE_DATETIME"	, 6);
define("TYPE_BOOL"		, 7);
define("TYPE_TELNR"		, 8);
define("TYPE_EMAIL"		, 9);
define("TYPE_INT"		, 10);
define("TYPE_FLOAT"		, 11);
define("TYPE_DOUBLE"	, 12);
define("TYPE_TEXT"		, 13);
define("TYPE_DECIMAL"	, 14);
define("TYPE_LONGBLOB"	, 15);
define("TYPE_FILE"	    , 16);

class constants {

}