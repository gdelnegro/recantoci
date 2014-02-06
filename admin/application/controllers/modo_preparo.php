<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Modo_preparo extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
			redirect(base_url()."home");
		}
	}
	
	public function index(){
		$this->load->library('table');
		$data['modo_preparo'] = $this->db->get('modo_preparo')->result();
		$this->load->view('html_header');
		$this->load->view('menu');
                $this->load->view('acougue_menu');
		$this->load->view('modo_preparo',$data);
		$this->load->view('html_footer');
	}
	
	public function salvar_alteracao(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('modo_preparo', 'modo_preparo', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			#$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/preparo';
                        $diretorio = getcwd();
                        $config['upload_path'] = $diretorio.'/../imagens/preparo';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1024';
			$config['max_width']  = '800';
			$config['max_height']  = '600';
			$config['encrypt_name'] = true;		
			$this->load->library('upload', $config);
			if($this->upload->do_upload())
			{
				$arquivo_upado = $this->upload->data();
				$dados['imagem_modo_preparo'] = $arquivo_upado['file_name'];
			}	
			
			$dados['modo_preparo'] = $this->input->post('modo_preparo');
			
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('modo_preparo',$dados);
			redirect(base_url()."modo_preparo");
		}
	}
	
	
	public function adicionar(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('modo_preparo', 'Modo de preparo', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
                        $diretorio = getcwd();
                        $config['upload_path'] = $diretorio.'/../imagens/preparo';
			#$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/acougue/modo_preparo';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1024';
			$config['max_width']  = '800';
			$config['max_height']  = '600';
			$config['encrypt_name'] = true;		
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload())
			{
				echo $this->upload->display_errors();			
				echo "<a href='javascript:history.go(-1)'>Voltar e corrigir.</a>";
			}	
			else{
				$dados['modo_preparo'] = $this->input->post('modo_preparo');
				$arquivo_upado = $this->upload->data();
				$dados['imagem_modo_preparo'] = $arquivo_upado['file_name'];
				$this->db->insert('modo_preparo',$dados);
				redirect(base_url()."modo_preparo");
			}
		}
	}

	public function editar($modo_preparo = null){
		$this->db->where('id',$modo_preparo);
		$data['modo_preparo'] = $this->db->get('modo_preparo')->result();
		
		$this->load->view('html_header');
		$this->load->view('menu');
                $this->load->view('acougue_menu');
		$this->load->view('editar_modo_preparo',$data);
		$this->load->view('html_footer');
	}
	
	public function excluir($id){
		$this->db->where('id',$id);
		$this->db->delete('modo_preparo');
		redirect(base_url()."modo_preparo");
	} 
}