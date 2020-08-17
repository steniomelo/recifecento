<?php 
		add_query_arg( 'category_name', 'comercio' );

set_query_var('category_name', 'comercio');
locate_template( 'archive.php', TRUE, TRUE );
?>