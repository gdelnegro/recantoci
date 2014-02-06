<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Entrada extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
			redirect(base_url()."login");
		}
	}
	
	public function index(){
                $this->load->library('table');
		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('entrada');
		$this->load->view('html_footer');
	}
	
	public function login(){		
		$usuario = $this->input->post('usuario');
		$senha = $this->input->post('senha');
		$this->db->where('usuario',$usuario);
		$this->db->where('senha',$senha);
		$this->db->where('ativo',1);
		$usuario = $this->db->get('usuarios')->result();		
		if(count($usuario)===1){
			$dados = array(
               'usuario'  => $usuario[0]->usuario,
               'logado' => TRUE
            );
			$this->session->set_userdata($dados);
			redirect(base_url()."categorias");
		}
		else{
			redirect(base_url()."home/index");
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url()."home/index");
	}
}