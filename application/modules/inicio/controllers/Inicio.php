<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->Plantilla("index",array());
    }
    
    public function contacto(){
        $this->Plantilla("contacto",array());
    }
    
    public function nosotros(){
        $this->Plantilla("nosotros",array());
    }
    
    public function servicio(){
        $this->Plantilla("servicio",array());
    }
}