<div id="content">
	<?php
		echo heading("Definir modo de preparos " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		$attributes = array('class' => 'acougue_modo_preparos', 'id' => 'acougue_modo_preparos');
		echo form_open_multipart('acougue_modo_preparos/adicionar', $attributes);		
						
			echo form_fieldset("Defina o modo de preparo");
				

                                echo form_label("Corte","corte");				
				foreach($cortes as $corte){
					$array[$corte->id] = $corte->titulo;
				}				
				echo form_dropdown('corte', $array);
                                
                                echo form_label("Titulo","titulo");
				$atributos = array(
					"name"	=>	"titulo",
					"id"	=>	"titulo",
					"value"	=>	set_value('titulo')
				);
				echo form_input($atributos);

				echo form_label("Descricao","descricao");
				$atributos = array(
					"name"	=>	"descricao",
					"id"	=>	"descricao",
					"value"	=>	set_value('descricao')
				);
				echo form_textarea($atributos);

				echo form_label("Observação","observacao");
				$atributos = array(
					"name"	=>	"observacao",
					"id"	=>	"observacao",
					"value"	=>	set_value('observacao')
				);
				echo form_textarea($atributos);

				
				echo form_label("Preco","preco");
				$atributos = array(
					"name"	=>	"preco",
					"id"	=>	"preco",
					"value"	=>	set_value('preco')
				);
				echo form_input($atributos);

				echo form_label("Modo preparo","modo_preparo");
                                echo "<br/>";
				foreach($modo_preparo as $mp){
                                    $atributos = array(
                                      "name" => "modo_preparo[]",
                                      "id" => $mp->id,
                                      "value" => $mp->modo_preparo,
                                    );
                                    echo form_checkbox($atributos);
                                    echo $mp->modo_preparo;                                   
				}
                                
                                echo "<br />";
                                
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
                                
                                echo form_label("Imagem da carne","userfile");
				echo "<br/>";
				$atributos = array(
					"name"	=>	"userfile",
					"id"	=>	"userfile"
				);
				echo form_upload($atributos);
				echo "<br/>";
				
				echo form_submit("btnSubmit","Cadastrar");
			echo form_fieldset_close();
		echo form_close();
		//Fim do formulário...
		?>
</div>