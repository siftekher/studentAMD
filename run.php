<?php
   //echo 'FROM RUN.php'. $_SERVER['DOCUMENT_ROOT'];
   
   define('DOCUMENT_ROOT',  $_SERVER['DOCUMENT_ROOT']);
   define('CONFIG_DIR',     DOCUMENT_ROOT   . '/majestic/config');
   define('CLASS_DIR',      DOCUMENT_ROOT   . '/majestic/classes');
   define('SUPER_CONTROLLER_URL_PREFIX',      '/majestic/run.php/');
   define('CONTROLLER_DIR',   DOCUMENT_ROOT . '/majestic/controllers/');
   define('UPLOADED_IMAGE_DIR',         DOCUMENT_ROOT . '/majestic/uploaded_images');
  
   set_include_path(get_include_path() . PATH_SEPARATOR . CONFIG_DIR);
   set_include_path(get_include_path() . PATH_SEPARATOR . CLASS_DIR);
   set_include_path(get_include_path() . PATH_SEPARATOR . CONTROLLER_DIR);
   
   require_once('config.php');
   require_once('DB.class.php');
   
   session_start();
   
  try
  {
     $dbObj = new DB($dbInfo);
	 //echo 'DB connected';
  }
  catch(Exception $e)
  {
     die($e->getMessage());
  }

  $params   =  array();
  $params['db_link'] = $dbObj;
  
  $className = str_replace(SUPER_CONTROLLER_URL_PREFIX, '', $_SERVER['REQUEST_URI']);
  
  $className = explode('/', $className);
  $params['cmdList'] = $className;

  if(!empty($className[0]))
  {
     $className[0] = ucwords($className[0]);
  }
  
  $classFile = sprintf("%s/%sController.class.php", CONTROLLER_DIR, $className[0]);

  if (empty($className[0]) || (!file_exists($classFile)))
  {
     $className[0] = 'Student';
     $classFile    = CONTROLLER_DIR . '/StudentController.class.php';
  }
//echo $classFile;
  require_once($classFile);
  
  $thisclassName = new $className[0]($params);
  $thisclassName->run();

?>