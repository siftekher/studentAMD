<?php
/**
* Filename   : Student.class.php
*
* @author    : Sheikh Iftekhar <siftekher@gmail.com>
* @project   : Majestic
* @version   : 1.0.0
* @copyright :
**/


class Students
{
   private $dbLink;
   private $studentId;
   private $first_name;
   private $last_name;
   private $date_of_birth;
   private $enrollment_date;
   private $email;
   private $current_school_year;
   private $home_phone;
   private $mobile;
   private $first_contact_name;
   private $first_contact_phone;
   private $second_contact_name;
   private $second_contact_phone;

   const EXCEPTION_NO_DB_LINK = 'Please provide database link.';

   public function __construct($params = null)
   {
      if (empty($params['db_link']))
      {
          throw new Exception(SELF::EXCEPTION_NO_DB_LINK );
          return;
      }

      $this->dbLink = $params['db_link'];


      if(isset($params['student_id']))
      {
         $this->studentId = $params['student_id'];
         $this->loadUsingTicketId();
      }
   }


   /**
   *
   * @access public
   * @param  none
   * @return none
   */
   public function getStudentId()
   {
      return $this->studentId;
   }


   /**
   * set Student Id
   * @access public
   * @param  studentId
   * @return none
   */
   public function setStudentId($studentId = null)
   {
      $this->studentId = $studentId;
   }

   /**
   * get First Name
   * @access public
   * @param  none
   * @return $first_name
   */
   public function getFirstName()
   {
      return $this->first_name;
   }

   /**
   * set First Name
   * @access public
   * @param  first_name
   * @return none
   */
   public function setFirstName($first_name = null)
   {
      $this->first_name = $first_name;
   }

   /**
   * get Last Name
   * @access public
   * @param  none
   * @return $last_name
   */
   public function getLastName()
   {
      return $this->last_name;
   }

   /**
   * set Last Name
   * @access public
   * @param  last_name
   * @return none
   */
   public function setLastName($last_name = null)
   {
      $this->last_name = $last_name;
   }

   /**
   * get Last Name
   * @access public
   * @param  none
   * @return $date_of_birth
   */
   public function getDateOfBirth()
   {
      return $this->date_of_birth;
   }

   /**
   * set date_of_birth
   * @access public
   * @param  date_of_birth
   * @return none
   */
   public function setDateOfBirth($date_of_birth = null)
   {
      $this->date_of_birth = $date_of_birth;
   }

    /**
    * get enrollment_date
    * @access public
    * @param  none
    * @return $enrollment_date
    */
    public function getEnrolmentDate()
    {
       return $this->enrollment_date ;
    }
   /**
   * set enrollment_date
   * @access public
   * @param  enrollment_date
   * @return none
   */
   public function setEnrolmentDate($enrollment_date  = null)
   {
      $this->enrollment_date  = $enrollment_date ;
   }


    /**
    * get email
    * @access public
    * @param  none
    * @return $email
    */
    public function getEmail()
    {
       return $this->email;
    }
   /**
   * set email
   * @access public
   * @param  email
   * @return none
   */
   public function setEmail($email = null)
   {
      $this->email = $email;
   }


    /**
    * get current_school_year
    * @access public
    * @param  none
    * @return $current_school_year
    */
    public function getCurrentSchoolYear()
    {
       return $this->current_school_year;
    }
   /**
   * set current_school_year
   * @access public
   * @param  email
   * @return none
   */
   public function setCurrentSchoolYear($current_school_year = null)
   {
      $this->current_school_year = $current_school_year;
   }

     /**
     * get home_phone
     * @access public
     * @param  none
     * @return $home_phone
     */
     public function getHomePhone()
     {
        return $this->current_school_year;
     }
    /**
    * set home_phone
    * @access public
    * @param  home_phone
    * @return none
    */
    public function setHomePhone($home_phone = null)
    {
       $this->home_phone = $home_phone;
    }


     /**
     * get mobile
     * @access public
     * @param  none
     * @return $mobile
     */
     public function geMobile()
     {
        return $this->current_school_year;
     }
    /**
    * set mobile
    * @access public
    * @param  mobile
    * @return none
    */
    public function setMobile($mobile = null)
    {
       $this->mobile = $mobile;
    }

     /**
     * get first_contact_name
     * @access public
     * @param  none
     * @return $first_contact_name
     */
     public function getFirstContactName()
     {
        return $this->current_school_year;
     }
    /**
    * set first_contact_name
    * @access public
    * @param  first_contact_name
    * @return none
    */
    public function setFirstContactName($first_contact_name = null)
    {
       $this->first_contact_name = $first_contact_name;
    }

     /**
     * get first_contact_phone
     * @access public
     * @param  none
     * @return $first_contact_phone
     */
     public function getFirstContactPhone()
     {
        return $this->first_contact_phone;
     }
    /**
    * set first_contact_phone
    * @access public
    * @param  first_contact_phone
    * @return none
    */
    public function setFirstContactPhone($first_contact_phone = null)
    {
       $this->first_contact_phone = $first_contact_phone;
    }

      /**
      * get second_contact_name
      * @access public
      * @param  none
      * @return $second_contact_name
      */
      public function getSecondContactName()
      {
         return $this->second_contact_name;
      }
     /**
     * set second_contact_name
     * @access public
     * @param  second_contact_name
     * @return none
     */
     public function setSecondContactName($second_contact_name = null)
     {
        $this->second_contact_name = $second_contact_name;
     }

      /**
      * get second_contact_phone
      * @access public
      * @param  none
      * @return $second_contact_phone
      */
      public function getSecondContactPhone()
      {
         return $this->second_contact_phone;
      }
     /**
     * set second_contact_phone
     * @access public
     * @param  second_contact_phone
     * @return none
     */
     public function setSecondContactPhone($second_contact_phone = null)
     {
        $this->second_contact_phone = $second_contact_phone;
     }

   /**
   * load using student_id
   * @access private
   * @param  none
   * @return none
   */
   private function loadUsingStudentId()
   {
      $query = "SELECT  *
                 FROM " . STUDENT_TBL .
                 " WHERE student_id = " . $this->studentId;

      $row = $this->dbLink->select($query);

      if(count($row))
      {
         foreach($row as $key => $value)
         {
            $this->studentId      = $value->student_id;
            $this->first_name     = $value->first_name;
            $this->last_name      = $value->last_name;
            $this->date_of_birth  = $value->date_of_birth;
            $this->enrollment_date = $value->enrollment_date;

            $this->email                = $value->email;
            $this->current_school_year  = $value->current_school_year;
            $this->home_phone           = $value->home_phone;
            $this->mobile               = $value->mobile;
            $this->first_contact_name   = $value->first_contact_name;
            $this->first_contact_phone  = $value->first_contact_phone;
            $this->second_contact_name  = $value->second_contact_name;
            $this->second_contact_phone = $value->second_contact_phone;
         }
      }
   }

   /**
   *
   * @access public
   * @param  none
   * @return none
   */
   public function create()
   {
      $params          = array();
      $params['table'] = STUDENT_TBL;
      $data            = array();
      $data['first_name']          = $this->first_name;
      $data['last_name']           = $this->last_name;
      $data['date_of_birth']       = $this->date_of_birth;
      $data['enrollment_date']      = $this->enrollment_date;

      $data['email']               = $this->email;
      $data['current_school_year'] = $this->current_school_year;
      $data['home_phone']          = $this->home_phone;
      $data['mobile']              = $this->mobile;
      $data['first_contact_name']  = $this->first_contact_name;
      $data['first_contact_phone'] = $this->first_contact_phone;
      $data['second_contact_name']  = $this->second_contact_name;
      $data['second_contact_phone'] = $this->second_contact_phone;
      //$data['create_date']          = date("Y-m-d H:i:s");

      $params['data'] = $data;

      return $this->dbLink->insert($params);
   }

   /**
   *
   * @access public
   * @param  none
   * @return none
   */
   public function update()
   {
      $params          = array();
      $params['table'] = STUDENT_TBL;
      $params['where'] = " student_id = " . $this->studentId;
      $data            = array();
      $data['first_name']          = $this->first_name;
      $data['last_name']           = $this->last_name;
      $data['date_of_birth']       = $this->date_of_birth;
      $data['enrollment_date']      = $this->enrollment_date;

      $data['email']               = $this->email;
      $data['current_school_year'] = $this->current_school_year;
      $data['home_phone']          = $this->home_phone;
      $data['mobile']              = $this->mobile;
      $data['first_contact_name']  = $this->first_contact_name;
      $data['first_contact_phone'] = $this->first_contact_phone;
      $data['second_contact_name']  = $this->second_contact_name;
      $data['second_contact_phone'] = $this->second_contact_phone;

      $params['data'] = $data;

      $this->dbLink->update($params);

   }

   /**
   * delete
   * @access public
   * @param  none
   * @return none
   */
   public function delete()
   {
      $params   = array();
      $params['table'] = STUDENT_TBL;
      $params['where'] = " student_id = " . $this->studentId;

      $this->dbLink->delete($params);
   }




}   // End of Tickets class

?>