<?php

   class DB_mysqli
   {
      protected $link;
      private $host;
      private $user;
      private $pass;
      private $db;

      public function __construct($params = null)
      {
         foreach($params as $key => $value)
         {
            $key = strtolower(trim($key));
            $this->$key  = $value;
         }
      }

      public function connect()
      {
          $this->link = mysqli_connect($this->host, $this->user, $this->pass);
         
          if (mysqli_connect_error())
          {
             throw new Exception(mysqli_connect_errno() . ' : ' . mysqli_connect_error());
          }

          return $this->link;
      }
    
      public function selectDatabase()
      {
         return mysqli_select_db($this->link, $this->db);
      }

      public function query($query = null)
      {
         $this->query = $query;

         $results =  mysqli_query($this->link, $this->query);

         if (mysqli_error($this->link))
         {
            throw new Exception(mysqli_error($this->link));
         }
         
         return true;
      }

      public function insert($query = null)
      {
         $this->query = $query;

         $results = mysqli_query($this->link, $this->query);

         if (mysqli_error($this->link))
         {
            throw new Exception(mysqli_error($this->link));
         } 

         return  mysqli_insert_id($this->link);
      }

      public function select($query = null)
      {
         $this->query = $query;
         $results = mysqli_query($this->link, $this->query);

         if (!$results)
         {
            $this->error = mysqli_error($this->link);
            throw new Exception("$query caused error: " . $this->error);
         }

         while($row = mysqli_fetch_object($results))
         { 
            $rows[] = $row; 
         }

         mysqli_free_result($results);

         return $rows;
      }

      public function prepareValue($value = null)
      {
         return "'" . mysqli_real_escape_string($this->link, $value) . "'";
      }
   }

?>