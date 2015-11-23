<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    
    public function Plantilla($view, $data = array()){
        $this->load->view("./plantilla/header");
        $this->load->view($view,$data);
        $this->load->view("./plantilla/footer");
    }
}