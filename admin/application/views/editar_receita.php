<div id="content">
	<?php
		echo heading("Alterar receita " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
		echo form_open_multipart('receitas/salvar_alteracao', $attributes);		
			
			echo "<span class='validacoes'>" . validation_errors() . "</span>";
			
			echo form_fieldset("Receitas");
				
				echo form_hidden("id",$receita[0]->id);
				
				echo form_label("Categoria","categoria");				
				foreach($categorias as $categoria){
					$array[$categoria->id_categoria] = $categoria->categoria;
				}				
				echo form_dropdown('categoria', $array, $receita[0]->categoria);
				
				echo form_label("Título","titulo");
				$atributos = array(
					"name"	=>	"titulo",
					"id"	=>	"titulo",
					"value"	=>	$receita[0]->titulo
				);
				echo form_input($atributos);
				
				echo form_label("Slug","slug_receita");
				$atributos = array(
					"name"	=>	"slug_receita",
					"id"	=>	"slug_receita",
					"value"	=>	$receita[0]->slug_receita
				);
				echo form_input($atributos);
				
				echo form_label("Ingredientes 1","ingredientes1");
				$atributos = array(
					"name"	=>	"ingredientes1",
					"id"	=>	"ingredientes1",
					"value"	=>	$receita[0]->ingredientes1
				);
				echo form_textarea($atributos);
				
                                $apresentacao = $receita[0]->apresentacao;
                                
                                echo form_label("Mostrar Receita?","apresentacao")."<br/>";
                                
                                if ($apresentacao === 'sim'){
                                    $atributos = array(
                                        'name'        => 'apresentacao',
                                        'id'          => 'apresentacao',
                                        'value'       => 'sim',
                                        'checked'     => TRUE,
                                        'style'       => 'margin:10px',

                                    );
                                }
                                else{
                                    $atributos = array(
                                        'name'        => 'apresentacao',
                                        'id'          => 'apresentacao',
                                        'value'       => 'sim',
                                        'checked'     => FALSE,
                                        'style'       => 'margin:10px',

                                    );
                                }
                                echo form_checkbox($atributos) . "sim" ;
                                
                                echo "<br/>";
                                
				echo form_label("Imagem da Receita","userfile");
				echo "<br/>";
				$url = $_SERVER['HTTP_HOST'];
				echo '<img src=/imagens/receitas/'.$receita[0]->imagem_receita.' width="50%">';
				echo "<br/>";
				echo "<br/>";
				echo form_label("Trocar a imagem da receita","userfile");
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