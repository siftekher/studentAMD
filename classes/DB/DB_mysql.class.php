<?php

   class DB_mysql
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
          $this->link = mysql_connect($this->host, $this->user, $this->pass);
         
          if (mysql_error())
          {
             throw new Exception(mysql_error());
          }

          return $this->link;
      }
    

      public function selectDatabase()
      {
         return mysql_select_db($this->db, $this->link);  // different from mysqli call
      }

      public function query($query = null)
      {
         $this->query = $query;
         return mysql_query($this->query, $this->link); // diff from mysqli call
      }

      public function insert($query = null)
      {
         $this->query = $query;

         $results = mysql_query($this->query, $this->link);

         if (mysql_error())
         {
            throw new Exception(mysql_error());
         }

         return  mysql_insert_id();
      }

      public function select($query = null)
      {
         $this->query = $query;
         $results = mysql_query($this->query, $this->link); // diff from mysqli call

         if (!$results)
         {
            $this->error = mysql_error();
            throw new Exception("$query caused error: " . $this->error);
         }

         while($row = mysql_fetch_object($results))
         { 
            $rows[] = $row; 
         }

         mysql_free_result($results);

         return $rows;
      }

      public function prepareValue($value = null)
      {
         return "'" . mysql_real_escape_string($value) . "'";
      }

   }

?>