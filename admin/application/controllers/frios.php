<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Frios extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
			redirect(base_url()."home");
		}
	}
	
	public function index(){
		$this->load->library('table');
		$data['marcas'] = $this->db->get('marcas')->result();
		$data['frios'] = $this->db->get('frios')->result();
		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('frios',$data);
		$this->load->view('html_footer');
	}
	
	public function adicionar(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		$this->form_validation->set_rules('preco', 'Preço', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			#$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/frios/frios';
                        $diretorio = getcwd();
                        $config['upload_path'] = $diretorio.'/../imagens/frios/frios';
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
				$dados['preco'] = $this->input->post('preco');
				$dados['marca'] = $this->input->post('marca');
                                $dados['apresentacao'] = $this->input->post('apresentacao');

				$arquivo_upado = $this->upload->data();
				$dados['imagem_produto'] = $arquivo_upado['file_name'];
                                if ($dados["apresentacao"] === 'sim'){
                                    $dados["apresentacao"] = "sim";
                                }
                                else {
                                    $dados["apresentacao"] = "nao";
                                }
                                
				$this->db->insert('frios',$dados);
				redirect(base_url()."frios");
			}
		}
	}

	public function salvar_alteracao(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titulo', 'Título', 'required');
		$this->form_validation->set_rules('preco', 'Preço', 'required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			#$config['upload_path'] = '/home/bestwebf/www/recanto/imagens/frios/frios';
                        $diretorio = getcwd();
                        $config['upload_path'] = $diretorio.'/../imagens/frios/frios';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1024';
			$config['max_width']  = '800';
			$config['max_height']  = '600';
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if($this->upload->do_upload())
			{
				$arquivo_upado = $this->upload->data();
				$dados['imagem_produto'] = $arquivo_upado['file_name'];
			}
			
			$dados['titulo'] = $this->input->post('titulo');
			$dados['preco'] = $this->input->post('preco');
			$dados['marca'] = $this->input->post('marca');
                        $dados['apresentacao'] = $this->input->post('apresentacao');
                        
                        if ($dados["apresentacao"] == TRUE) : 
                            $dados["apresentacao"] = "sim";
                        else : $dados["apresentacao"] = "nao";

                        endif;

                        $this->db->where('id',$this->input->post('id'));
			$this->db->update('frios',$dados);
			redirect(base_url()."frios");
		}
	}

	public function editar($frio = null){
		$data['marcas'] = $this->db->get('marcas')->result();

		$this->db->where('id',$frio);
		$data['frio'] = $this->db->get('frios')->result();

		$this->load->view('html_header');
		$this->load->view('menu');
		$this->load->view('editar_frio',$data);
		$this->load->view('html_footer');
	}
	
	public function excluir($id){
		$this->db->where('id',$id);
		$this->db->delete('frios');
		redirect(base_url()."frios");
	} 
}