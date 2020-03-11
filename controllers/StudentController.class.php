<?php
error_reporting(0);

/*
 * Filename   : StudentController.class.php
 * Purpose    : It is used to add a new ticket
 *
 * @author    : Sheikh Iftekhar <siftekher@gmail.com>
 * @project   : Majestic
 * @version   : 1.0
 */
require_once('Students.class.php');
class Student
{
   private $db;
   private $template;
   private $params;
   private $cmdList;

   public function __construct($params)
   {
      $this->db       = $params['db_link'];
      $this->cmdList  = $params['cmdList'];
      //$this->template = new Template();
   }
   

   public function run()
   {
      $cmd = $this->cmdList[1];

      switch ($cmd)
      {
         case 'list'           : $screen = $this->studentList();     break;
         case 'add'            : $screen = $this->studentAdd();      break;
         case 'edit'           : $screen = $this->studentEdit();     break;
         case 'delete'         : $screen = $this->studentDelete();   break;
         case 'save_student'   : $screen = $this->saveStudent();     break;
         case 'update_student' : $screen = $this->updateStudent();     break;
         case 'report'         : $screen = $this->studentReport();     break;
         default          : $screen = $this->studentList();
      }

      exit;
   }
   
  

 /**
   * function studentList - show student list
   *
   * @param  none
   * @return  string - html content output
   */
   function studentList($msg=null)
   {
	  $query  = "SELECT * FROM student ORDER BY current_school_year, first_name, last_name" ;
      try
      {
         $rows = $this->db->select($query);
      }
      catch(Exception $Exception){}

      require_once LIST_TEMPLATE;
      exit;

   }

   function saveStudent() {
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $date_of_birth = date("Y-m-d", strtotime($_POST['date_of_birth']));
          $enrollment_date = date("Y-m-d", strtotime($_POST['enrollment_date']));
          $email = $_POST['email'];
          $current_school_year = $_POST['current_school_year'];
          $home_phone = $_POST['home_phone'];
          $mobile = $_POST['mobile'];
          $first_contact_name = $_POST['first_contact_name'];
          $first_contact_phone = $_POST['first_contact_phone'];
          $second_contact_name = $_POST['second_contact_name'];
          $second_contact_phone = $_POST['second_contact_phone'];

          $params             = array();
          $params['db_link']  = $this->db;
          $studentObj         = new Students($params);

          $studentObj->setFirstName($first_name);
          $studentObj->setLastName($last_name);
          $studentObj->setDateOfBirth($date_of_birth);
          $studentObj->setEnrolmentDate($enrollment_date);
          $studentObj->setEmail($email);
          $studentObj->setCurrentSchoolYear($current_school_year);
          $studentObj->setHomePhone($home_phone);
          $studentObj->setMobile($mobile);

          $studentObj->setFirstContactName($first_contact_name);
          $studentObj->setFirstContactPhone($first_contact_phone);
          $studentObj->setSecondContactName($second_contact_name);
          $studentObj->setSecondContactPhone($second_contact_phone);


          $studentId = $studentObj->create();

          $this->uploadAttachment($studentId);
          header("location: /majestic/run.php");
          exit;
   }

      function uploadAttachment($studentId)
      {
         $src  = $_FILES['file']['tmp_name'];
         $name = $_FILES['file']['name'];
         $ext = pathinfo($name, PATHINFO_EXTENSION);
         $dst = UPLOADED_IMAGE_DIR . '/' . $studentId .'.'. $ext;

         chmod(UPLOADED_IMAGE_DIR, 777);
         if (!empty($_FILES["file"]["name"])) {
            if(@move_uploaded_file($src, $dst))
            {
               $data = "{$_FILES['file']['name']}:$dst:{$_FILES['file']['size']}";
               //echo $data;
            }
         }
         return;
      }


 
 /**
   * function studentAdd - save new student
   *
   * @param  none
   * @return  boolean -add new student 
   */
   function studentAdd()
   {
 	  $query  = "SELECT * FROM student" ;
       try
       {
          $rows = $this->db->select($query);
       }
       catch(Exception $Exception){}

       require_once ADD_TEMPLATE;
       exit;
   }

 /**
   * function studentEdit - edit student
   *
   * @param  student id
   * @return  boolean -add new student
   */
   function studentEdit()
   {
      $studentId = $this->cmdList[2];
      if(empty($studentId)) $this->studentList();

 	  $query  = "SELECT * FROM student WHERE student_id = ". $studentId ;
       try
       {
          $rows = $this->db->select($query);
       }
       catch(Exception $Exception){}

       if(empty($rows)) $this->studentList();

       require_once EDIT_TEMPLATE;
       exit;
   }



   function updateStudent()
   {
      $studentId       = $_POST['studentId'];
      $first_name      = $_POST['first_name'];
      $last_name       = $_POST['last_name'];
      $date_of_birth   = date("Y-m-d", strtotime($_POST['date_of_birth']));
      $enrollment_date = date("Y-m-d", strtotime($_POST['enrollment_date']));
      $email           = $_POST['email'];

      $current_school_year  = $_POST['current_school_year'];
      $home_phone           = $_POST['home_phone'];
      $mobile               = $_POST['mobile'];
      $first_contact_name   = $_POST['first_contact_name'];
      $first_contact_phone  = $_POST['first_contact_phone'];
      $second_contact_name  = $_POST['second_contact_name'];
      $second_contact_phone = $_POST['second_contact_phone'];

      $data = array();
      $data['first_name']     = $first_name;
      $data['last_name']      = $last_name;
      $data['date_of_birth']  = $date_of_birth;
      $data['enrollment_date'] = $enrollment_date;
      $data['email']          = $email;

      $data['current_school_year']  = $current_school_year;
      $data['home_phone']           = $home_phone;
      $data['mobile']               = $mobile;
      $data['first_contact_name']   = $first_contact_name;
      $data['first_contact_phone']  = $first_contact_phone;
      $data['second_contact_name']  = $second_contact_name;
      $data['second_contact_phone'] = $second_contact_phone;

      $params          = array();
      $params['table'] = STUDENT_TBL;
      $params['where'] = " student_id = " . $studentId;
      $params['data']  = $data;

      $this->db->update($params);

      $this->uploadAttachment($studentId);

      header("location: /majestic/run.php");
      exit;
   }
   
/**
   * function studentDelete - delete student
   *
   * @param  none
   * @return  boolean -add new student
   */
   function studentDelete()
   {
      $studentId = $this->cmdList[2];
         if(empty($studentId)) $this->studentList();

    	  $query  = "DELETE  FROM student WHERE student_id = ". $studentId ;
          try
          {
             $rows = $this->db->select($query);
          }
          catch(Exception $Exception){}

          if(empty($rows)) $this->studentList();

          header("location: /majestic/run.php");
          exit;
   }

   function studentReport(){
	  $query  = "SELECT YEAR(enrollment_date) as e_year, COUNT(*) as total FROM student GROUP BY YEAR(enrollment_date)" ;
      try
      {
         $rows = $this->db->select($query);
      }
      catch(Exception $Exception){}

       require_once REPORT_TEMPLATE;
       exit;
   }


}
?>