<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Cortes extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
			redirect(base_url()."home");
		}
	}
	
	public function index(){
		$this->load->library('table');
		$data['cortes'] = $this->db->get('cortes')->result();
		$this->load->view('html_header');
		$this->load->view('menu');
                $this->load->view('acougue_menu');
		$this->load->view('cortes',$data);
		$this->load->view('html_footer');
	}
	
	public function salvar_alteracao(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titulo', 'Título', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/acougue/cortes';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1024';
			$config['max_width']  = '800';
			$config['max_height']  = '600';
			$config['encrypt_name'] = true;		
			$this->load->library('upload', $config);
			if($this->upload->do_upload())
			{
				$arquivo_upado = $this->upload->data();
				$dados['imagem_corte'] = $arquivo_upado['file_name'];
			}	
			
			$dados['titulo'] = $this->input->post('titulo');
			
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('cortes',$dados);
			redirect(base_url()."cortes");
		}
	}
	
	
	public function adicionar(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/acougue/cortes';
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
				$dados['titulo'] = $this->input->post('titulo');
				$arquivo_upado = $this->upload->data();
				$dados['imagem_corte'] = $arquivo_upado['file_name'];
				$this->db->insert('cortes',$dados);
				redirect(base_url()."cortes");
			}
		}
	}

	public function editar($corte = null){
		$this->db->where('id',$corte);
		$data['corte'] = $this->db->get('cortes')->result();
		
		$this->load->view('html_header');
		$this->load->view('menu');
                $this->load->view('acougue_menu');
		$this->load->view('editar_corte',$data);
		$this->load->view('html_footer');
	}
	
	public function excluir($id){
		$this->db->where('id',$id);
		$this->db->delete('cortes');
		redirect(base_url()."cortes");
	} 
}