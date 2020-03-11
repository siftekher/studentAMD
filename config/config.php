<?php

  define('PRODUCTION_MODE', false);
  //echo 'FROM Config';
  $dbInfo = array();
  if(PRODUCTION_MODE)
  {
     $dbInfo['db']   = 'majestic';
     $dbInfo['user'] = 'root';
     $dbInfo['pass'] = '';
     $dbInfo['host'] = '';  
     
     define('SITE_URL',    '');
     define('SMTP_HOST',   '');
     
  }
  else
  {
     $dbInfo['db']   = 'majestic';
     $dbInfo['user'] = 'root';
     $dbInfo['pass'] = '';
     $dbInfo['host'] = 'localhost';
     
     define('SITE_URL',    'localhost/majestic/');
     define('SMTP_HOST',   '');
  }


  define('VIEWS_DIR',          DOCUMENT_ROOT . '/majestic/views/');

  define('HEADER_TEMPLATE',  VIEWS_DIR . 'header.php');
  define('LIST_TEMPLATE',  VIEWS_DIR . 'list.php');
  define('ADD_TEMPLATE',  VIEWS_DIR . 'add_student.php');
  define('EDIT_TEMPLATE',  VIEWS_DIR . 'edit_student.php');


  # Database tables
  define('STUDENT_TBL', 'student');
?>