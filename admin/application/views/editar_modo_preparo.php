<div id="content">
	<?php
		echo heading("Alterar modo preparo" . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
		echo form_open_multipart('modo_preparo/salvar_alteracao', $attributes);
			
			echo "<span class='validacoes'>" . validation_errors() . "</span>";
			
			echo form_fieldset("Modo Preparo");
				
				echo form_hidden("id",$modo_preparo[0]->id);
				
				echo form_label("Modo de preparo","modo_preparo");
				$atributos = array(
					"name"	=>	"modo_preparo",
					"id"	=>	"modo_preparo",
					"value"	=>	$modo_preparo[0]->modo_preparo
				);
				echo form_input($atributos);
				
				echo form_label("Imagem do Modo de preparo","userfile");
				echo "<br/>";
				$url = $_SERVER['HTTP_HOST'];
				echo '<img src=/imagens/preparo/'.$modo_preparo[0]->imagem_modo_preparo.' width="50%">';
				echo "<br/>";
				echo "<br/>";
				echo form_label("Trocar a imagem da carne","userfile");
				echo "<br/>";
				$atributos = array(
					"name"	=>	"userfile",
					"id"	=>	"userfile"
				);
				echo form_upload($atributos);
				echo "<br/>";
				echo form_submit("btnSubmit","Alterar");
			echo form_fieldset_close();
		echo form_close();
	?>
</div>