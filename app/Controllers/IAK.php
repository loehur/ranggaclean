<?php

class IAK extends Controller
{
   public function callBack()
   {
      $rawRequestInput = file_get_contents("php://input");
      $arrRequestInput = json_decode($rawRequestInput, true);
      $d = $arrRequestInput['data'];
      echo $d['status'];
   }
}
