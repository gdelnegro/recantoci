<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Acougue_modo_preparos extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
			redirect(base_url()."home");
		}
	}
	
	public function index(){
		$this->load->library('table');
                $data['cortes'] = $this->db->select_max('cortes')->result();
                $str = $this->db->last_query();
                echo $str;
		$data['acougue_modo_preparo'] = $this->db->get('acougue_modo_preparo')->result();
		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('acougue_menu');
		$this->load->view('acougue_modo_preparos',$data);
		$this->load->view('html_footer');
	}
	
	public function adicionar(){
				$dados['titulo'] = $this->input->post('titulo');
				$dados['descricao'] = $this->input->post('descricao');
				$dados['observacao'] = $this->input->post('observacao');
				$dados['preco'] = $this->input->post('preco');
                                $dados['apresentacao'] = $this->input->post('apresentacao');
                                $dados['corte'] = $this->input->post('corte');
                                
                                
				$this->db->insert('acougue_modo_prepraro',$dados);
				redirect(base_url()."acougues");
        }

	public function salvar_alteracao(){
		$this->load->library('form_validation');
                $this->form_validation->set_rules('corte', 'Corte', 'required');
		$this->form_validation->set_rules('titulo', 'Título', 'required');
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		$this->form_validation->set_rules('observacao', 'Observação', 'required');
		$this->form_validation->set_rules('preco', 'Preço', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$diretorio = getcwd();
                        $config['upload_path'] = $diretorio.'/../imagens/preparo';
                        #$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/acougue/carnes';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1024';
			$config['max_width']  = '800';
			$config['max_height']  = '600';
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if($this->upload->do_upload())
			{
				$arquivo_upado = $this->upload->data();
				$dados['imagem_carne'] = $arquivo_upado['file_name'];
			}
			
			$dados['titulo'] = $this->input->post('titulo');
			$dados['descricao'] = $this->input->post('descricao');
			$dados['observacao'] = $this->input->post('observacao');
			$dados['preco'] = $this->input->post('preco');
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
			$this->db->update('acougue',$dados);
			redirect(base_url()."acougues");
		}
	}

	public function editar($acougue = null){
                $data['cortes'] = $this->db->get('cortes')->result();
                
		$this->db->where('id',$acougue);
		$data['acougue'] = $this->db->get('acougue')->result();

		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('acougue_menu');
		$this->load->view('editar_acougue',$data);
		$this->load->view('html_footer');
	}
	
	public function excluir($id){
		$this->db->where('id',$id);
		$this->db->delete('acougue');
		redirect(base_url()."acougues");
	}	
}