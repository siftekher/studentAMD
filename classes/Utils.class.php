<?php
/*
 * Filename   : Utils.class.php
 * Purpose    : 
 *
 * @author    : Sheikh Iftekhar <siftekher@gmail.com>
 * @project   : Majestic
 * @version   : 1.0.0
 * @copyright : 
 */

class Utils 
{
   public static function dumpvar($data)
   {
      echo "<pre>";
      print_r($data);
      echo "</pre>";
   }
   

   //Get all students
   public function getAllStudentList($dbLink)
   {
      $query  = "SELECT * FROM " . STUDENT_TBL ;
      $row   = $dbLink->select($query);
      /*
      if(count($row))
      {
         foreach($row as $key => $value)
         {
            $row[$key]->tag_title = ucwords(strtolower($value->tag_title));            
         }
      }
	  */
      
      return $row;
   }

   
} // end of class