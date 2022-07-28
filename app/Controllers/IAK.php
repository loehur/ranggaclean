<?php

class IAK extends Controller
{
   public function callBack()
   {
      $rawRequestInput = file_get_contents("php://input");
      $arrRequestInput = json_decode($rawRequestInput, true);
      $data = $arrRequestInput['data'];
      echo $data['status'];
   }
}
