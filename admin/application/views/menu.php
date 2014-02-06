<div id="top">
	<span class='saudacao'>
		Seja bem vindo: 
		<?php
		echo $this->session->userdata('usuario');
		echo " | ";
		echo anchor(base_url(). 'home/logout', 'Sair', 'title="Efetuar Logout"');
		?>
	</span>
	<div id="menu">
		<?php
			$menu[] = anchor(base_url(). 'entrada', 'Home', 'title="Voltar para a Home"');
			$menu[] = anchor(base_url(). 'marcas', 'Marcas', 'title="Administrar Marcas"');
			$menu[] = anchor(base_url(). 'categorias', 'Categorias', 'title="Administrar Categorias"');
			$menu[] = anchor(base_url(). 'receitas', 'Receitas', 'title="Administrar Receitas"');
			$menu[] = anchor(base_url(). 'frios', 'Frios', 'title="Administrar Frios"');
			$menu[] = anchor(base_url(). 'acougues', 'Açougue', 'title="Administrar Açougue"');
			
			echo ul($menu);
		?>
	</div>
</div>