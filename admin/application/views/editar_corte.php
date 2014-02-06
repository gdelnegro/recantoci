<div id="content">
	<?php
		echo heading("Alterar carne " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
		echo form_open_multipart('cortes/salvar_alteracao', $attributes);
			
			echo "<span class='validacoes'>" . validation_errors() . "</span>";
			
			echo form_fieldset("Cortes");
				
				echo form_hidden("id",$corte[0]->id);
				
				echo form_label("Título","titulo");
				$atributos = array(
					"name"	=>	"titulo",
					"id"	=>	"titulo",
					"value"	=>	$corte[0]->titulo
				);
				echo form_input($atributos);
				
				echo form_label("Imagem do Corte","userfile");
				echo "<br/>";
				$url = $_SERVER['HTTP_HOST'];
				echo '<img src=/imagens/acougue/cortes/'.$corte[0]->imagem_corte.' width="50%">';
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