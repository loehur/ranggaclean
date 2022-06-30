<?php

class Send extends Controller
{
   public function index()
   {
      $curl = curl_init();
      $data = [
         'number' => 'jakasembung', // number sender
         'message' => 'haloo azeh', // message content
         'to' => '6285211593539', // number receiver
      ];

      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($curl, CURLOPT_URL, 'http://localhost:9000/send');
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
      $result = curl_exec($curl);
      curl_close($curl);

      echo "<pre>";
      print_r($result);
   }
}
