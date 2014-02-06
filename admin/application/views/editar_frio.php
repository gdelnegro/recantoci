<div id="content">
	<?php
		echo heading("Alterar frio " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
		echo form_open_multipart('frios/salvar_alteracao', $attributes);
			
			echo "<span class='validacoes'>" . validation_errors() . "</span>";
			
			echo form_fieldset("Frios");
				
				echo form_hidden("id",$frio[0]->id);
				
				echo form_label("Título","titulo");
				$atributos = array(
					"name"	=>	"titulo",
					"id"	=>	"titulo",
					"value"	=>	$frio[0]->titulo
				);
				echo form_input($atributos);
				
				echo form_label("Preço","preco");
				$atributos = array(
					"name"	=>	"preco",
					"id"	=>	"preco",
					"value"	=>	$frio[0]->preco
				);
				echo form_input($atributos);
				
				echo form_label("Marca","marca");				
				foreach($marcas as $marca){
					$array[$marca->id] = $marca->titulo;
				}				
				echo form_dropdown('marca', $array, $frio[0]->marca);

                                $apresentacao = $frio[0]->apresentacao;
                                
                                if ($apresentacao == 'sim') : 
                                    $apresentacao == TRUE;
                                else : $apresentacao == FALSE;
                                
                                endif;
                                
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
                                
                                echo "<br/>";
                                

				echo form_label("Imagem do Produto","userfile");
				echo "<br/>";
				$url = $_SERVER['HTTP_HOST'];
				echo '<img src="/imagens/frios/frios/'.$frio[0]->imagem_produto.'" width="50%">';
				echo "<br/>";
				echo "<br/>";
				echo form_label("Trocar a imagem do produto","userfile");
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