<div id="content">
	<?php
		echo heading("Cadastrar cortes " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
		echo form_open_multipart('cortes/adicionar', $attributes);		
			
			echo "<span class='validacoes'>" . validation_errors() . "</span>";
			
			echo form_fieldset("Cortes");
				
				echo form_label("Titulo","titulo");
				$atributos = array(
					"name"	=>	"titulo",
					"id"	=>	"titulo",
					"value"	=>	set_value('titulo')
				);
				echo form_input($atributos);
				
				echo form_label("Imagem do corte","userfile");
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
		
		echo heading("Cortes Cadastrados " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		//Início da listagem de cortes...
		$array_cortes = array();
		foreach($cortes as $corte){
			$array_cortes[] = array(
				
				anchor(
					base_url() . "cortes/excluir/" . $corte->id,
					img('assets/imgs/xis.gif'),
					array('onclick'=>"return confirm('Confirma a excluão deste corte?');")
				),
							
				anchor(
					base_url() . "cortes/editar/".$corte->id,
					img('assets/imgs/gear.gif'),
					array('onclick'=>"return confirm('Confirma a alteração deste corte?');")
				),
				
				$corte->titulo,
			);
		}
		
		$this->table->set_heading('Excluir','Editar','Nome do Corte');
		echo "<div class='wraper_table'>";
			echo $this->table->generate($array_cortes);
		echo "</div>"; 
	?>
</div>