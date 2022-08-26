<?php

class Payment extends Controller
{

   public $load;
   public $view_content;
   public $view_dir = "payment";
   public function __construct()
   {
      $this->load = ucfirst($this->view_dir . "/load");
      $this->view_content = $this->view_dir . "/content";
   }

   public function index()
   {
      $this->view("layouts/layout_main", ["view_load" => $this->load]);
   }

   public function load()
   {
      $this->view($this->view_content);
   }
}
