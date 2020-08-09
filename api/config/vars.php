<?php 

add_filter( 'query_vars', 'query_vars_personalizadas' );

function query_vars_personalizadas( $query_vars ){
    $query_vars[] = 'imoveis_cat';
    $query_vars[] = 'imovel_id';
    return $query_vars;
}

?>