<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        /*$conf_mail = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'smtp.programandoideas.cl',
                'smtp_port' => 465,
                'smtp_user' => 'contacto@dwchile.cl',
                'smtp_pass' => 'pr0gr4m4nd01d345',
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'wordwrap'  => TRUE,
                'newline'   => "\r\n"
        );*/
        $this->load->library("email");
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
            
            /*$this->email->from($email,$apellido." ".$nombre);
            $this->email->to('contacto@dwchile.cl');
            $this->email->subject('[CONTACTO]');
            $this->email->message($mensaje);

            if($this->email->send()){*/
                
                if($this->Reenvio($email)){
                    
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
            /*}else{
                
                $men =  "No ha sido posible enviar el mensaje. Puede enviarnos un correo a contacto@dwchile.cl";
                $data['clase']="alert-danger";
                $data['mensaje'] = $men;
                $data['id'] = "mensaje1";
            } */
            $this->Plantilla("contacto",$data);
        }
    }


    public function Reenvio($email){
        $path = base_url();
        $mensaje = "<html xmlns={unwrap}\"http://www.w3.org/1999/xhtml\">";
        $mensaje .= "<head>
                        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
                        <link href='".$path."assets/css/bootstrap.min.css' rel='stylesheet'>
                    </head
                    <body> 
                    <div class='col-md-8 col-md-offset-3'>
                        <table style='background: #2ecc71;'>
                            <tr>
                                <td>
                                    <img src='".$path."assets/images/correo/header.png' width='700px;'/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class='col-md-12'>
                                        <table>
                                            <tr>
                                                <td>
                                                    <h3 style='color: #fff'>
                                                        <img src='".$path."assets/images/correo/email-logo.png' width='60px'/>
                                                        Nueva solicitud
                                                    </h3>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class='col-md-10 col-md-offset-1'>
                                        <table>
                                            <tr>
                                                <td>
                                                    <p>
                                                        <h5 style='color: #fff;'>
                                                            <p>
                                                                Hola, Elias Catalán <br/><br/>
                                                                Su solicitud fue recibida con éxito por el equipo de DWChile, nos contactaremos a la brevedad con usted.
                                                            </p>
                                                        </h5>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>
                                                        <h5 style='color: #fff'>
                                                            <p>
                                                                <br/>
                                                                <b>Detalle Solicitud: </b><br/>
                                                                Necesito una pagina web... para subir videos pornos...<br/><br/><br/>
                                                            </p>
                                                        </h5>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table style='background: #34495e; width: 702px;'>
                            <tr>
                                <td>
                                    <div class='col-md-12'>
                                        <table>
                                            <tr>
                                                <td style='color: #fff;'>
                                                    <p><b><br/>Atte.</b><br/>Equipo DWChile.</p>
                                                </td>
                                                <td style='width: 500px; text-align: right;'>
                                                    <br/>
                                                    <img src='".$path."assets/images/correo/facebook.png' width='20px'/>
                                                    <img src='".$path."assets/images/correo/twitter.png' width='20px'/>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>                
                                </td>
                            </tr>
                        </table>
                    </div>";
        $mensaje .= "</body></html>";
        
        //$mensaje = "<html xmlns=\"http://www.w3.org/1999/xhtml\"> <body><b>hola mundo<b/></body></html>";
        
        $this->email->from('no-reply@dwchile.cl','DWChile');
        $this->email->to($email);
        $this->email->subject('Solicitud');
        $this->email->message($mensaje);

        if($this->email->send()){
            return true;
        }else{
            return false;
        }
    }
}
