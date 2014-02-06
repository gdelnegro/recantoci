<div id="content">
	<?php
		echo heading("Cadastrar marca " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
		echo form_open_multipart('marcas/adicionar', $attributes);		
			
			echo "<span class='validacoes'>" . validation_errors() . "</span>";
			
			echo form_fieldset("Marcas");
				
				echo form_label("Titulo","titulo");
				$atributos = array(
					"name"	=>	"titulo",
					"id"	=>	"titulo",
					"value"	=>	set_value('titulo')
				);
				echo form_input($atributos);
				
				echo form_label("Slug","slug_marca");
				$atributos = array(
					"name"	=>	"slug_marca",
					"id"	=>	"slug_marca",
					"value"	=>	set_value('slug_marca')
				);
				echo form_input($atributos);
				
				
				echo form_label("Logo marca","userfile");
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
		
		echo heading("Marcas Cadastradas " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		//Início da listagem de categorias...
		$array_marcas = array();
		foreach($marcas as $marca){
			$array_marcas[] = array(
				
				anchor(
					base_url() . "marcas/excluir/" . $marca->id,
					img('assets/imgs/xis.gif'),
					array('onclick'=>"return confirm('Confirma a excluão desta marca?');")
				),
							
				anchor(
					base_url() . "marcas/editar/".$marca->id,
					img('assets/imgs/gear.gif'),
					array('onclick'=>"return confirm('Confirma a alteração desta marca?');")
				),
				
				$marca->titulo,
			);
		}
		
		$this->table->set_heading('Excluir','Editar','Nome da Marca');
		echo "<div class='wraper_table'>";
			echo $this->table->generate($array_marcas);
		echo "</div>"; 
	?>
</div>