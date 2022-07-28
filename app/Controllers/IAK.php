<?php

class IAK extends Controller
{
   public function callBack()
   {
      $rawRequestInput = file_get_contents("php://input");
      // Baris ini melakukan format input mentah menjadi array asosiatif
      $arrRequestInput = json_decode($rawRequestInput, true);
      print_r($arrRequestInput);
   }
}
