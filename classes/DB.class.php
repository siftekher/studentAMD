<?php
/**
* Filename      : DB.class.php
* Pre-requisite : MySQLi API enabled PHP
*
* @author    : Sheikh Iftekhar <siftekher@gmail.com>
* @project   : Majestic
* @version   : 1.0.0
* Features:
* 1. Creates a single connection per database credentials
* 2. Uses MySQLi/MySQL API
*/

class DB 
{
   const DEFAULT_MYSQL_API = 'mysqli';
   
   private $host;              // Database hostname
   private $user;              // Database username
   private $pass;              // Database password
   private $db;                // Database name
   private $api;               // mysqli or classic mysql API
   private $debug   = false;   // Debugging mode off by default
   private $verbose = 0;       // Be quiet

   public function __construct($params = array())
   {
      foreach($params as $key => $value)
      {
         $key = strtolower(trim($key));
         $this->$key  = $value;
      }

      // Set mysql API
      if (!in_array($this->api, array('mysqli', 'mysql')))
      {
          $this->api = DB::DEFAULT_MYSQL_API;
          $this->notice("Using default API: " . $this->api);
      }

      $this->dir          = dirname(__FILE__);
      $this->apiClassName = 'DB_' . $this->api;
      $this->apiClassFile = $this->dir . '/DB/' . $this->apiClassName . '.class.php';

      require_once($this->apiClassFile);
      
      try
      {
         $this->dbObject = new $this->apiClassName($params);
         $this->dbObject->connect();
         $this->dbObject->selectDatabase();
      }
      catch(Exception $e)
      {
         echo "Unable to Connect : " . $e->getMessage() . "\n";
      }
      
   }

   /**
   * This method perform truncate operation
   * @access public
   * @param  $query string, $diretive string
   * @return none
   */
   public function query($query = null, $diretive = null)
   {
      try
      {
         $this->debug && $this->debug($query);
         
         return $this->dbObject->query($query, $directive);
      }
      catch(Exception $e)
      {
         echo "Query failed: " . $e->getMessage() . "\n";
         return false;
      }
   }

   /**
   * This method perform truncate operation
   * @access public
   * @param  $table -- name of thr table
   * @return none
   */
   public function truncate($table = null)
   {
      try
      {
         $this->debug && $this->debug("TRUNCATE $table");
         
         return $this->dbObject->query("TRUNCATE $table");
      }
      catch(Exception $e)
      {
         echo "TRUNCATE FAILED: " . $e->getMessage() ."\n";
         return false;
      }
   }

   /**
   * This method perform select operation
   * @access public
   * @param  $query string
   * @return none
   */
   public function select($query = null)
   {
      return $this->dbObject->select($query);
   }

   /* This method perform update operation
   * @access public
   * @param  $params array
   * @return none
   */
   public function update($params = null)
   {
      $table      = $params['table'];
      $where      = $params['where'];
      $data       = $params['data'];
      $directive  = $params['directive'];
      $comments   = empty($params['comments']) ? null : '/* ' . $params['comments'] . ' */ ';
      $dataSet    = $this->makeDataSet($data);
      $query      = empty($directive) ? "$comments UPDATE $table SET $dataSet WHERE $where" : 
                                        "$comments UPDATE $directive $table SET $dataSet WHERE $where";

      try
      {
         $this->debug && $this->debug($query);
         
         $this->dbObject->query($query);
         return true; 
      }
      catch(Exception $e)
      {
         echo "UPDATE FAILED: " . $e->getMessage() ."\n";
         return false;
      }
   }

   /* This method perform replace operation
   * @access public
   * @param  $params array
   * @return none
   */
   public function replace($params = null)
   {
      $table      = $params['table'];
      $where      = $params['where'];
      $data       = $params['data'];
      $directive  = $params['directive'];
      $comments   = empty($params['comments']) ? null : '/* ' . $params['comments'] . ' */ ';
      $dataSet    = $this->makeDataSet($data);
      $query      = empty($directive) ? "$comments REPLACE $table SET $dataSet WHERE $where" :
                                        "$comments REPLACE $directive $table SET $dataSet WHERE $where";

      try
      {
         $this->debug && $this->debug($query);
          
         return $this->dbObject->query($query);
      }
      catch(Exception $e)
      {
         echo "UPDATE FAILED: " . $e->getMessage() ."\n";
         return false;
      }
   }

   /* This method perform insert operation
   * @access public
   * @param  $params array
   * @return none
   */
   public function insert($params = null)
   {
      $table      = $params['table'];
      $data       = $params['data'];
      $directive  = empty($params['directive']) ? '' : $params['directive'];
      $comments   = empty($params['comments']) ? null : '/* ' . $params['comments'] . ' */ ';
      $dataSet    = $this->makeDataSet($data);
      $query      = empty($directive) ? "$comments INSERT $table SET $dataSet" : "$comments INSERT $directive $table SET $dataSet";

      try
      {
         $this->debug && $this->debug($query);
          
         return $this->dbObject->insert($query); 
      }
      catch(Exception $e)
      {
         echo "INSERT FAILED: " . $e->getMessage() ."\n";
         return false;
      }
   }

   /* This method perform delete operation
   * @access public
   * @param  $params array
   * @return none
   */
   public function delete($params = null)
   {
      $table      = $params['table'];
      $where      = $params['where'];
      $directive  = $params['directive'];
      $comments   = empty($params['comments']) ? null : '/* ' . $params['comments'] . ' */ ';
      $query      = empty($directive) ? "$comments DELETE FROM $table WHERE $where" : 
                                        "$comments DELETE $directive FROM $table WHERE $where";

      try
      {
          $this->debug && $this->debug($query);

          $this->dbObject->query($query);
          return true;
      }
      catch(Exception $e)
      {
         echo "DELETE FAILED: " . $e->getMessage() ."\n";
         return false;
      }
   }

   /*
   * This method format the array
   * @access public
   * @param  $msg array
   * @return none
   */
   public function makeDataSet($data = null)
   {
      if (count($data) < 1)
      {
         return null;
      }
  
      foreach($data as $key => $value)
      {
         $dataSet[] = $key . '=' . $this->dbObject->prepareValue($value);
      }

      return join(',', $dataSet);
   }

   /*
   * @access private
   * @param  $msg string
   *         $echo boolean
   *         $log boolean
   * @return none
   */
   private function debug($msg = null, $echo = true, $log = true)
   {   
      $now = date('m/d/Y H:i:s ');
      
      if ($echo)
      {
         echo "\n" . $now . "=> $msg\n";
      }
     
      if ($log)
      {
         $this->writeFile($msg);
      }

      return true;
   }
   
   /**
   * This method open /create file on a formation of year->month->day
   *             also information write in file
   * @access public
   * @param  $msg string
   * @return none
   */
   public function writeFile($msg = null)
   {
      $thisYear  = date('Y');
      $thisMonth = date('m');
      $thisDay   = date('d');
      $filePath  = DOCUMENT_ROOT . '/log/' . $thisYear . '/' .  $thisMonth;

      if (!is_dir($filePath))
      {
         mkdir($filePath, 0755, true);
      }

      $filename = "$thisMonth$thisDay.log";
      $fp = fopen($filePath . '/' . $filename, 'a+');
      
      if (!$fp)
      {
         return false;
      }
      else
      {
         fwrite($fp, " $msg \n");
      }
      
      fclose($fp);
   }
   
   /**
   * Get Host name
   * @access public
   * @param  none
   * @return none
   */
   public function getHost()
   {
      return $this->host;
   }

   /**
   * Set Host name
   * @access public
   * @param  $host - name of the host
   * @return none
   */
   public function setHost($host = null)
   {
      $this->host = $host ? $host : DB_HOST;
   }

   /**
   * Get User name
   * @access public
   * @param  none
   * @return none
   */
   public function getUser()
   {
      return $this->user;
   }

   /**
   * Set user name
   * @access public
   * @param  $user - name of the user
   * @return none
   */
   public function setUser($user = null)
   {
      $this->user = $user ? $user : DB_USER;
   }

   /**
   * Get Password
   * @access public
   * @param  none
   * @return none
   */
   public function getPass()
   {
      return $this->pass;
   }

   /**
   * Set Password
   * @access public
   * @param  $pass - name of the password
   * @return none
   */
   public function setPass($pass = null)
   {
      $this->pass = $pass ? $pass : DB_PASS;
   }

   /**
   * Get database name
   * @access public
   * @param  none
   * @return none
   */
   public function getDb()
   {
      return $this->db;
   }

   /**
   * Set database name
   * @access public
   * @param  $db - name of the database
   * @return none
   */
   public function setDb($db = null)
   {
      $this->db = $db ? $db : DB_NAME;
   }

   /**
   * make Noise
   * @access public
   * @param  none
   * @return none
   */
   public function makeNoise()
   {
      $this->verbose++;
   }

   /**
   * notice
   * @access private
   * @param  $notice - string
   * @return none
   */
   private function notice($notice = null)
   {
      if ($this->verbose > 0)
      {
         $this->debug("NOTICE: $notice");
      }
   }


} // End of DB class

?>