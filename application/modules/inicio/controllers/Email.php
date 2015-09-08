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
            $this->session->set_userdata('error', validation_errors());
            redirect(base_url()."index.php/inicio/contacto");
        }else{
            $config['protocol'] = 'sendmail';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->from('contacto@programandoideas.cl');
            $this->email->to($email);
            $this->email->subject('Contacto desde programandoideas.cl');
            $this->email->message($nombre.", se ha puesto en contacto contigo y ha dicho: ".$mensaje);
            
            
            if($this->email->send()){
                echo "si";
                //$this->session->set_userdata('mensaje', "Su mensaje ha sido enviado exitosamente. Pronto nos contactaremos con usted.");
            }else{
                echo "no";
                //$this->session->set_userdata('mensaje', "No ha sido posible enviar el mensaje.");
            }
        }
        
        
        
                
        
        
        
    }
    
    
    
}
