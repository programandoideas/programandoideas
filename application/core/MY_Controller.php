<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Captcha');
    }
    
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
    
    public function CreaCaptcha(){
        
        $this->rand = substr(number_format(time() * rand(),0,'',''),0,6);
        $conf_captcha = array(
                'word'          => $this->rand,
                'img_path'      => './captcha/',
                'img_url'       =>  base_url().'captcha/',
                'font_path'     => './captcha/fonts/Sears.ttf',
                'img_width'     => '120',
                'img_height'    => '40',
                'expiration'    => 300 
        );
        
        $cap = create_captcha($conf_captcha);
        $this->session->set_userdata('captcha', $this->rand);
        $this->Captcha->InsertaCaptcha($cap);
        return $cap;
    }
    
    public function validate_captcha(){
        if($this->input->post('captcha') != $this->session->userdata('captcha')){
            $this->form_validation->set_message('validate_captcha', 'Ingrese captcha nuevamente');
            return false;
        }else{
            return true;
        }
    }
    
    public function RemueveCaptcha($expiracion){
        $this->Captcha->RemueveCaptcha($expiracion);
    }
    
    public function ExisteCaptcha($ip,$expiracion,$captcha){
        $check = $this->Captcha->check($ip,$expiration,$captcha);
    }
}