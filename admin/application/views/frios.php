<div id="content">
	<?php
		echo heading("Cadastrar frios " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
		echo form_open_multipart('frios/adicionar', $attributes);		
			
			echo "<span class='validacoes'>" . validation_errors() . "</span>";
			
			echo form_fieldset("Frios");
				
				echo form_label("Titulo","titulo");
				$atributos = array(
					"name"	=>	"titulo",
					"id"	=>	"titulo",
					"value"	=>	set_value('titulo')
				);
				echo form_input($atributos);
				
				echo form_label("Preco","preco");
				$atributos = array(
					"name"	=>	"preco",
					"id"	=>	"preco",
					"value"	=>	set_value('preco')
				);
				echo form_input($atributos);
				
				echo form_label("Marca","marca");				
				foreach($marcas as $marca){
					$array[$marca->id] = $marca->titulo;
				}				
				echo form_dropdown('marca', $array);
				
				echo form_label("Mostrar Produto?","apresentacao")."<br/>";
				$atributos = array(
                                    'name'        => 'apresentacao',
                                    'id'          => 'apresentacao',
                                    'value'       => 'sim',
                                    'checked'     => TRUE,
                                    'style'       => 'margin:10px',
                                    
				);
                                echo form_checkbox($atributos) . "sim" ;
                                
                                echo "<br/>";
                                
				echo form_label("Imagem do produto","userfile");
				echo "<br/>";
				$atributos = array(
					"name"	=>	"userfile",
					"id"	=>	"userfile"
				);
				echo form_upload($atributos);
				echo "<br/>";
				
				echo form_submit("btnSubmit","Adicionar");
			echo form_fieldset_close();
		echo form_close();
		//Fim do formulário...
		
		echo heading("Produtos Cadastrados " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		//Início da listagem de categorias...
		$array_frios = array();
		foreach($frios as $frio){
			$array_frios[] = array(
				
				anchor(
					base_url() . "frios/excluir/" . $frio->id,
					img('assets/imgs/xis.gif'),
					array('onclick'=>"return confirm('Confirma a excluão deste produto?');")
				),
							
				anchor(
					base_url() . "frios/editar/".$frio->id,
					img('assets/imgs/gear.gif'),
					array('onclick'=>"return confirm('Confirma a alteração deste produto?');")
				),
				
				$frio->titulo,
			);
		}
		
		$this->table->set_heading('Excluir','Editar','Nome do Produto');
		echo "<div class='wraper_table'>";
			echo $this->table->generate($array_frios);
		echo "</div>"; 
	?>
</div>