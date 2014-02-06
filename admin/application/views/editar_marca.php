<div id="content">
	<?php
		echo heading("Alterar marca " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
		echo form_open_multipart('marcas/salvar_alteracao', $attributes);
			
			echo "<span class='validacoes'>" . validation_errors() . "</span>";
			
			echo form_fieldset("Marcas");
				
				echo form_hidden("id",$marca[0]->id);
				
				echo form_label("Título","titulo");
				$atributos = array(
					"name"	=>	"titulo",
					"id"	=>	"titulo",
					"value"	=>	$marca[0]->titulo
				);
				echo form_input($atributos);
				
				echo form_label("Slug","slug");
				$atributos = array(
					"name"	=>	"slug_marca",
					"id"	=>	"slug_marca",
					"value"	=>	$marca[0]->slug_marca
				);
				echo form_input($atributos);

				echo form_label("Logomarca","userfile");
				echo "<br/>";
				$url = $_SERVER['HTTP_HOST'];
				echo '<img src=/imagens/marcas/'.$marca[0]->imagem_marca.' width="50%">';
				echo "<br/>";
				echo "<br/>";
				echo form_label("Trocar a logomarca","userfile");
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