<?php 

    add_action( 'init', 'rotas' );

    function rotas(){
        
        // add_rewrite_rule(
        //     'servicos', // ([^/]*) -> Qualquer caracter | ([0-9]+) -> Somente números
        //     'index.php',
        //     'top' );
        // add_rewrite_rule(
        //     '/servicos', // ([^/]*) -> Qualquer caracter | ([0-9]+) -> Somente números
        //     'index.php?category=$matches[1]',
        //     'top' );
            
        add_rewrite_rule(
            'imoveis/imovel/([^/]*)/?$',
            'index.php?pagename=imovel&imovel_id=$matches[1]',
            'top' );

        // ROTAS
        define('ROTA_IMOVELDETALHE', BASE.'/imoveis/imovel/'); 
        define('ROTA_IMOVEIS', BASE.'/imoveis'); 
            
    }

?>