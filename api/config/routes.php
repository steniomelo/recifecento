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
            
        // add_rewrite_rule(
        //     'estabelecimentos/([^/]*)/?$',
        //     'index.php?pagename=estabelecimento&estabelecimento_id=$matches[1]',
        //     'top' );

        // ROTAS
        define('ROTA_IMOVELDETALHE', BASE.'/estabelecimentos/imovel/'); 
        define('ROTA_IMOVEIS', BASE.'/imoveis'); 
            
    }

?>