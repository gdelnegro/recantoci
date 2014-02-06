<div id="content">
	<?php
		echo heading("Cadastrar modo de preparos " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
		echo form_open_multipart('modo_preparo/adicionar', $attributes);		
			
			echo "<span class='validacoes'>" . validation_errors() . "</span>";
			
			echo form_fieldset("Modo de Preparo");
				
				echo form_label("Titulo","titulo");
				$atributos = array(
					"name"	=>	"modo_preparo",
					"id"	=>	"modo_preparo",
					"value"	=>	set_value('titulo')
				);
				echo form_input($atributos);
				
				echo form_label("Imagem do modo de preparo","userfile");
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
		
		echo heading("Modo de preparos Cadastrados " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		//Início da listagem de cortes...
		$array_modo_preparo = array();
		foreach($modo_preparo as $mp){
			$array_modo_preparo[] = array(
				
				anchor(
					base_url() . "modo_preparo/excluir/" . $mp->id,
					img('assets/imgs/xis.gif'),
					array('onclick'=>"return confirm('Confirma a excluão deste modo de preparo?');")
				),
							
				anchor(
					base_url() . "modo_preparo/editar/".$mp->id,
					img('assets/imgs/gear.gif'),
					array('onclick'=>"return confirm('Confirma a alteração deste modo de preparo?');")
				),
				
				$mp->modo_preparo,
			);
		}
		
		$this->table->set_heading('Excluir','Editar','Nome do Corte');
		echo "<div class='wraper_table'>";
			echo $this->table->generate($array_modo_preparo);
		echo "</div>"; 
	?>
</div>