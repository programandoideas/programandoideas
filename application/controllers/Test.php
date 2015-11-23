<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('captcha');
    }
    
    public function index(){
        //$this->rand = substr(number_format(time() * rand(),0,'',''),0,6);
        $vals = array(
		'word' => 'Random word',
		'img_path' => './captcha/',
		'img_url' => base_url().'captcha/',
		//'font_path' => './path/to/fonts/texb.ttf',
		'img_width' => '150',
		'img_height' => 30,
		'expiration' => 7200
	);

        $cap = create_captcha($vals);
        echo $cap['image'];
    }
    
}