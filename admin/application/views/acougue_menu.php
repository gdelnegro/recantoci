<div id="sub-menu">
	<?php
		$menu[] = anchor(base_url(). 'acougues/form_carnes', 'Carnes', 'title="Administrar Açougue"');
		$menu[] = anchor(base_url(). 'cortes', 'Cortes', 'title="Administrar Cortes"');
		$menu[] = anchor(base_url(). 'modo_preparo', 'Modo Preparo', 'title="Administrar Modo Preparo"');

		echo ul($menu);
	?>
</div>