<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Acougues extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
			redirect(base_url()."home");
		}
	}
	
	public function index(){
		$this->load->library('table');
		$data['cortes'] = $this->db->get('cortes')->result();
		$data['acougue'] = $this->db->get('acougue')->result();
		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('acougue_menu');
		$this->load->view('lista_carnes',$data);
		$this->load->view('html_footer');
	}

	public function form_carnes(){
		$this->load->library('table');
                $data['cortes'] = $this->db->get('cortes')->result();
                $data['modo_preparo'] = $this->db->get('modo_preparo')->result();
		$data['acougue'] = $this->db->get('acougue')->result();
		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('acougue_menu');
		$this->load->view('acougues',$data);
		$this->load->view('html_footer');
	}
	
	public function adicionar(){
		$this->load->library('form_validation');
                $this->form_validation->set_rules('corte', 'Corte', 'required');
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('descricao', 'Descrição', 'required');
		$this->form_validation->set_rules('observacao', 'Observação', 'required');
		$this->form_validation->set_rules('preco', 'Preço', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/acougue/carnes';
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
				$dados['descricao'] = $this->input->post('descricao');
				$dados['observacao'] = $this->input->post('observacao');
				$dados['preco'] = $this->input->post('preco');
                                $dados['apresentacao'] = $this->input->post('apresentacao');
                                $dados['corte'] = $this->input->post('corte');
                                
				$arquivo_upado = $this->upload->data();
				$dados['imagem_carne'] = $arquivo_upado['file_name'];

                                if ($dados["apresentacao"] === 'sim'){
                                    $dados["apresentacao"] = "sim";
                                }
                                else {
                                    $dados["apresentacao"] = "nao";
                                }
                                
                                $this->db->insert('acougue',$dados);
                                
                                $this->db->start_cache();
                                $idAtual = $this->db->get_where('acougue', array('titulo'=>$dados['titulo']))->result();
                                $this->db->stop_cache();
                                
                                $idAtual = $idAtual[0]->id;
                                
                                $dados1 = $this->input->post('modo_preparo');
                                
                                if (isset($dados1[0])) {
                                $dados_modo_preparo[] = array (
                                    'id_acougue' => $idAtual,
                                    'id_modo_preparo' => $dados1[0],
                                );
                                
                                $this->db->insert_batch('acougue_modo_preparo',$dados_modo_preparo);
                                }
                                if (isset($dados1[1])) {
                                $dados_modo_preparo[] = array (
                                    'id_acougue' => $idAtual,
                                    'id_modo_preparo' => $dados1[1],
                                );
                                
                                $this->db->insert_batch('acougue_modo_preparo',$dados_modo_preparo);
                                }
                                if (isset($dados1[2])) {
                                $dados_modo_preparo[] = array (
                                    'id_acougue' => $idAtual,
                                    'id_modo_preparo' => $dados1[2],
                                );
                                
                                $this->db->insert_batch('acougue_modo_preparo',$dados_modo_preparo);
                                }
                                if (isset($dados1[3])) {
                                $dados_modo_preparo[] = array (
                                    'id_acougue' => $idAtual,
                                    'id_modo_preparo' => $dados1[3],
                                );
                                
                                $this->db->insert_batch('acougue_modo_preparo',$dados_modo_preparo);
                                }
                                
				redirect(base_url()."acougues");
			}
		}
	}

	public function editar($acougue = null){
                $data['cortes'] = $this->db->get('cortes')->result();
                $data['modo_preparo'] = $this->db->get('modo_preparo')->result();
		$this->db->where('id',$acougue);
		$data['acougue'] = $this->db->get('acougue')->result();

                        $this->db->start_cache();
                        $idAtual = $this->db->get_where('acougue_modo_preparo', array('id_acougue'=>$acougue))->result();
                        $this->db->stop_cache();
                        
                        $query = $this->db->last_query();
                        
                        //echo $query;                
                
		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('acougue_menu');
		$this->load->view('editar_acougue',$data);
		$this->load->view('html_footer');
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
			$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/acougue/carnes';
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
        
        
	public function excluir($id){
		$this->db->where('id',$id);
		$this->db->delete('acougue');
		redirect(base_url()."acougues");
	}	
}