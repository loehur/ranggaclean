<?php

class CompanyProfile extends Controller
{

   public $load;
   public $view_content;
   public function __construct()
   {
      $this->load = "CompanyProfile/load";
      $this->view_content = "company_profile/content";
   }

   public function index()
   {
      $view_load = $this->load;
      $this->view("layouts/layout_main", ["view_load" => $view_load]);
   }

   public function load()
   {
      $this->view($this->view_content);
   }
}
