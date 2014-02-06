<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Marcas extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
			redirect(base_url()."home");
		}
	}
	
	public function index(){
		$this->load->library('table');
		$data['marcas'] = $this->db->get('marcas')->result();
		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('marcas',$data);
		$this->load->view('html_footer');
	}
	
	public function salvar_alteracao(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titulo', 'Título', 'required');
		$this->form_validation->set_rules('slug_marca', 'Slug', 'required');

		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{       
                        $diretorio = getcwd();
                        $config['upload_path'] = $diretorio.'/../imagens/marcas';
			#$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/marcas';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1024';
			$config['max_width']  = '800';
			$config['max_height']  = '600';
			$config['encrypt_name'] = true;		
			$this->load->library('upload', $config);
			if($this->upload->do_upload())
			{
				$arquivo_upado = $this->upload->data();
				$dados['imagem_marca'] = $arquivo_upado['file_name'];
			}	
			
			$dados['titulo'] = $this->input->post('titulo');
			$dados['slug_marca'] = $this->input->post('slug_marca');
			
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('marcas',$dados);
			redirect(base_url()."marcas");
		}
	}
	
	
	public function adicionar(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('slug_marca', 'Slug', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
                    
                        $diretorio = getcwd();
                        $config['upload_path'] = $diretorio.'/../imagens/marcas';
			#$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/marcas';
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
				$dados['slug_marca'] = $this->input->post('slug_marca');
				
				$arquivo_upado = $this->upload->data();
				$dados['imagem_marca'] = $arquivo_upado['file_name'];
				$this->db->insert('marcas',$dados);
				redirect(base_url()."marcas");
			}
		}
	}

	public function editar($receita = null){
		$this->db->where('id',$receita);
		$data['marca'] = $this->db->get('marcas')->result();
		
		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('editar_marca',$data);
		$this->load->view('html_footer');
	}
	
	public function excluir($id){
		$this->db->where('id',$id);
		$this->db->delete('marcas');
		redirect(base_url()."marcas");
	} 
}