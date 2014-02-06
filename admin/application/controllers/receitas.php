<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Receitas extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
			redirect(base_url()."home");
		}
	}
	
	public function index(){
		$this->load->library('table');
		$data['categorias'] = $this->db->get('categorias')->result();
		$data['receitas'] = $this->db->get('receitas')->result();
		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('receitas',$data);
		$this->load->view('html_footer');
	}
	
	public function salvar_alteracao(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('categoria', 'Categoria', 'required');
		$this->form_validation->set_rules('titulo', 'Título', 'required');
		$this->form_validation->set_rules('slug_receita', 'Slug', 'required');
		$this->form_validation->set_rules('ingredientes1', 'Ingredientes1', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/receitas';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1024';
			$config['max_width']  = '800';
			$config['max_height']  = '600';
			$config['encrypt_name'] = true;		
			$this->load->library('upload', $config);
			if($this->upload->do_upload())
			{
				$arquivo_upado = $this->upload->data();
				$dados['imagem_receita'] = $arquivo_upado['file_name'];
			}	
			
			$dados['titulo'] = $this->input->post('titulo');
			$dados['slug_receita'] = $this->input->post('slug_receita');
			$dados['ingredientes1'] = $this->input->post('ingredientes1');
			$dados['apresentacao'] = $this->input->post('apresentacao');
			$dados['categoria'] = $this->input->post('categoria');
			
                        
                        $apresentacao = $dados["apresentacao"];
                        
                        if ($dados["apresentacao"] === 'sim'){
                            $dados["apresentacao"] = "sim";
                        }
                        else {
                            $dados["apresentacao"] = "nao";
                        }
                       
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('receitas',$dados);
			redirect(base_url()."receitas");
		}
	}
	
	
	public function adicionar(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('categoria', 'Categoria', 'required');
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('slug_receita', 'Slug', 'required');
		$this->form_validation->set_rules('ingredientes1', 'Ingredientes1', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/receitas';
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
				$dados['slug_receita'] = $this->input->post('slug_receita');
				$dados['ingredientes1'] = $this->input->post('ingredientes1');
                                $dados['apresentacao'] = $this->input->post('apresentacao');
                                $dados['categoria'] = $this->input->post('categoria');
				$arquivo_upado = $this->upload->data();
				$dados['imagem_receita'] = $arquivo_upado['file_name'];
                                
                                if ($dados["apresentacao"] === 'sim'){
                                    $dados["apresentacao"] = "sim";
                                }
                                else {
                                    $dados["apresentacao"] = "nao";
                                }
                                
                                $this->db->insert('receitas',$dados);
                                
				redirect(base_url()."receitas");
			}
		}
	}

	public function editar($receita = null){
		$data['categorias'] = $this->db->get('categorias')->result();
		
		$this->db->where('id',$receita);
		$data['receita'] = $this->db->get('receitas')->result();
		
		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('editar_receita',$data);
		$this->load->view('html_footer');
	}
	
	public function excluir($id){
		$this->db->where('id',$id);
		$this->db->delete('receitas');
		redirect(base_url()."receitas");
	} 
}