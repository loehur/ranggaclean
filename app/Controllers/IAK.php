<?php

class IAK extends Controller
{
   public function callBack()
   {
      header("Content-Type: application/json; charset=UTF-8");
      $obj = json_decode($_GET["data"], true);
      var_dump($obj);
   }
}
