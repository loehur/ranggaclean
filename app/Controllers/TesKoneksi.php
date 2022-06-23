<?php

class TesKoneksi extends Controller
{

   //CLEVER SERVER
   // public $db_host = 'b1sm0doksfrkeqznptf9-mysql.services.clever-cloud.com:3306';
   // public $db_user = 'uqmrebtlwu2q4iz4';
   // public $db_pass = 'VjFGvb8ShqTNOXOfK6MW';
   // public $db_name = 'b1sm0doksfrkeqznptf9';

   //CLOUD GOOGLE
   public $db_host = '34.128.127.99';
   public $db_user = 'luhur';
   public $db_pass = 'a123654b';
   public $db_name = 'laundry';

   private static $_instance = null;
   private $mysqli;

   public function __construct()
   {
      $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name) or die('DB Error');
   }

   public static function getInstance()
   {
      if (!isset(self::$_instance)) {
         self::$_instance = new TesKoneksi();
      }

      return self::$_instance;
   }

   public function index()
   {
      if ($this->mysqli->connect_error) {
         die("Connection failed: " . $this->mysqli->connect_error);
      }
      echo "Connected successfully";
   }
}
