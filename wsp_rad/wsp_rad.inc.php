<?php

//WSP RAD File Inclusions

//Libraries

//General Config
require(__DIR__."/config/general_config.php");

//Cookies Module
require_once(__DIR__ . "/controllers/Cookie.php");

//DB
//echo __DIR__."/config/db_config.php";
require(__DIR__."/config/db_config.php");


//Controller
require(__DIR__."/config/controllers_config.php");

//records Conrollers
require_once(__DIR__ . "/controllers/records/records.insert.php");
require_once(__DIR__ . "/controllers/records/records.update.php");
require_once(__DIR__ . "/controllers/records/records.fetch.php");
require_once(__DIR__ . "/controllers/records/records.delete.php");


//user Conrollers
require_once(__DIR__ . "/controllers/user/user.insert.php");
require_once(__DIR__ . "/controllers/user/user.update.php");
require_once(__DIR__ . "/controllers/user/user.fetch.php");
require_once(__DIR__ . "/controllers/user/user.delete.php");


//Arrays Controller
require_once(__DIR__ . "/controllers/array_resolver.php");


//PHP Mailer Controller
require_once(__DIR__ . "/controllers/mail/mailer.php");

//HTML Elements Controller
require_once(__DIR__ . "/controllers/html_elements.php");

//Validations Check
require_once(__DIR__ . "/controllers/validations.php");

//Authentication Controller
require_once(__DIR__ . "/controllers/user/auth.php");

//Core Faster Accessibility functions
require_once(__DIR__ . "/core_functions.php");

//Hooks
require(__DIR__."/../hooks.php");

//Logging Engine
if($http_request_logging == 1){
require(__DIR__."/logging.php");
}

//Meta Keys Check
require(__DIR__."/meta_keys.php");


//Custom functions
require(__DIR__."/../custom_functions.php");