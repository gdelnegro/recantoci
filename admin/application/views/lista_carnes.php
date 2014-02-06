<div id="content">
	<?php

		echo heading("Carnes Cadastradas " . img(base_url().'assets/imgs/novo.gif'),2,"class='divisor'");
		
		//Início da listagem de categorias...
		$array_carnes = array();
		foreach($acougue as $carne){
			$array_carnes[] = array(
				
				anchor(
					base_url() . "acougues/excluir/" . $carne->id,
					img('assets/imgs/xis.gif'),
					array('onclick'=>"return confirm('Confirma a excluão deste produto?');")
				),
							
				anchor(
					base_url() . "acougues/editar/".$carne->id,
					img('assets/imgs/gear.gif'),
					array('onclick'=>"return confirm('Confirma a alteração deste produto?');")
				),
				
				$carne->titulo,
			);
		}
		
		$this->table->set_heading('Excluir','Editar','Nome da carne');
		echo "<div class='wraper_table'>";
			echo $this->table->generate($array_carnes);
		echo "</div>"; 
	?>
</div>