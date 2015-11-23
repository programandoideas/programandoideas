<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function InsertaCaptcha($captcha){
        $sql = "INSERT INTO captcha set tiempo_captcha = ?, ip = ?, palabra = ?";
        $data = $this->db->query($sql, array($captcha['time'],$this->input->ip_address(),$captcha['word']));
        if($data){
            return true;
        }else{
            return false;
        }
    }
    
    public function RemueveCaptcha($expiracion){
        $sql = "DELETE FROM captcha WHERE tiempo_captcha = ?";
        $data = $this->db->query($sql, array($expiracion));
        if($data){
            return true;
        }else{
            return false;
        }
    }
    
    public function ExisteCaptcha(){
        
    }
    
}