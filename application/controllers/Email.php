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
            
            $this->ConfigMail();
            $this->email->set_mailtype("html");
            $this->email->from($email,$apellido." ".$nombre);
            $this->email->to('contacto@dwchile.cl');
            $this->email->subject('[CONTACTO]');
            
            $msj = $this->CorreoPersonalizado(1,'DWChile',$nombre." ".$apellido,$mensaje);

            $this->email->message($msj);

            if($this->email->send()){
                $this->email->clear();
                
                $reenvio = $this->Reenvio($email,$nombre." ".$apellido,$mensaje);
                if($reenvio){
                    
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
            }else{
                $this->email->clear();
                $men =  "No ha sido posible enviar el mensaje. Puede enviarnos un correo a contacto@dwchile.cl";
                $data['clase']="alert-danger";
                $data['mensaje'] = $men;
                $data['id'] = "mensaje1";
            }
            $this->Plantilla("contacto",$data);
        }
    }


    public function Reenvio($email,$nombre,$detalle){
      
        $this->ConfigMail();
        $this->email->set_mailtype("html");                
        $this->email->from('no-reply@dwchile.cl','DWChile');
        $this->email->to($email);
        $this->email->subject('Solicitud');
        
        $msj = $this->CorreoPersonalizado(2,$nombre,'',$detalle);
        $this->email->message($msj);

        if($this->email->send()){
            $this->email->clear();
            return true;
        }else{
            $this->email->clear();
            return false;
        }
    }
    
    public function CorreoPersonalizado($opcion,$nombre_1,$nombre_2,$detalle){
        $path = base_url();
        $mensaje = "<center>
                        <table border=\"0\" style=\"background: #2ecc71\" cellpading=\"0\" cellspacing=\"0\" width=\"500\">
                            <tr>
                                <td><img src=\"".$path."assets/images/correo/header.png\" width=\"600\" height=\"160\"/></td>
                            </tr>
                            <tr style=\"background: #2ecc71;\">
                                <td>
                                    <table height=\"66\">
                                        <tr height=\"50px\">
                                            <td width=\"10\">&nbsp;</td>
                                            <td><img src=\"".$path."assets/images/correo/email-logo.png\" width=\"50\"/></td>
                                            <td style=\"font-family: inherit; color: #fff; vertical-align: middle;\"><h3>Nueva solicitud</h3></td>
                                        </tr>	
                                    </table>
                                </td>
                            </tr>
                            <tr style=\"background: #2ecc71; vertical-align: middle;\">
                                <td>
                                    <table width=\"564\">
                                        <tr>
                                            <td width=\"38\">&nbsp;</td>
                                            <td width=\"634\" style=\"font-family: inherit; color: #fff; font-size: 14px\">
                                                Hola, ".$nombre_1." <br/>
                                                <br/>
                                                ".($opcion == 1 ? 
                                                    "Hemos recibido una solicitud a nombre de ".$nombre_2 
                                                    : 
                                                    "Su solicitud fue recibida con éxito por el equipo de 
                                                        DWChile, nos contactaremos a la brevedad 
                                                        con usted."
                                                )."
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr style=\"background: #2ecc71; vertical-align: middle;\">
                                <td>
                                    <table>
                                        <tr>
                                            <td width=\"10\">&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr style=\"background: #2ecc71; vertical-align: middle;\">
                                <td>
                                    <table width=\"561\">
                                        <tr>
                                            <td width=\"38\">&nbsp;</td>
                                            <td width=\"634\" style=\"font-family: inherit; color: #fff; font-size: 14px\">
                                                <b>Detalle Solicitud: </b><br/>
                                                ".$detalle."
                                                <br/><br/><br/>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr style=\"background: #34495e;\">
                                <td>
                                    <table width=\"560\">
                                        <tr>
                                            <td width=\"24\">&nbsp;</td>
                                            <td width=\"416\" style=\"font-family: inherit; color: #fff; font-size: 14px\">
                                                <br/> Atte.<br/>Equipo DWChile<br/><br/>
                                            </td>
                                            <td width=\"104\">
                                                <table>
                                                    <tr>
                                                        <td><img src=\"".$path."assets/images/correo/facebook.png\" width=\"20\"/></td>
                                                        <td style=\"color: #fff\">DWChile</td>
                                                    </tr>
                                                    <tr>
                                                        <td><img src=\"".$path."assets/images/correo/twitter.png\" width=\"20\"/></td>
                                                        <td style=\"color: #fff\">@DWChile</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </center>";
        return $mensaje;
    }
}
