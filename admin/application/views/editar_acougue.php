<div id="content">
	<?php
		echo heading("Alterar carne " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
		echo form_open_multipart('acougues/salvar_alteracao', $attributes);
			
			echo "<span class='validacoes'>" . validation_errors() . "</span>";
			
			echo form_fieldset("Carnes");
				
				echo form_hidden("id",$acougue[0]->id);
				
				echo form_label("Título","titulo");
				$atributos = array(
					"name"	=>	"titulo",
					"id"	=>	"titulo",
					"value"	=>	$acougue[0]->titulo
				);
				echo form_input($atributos);

                                echo form_label("Descrição","descricao");
				$atributos = array(
					"name"	=>	"descricao",
					"id"	=>	"descricao",
					"value"	=>	$acougue[0]->descricao
				);
				echo form_textarea($atributos);

                                echo form_label("Observação","observacao");
				$atributos = array(
					"name"	=>	"observacao",
					"id"	=>	"observacao",
					"value"	=>	$acougue[0]->observacao
				);
				echo form_textarea($atributos);
                               
				echo form_label("Preço","preco");
				$atributos = array(
					"name"	=>	"preco",
					"id"	=>	"preco",
					"value"	=>	$acougue[0]->preco
				);
				echo form_input($atributos);

				echo form_label("Corte","corte");				
				foreach($cortes as $corte){
					$array[$corte->id] = $corte->titulo;
				}				
				echo form_dropdown('corte', $array, $acougue[0]->corte);

				echo form_label("Modo preparo","modo_preparo");
                                echo "<br/>";
				foreach($modo_preparo as $mp){
                                    $atributos = array(
                                      "name" => "modo_preparo[]",
                                      "id" => $mp->id,
                                      "value" => $mp->id,
                                    );
                                    echo form_checkbox($atributos);
                                    echo $mp->modo_preparo;                                   
				}
                                
                                echo "<br />";
                                
                                $apresentacao = $acougue[0]->apresentacao;
                                
                                echo "<br />";
                                
                                echo form_label("Mostrar Produto?","apresentacao")."<br/>";
                                
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
                                
                                echo "<br />";
                                
				echo form_label("Imagem da Carne","userfile");
				echo "<br/>";
				$url = $_SERVER['HTTP_HOST'];
				echo '<img src=/imagens/acougue/carnes/'.$acougue[0]->imagem_carne.' width="50%">';
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