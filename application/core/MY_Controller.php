<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    
    public function Plantilla($view, $data = array()){
        $this->load->view("./plantilla/header");
        $this->load->view($view,$data);
        $this->load->view("./plantilla/footer");
    }
    
    public function ConfigMail(){
        $conf_mail['protocol']  = 'smtp';
        $conf_mail['smtp_host'] = 'smtp.programandoideas.cl';                   //smtp.programandoideas.cl
        $conf_mail['smtp_port'] = 465;                                          //local 25 //pro:465
        $conf_mail['smtp_user'] = 'contacto@dwchile.cl';                        //contacto@dwchile.cl
        $conf_mail['smtp_pass'] = 'pr0gr4m4nd01d345';                           //pr0gr4m4nd01d345
        $conf_mail['charset']   = 'utf-8';
        $conf_mail['wordwrap']  = TRUE;
        $conf_mail['newline']   = "\r\n";

        $this->load->library("email",$conf_mail);
    }
}