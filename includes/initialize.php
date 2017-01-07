<?php
define('DS', DIRECTORY_SEPARATOR);
define('LIB_PATH', DS."var".DS."www".DS."html".DS."gum2".DS."includes".DS);
define('SITE_ROOT', DS."var".DS."www".DS."html".DS."gum2".DS);



require_once(LIB_PATH. "session.php");
require_once(LIB_PATH. "database.php");
require_once(LIB_PATH. "functions.php");
require_once(LIB_PATH. "general.php");
require_once(LIB_PATH. "user.php");
require_once(LIB_PATH. "search.php");
require_once(LIB_PATH. "upload.php");
require_once(LIB_PATH. "adverts.php");
require_once(LIB_PATH. "security.php");
require_once(LIB_PATH. "messages.php");



?>