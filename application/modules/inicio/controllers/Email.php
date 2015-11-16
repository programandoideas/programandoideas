<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->Plantilla("contacto",array());
    }
    
    
    public function Envio_email(){
        
        
        $nombre = $this->input->post("nombre");
        $apellido = $this->input->post("apellido");
        $email = $this->input->post("email");
        $mensaje = $this->input->post("mensaje");
        
        $this->form_validation->set_rules("nombre","Nombre","trim|min_length[3]");
        $this->form_validation->set_rules("apellido","Apellido","trim|min_length[3]");
        $this->form_validation->set_rules("email","Email","trim|valid_email");
        
        
        $this->form_validation->set_message('min_length',"El campo %s debe tener a lo menos 3 caracteres");
        $this->form_validation->set_message('valid_base64',"El campo %s contiene caracteres invalidos.");
        $this->form_validation->set_message('valid_email',"Debe ingresar un email válido.");
        
        if($this->form_validation->run() == FALSE){
            
            $men = validation_errors();
            $data['clase']="alert-danger";
            $data['mensaje'] = $men;
            $data['id'] = "mensaje1";
            $this->Plantilla("contacto",$data);
            
        }else{
            $config = array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'smtp.programandoideas.cl',
                    'smtp_port' => 465,
                    'smtp_user' => 'contacto@dwchile.cl',
                    'smtp_pass' => 'pr0gr4m4nd01d345',
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'wordwrap'  => TRUE,
                    'newline'   => "\r\n"
            );    
            
            $this->load->library("email",$config);
            $this->email->from($email,$apellido." ".$nombre);
            $this->email->to('contacto@dwchile.cl');
            $this->email->subject('[CONTACTO]');
            $this->email->message($mensaje);

            if($this->email->send()){
                
                $men =  "Su mensaje ha sido enviado exitosamente. Pronto nos contactaremos con usted. ¡GRACIAS POR VISITARNOS!";
                $data['clase']="alert-info";
                $data['mensaje'] = $men;
                $data['id'] = "mensaje";
                
            }else{
                
                $men =  "No ha sido posible enviar el mensaje. Puede enviarnos un correo a contacto@dwchile.cl";
                $data['clase']="alert-danger";
                $data['mensaje'] = $men;
                $data['id'] = "mensaje1";
            } 
            $this->Plantilla("contacto",$data);
        }
    }


    public function reenvio(){ 



    }
    
    
    
}
