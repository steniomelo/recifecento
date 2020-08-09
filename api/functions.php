<?php 
require_once('config.php');

function formatarEndereco($imovel) {
	return $imovel->endereco.', '.$imovel->numero.' - '.$imovel->nomeBairro.' - '.$imovel->nomeCidade.' - '.$imovel->siglaEstado;
}

function formatarArea($imovel) {
	return $imovel->areautil.' '.$imovel->unidade2;
}

function existeArea($imovel) {
	if($imovel->areautil) :
		$return = '<div class="info info-tamanho">
			<img src="'.ASSETS.'/img/icons/tamanho.svg">
			<small>'.formatarArea($imovel).'</small>
		</div>';
	endif;
	return $return;
}

function formatarQuartos($imovel) {
	return $imovel->nquartos > 1 ? $imovel->nquartos.' '.$GLOBALS['campos']['config']['geral']['quartos'] : $imovel->nquartos.' '.$GLOBALS['campos']['config']['geral']['quarto'];
}

function formatarBanheiros($imovel) {
	return $imovel->nbanheirossociais > 1 ? $imovel->nbanheirossociais.' '.$GLOBALS['campos']['config']['geral']['banheiros'] : $imovel->nbanheirossociais.' '.$GLOBALS['campos']['config']['geral']['banheiro'];
}

function formatarVagas($imovel) {
	return $imovel->ngaragens > 1 ? $imovel->ngaragens.' '.$GLOBALS['campos']['config']['geral']['vagas'] : $imovel->ngaragens.' '.$GLOBALS['campos']['config']['geral']['vaga'];
}

function formatarElevadores($imovel) {
	return $imovel->nelevadores > 1 ? $imovel->nelevadores.' '.$GLOBALS['campos']['config']['geral']['elevadores'] : $imovel->nelevadores.' '.$GLOBALS['campos']['config']['geral']['elevadores'];
}

add_action ('wp_ajax_nopriv_get_estabelecimentos', 'get_estabelecimentos');
add_action ('wp_ajax_get_estabelecimentos', 'get_estabelecimentos');

function get_estabelecimentos() {

	$query = json_decode(stripslashes($_POST['query']), true);
	$query_array = array();
	$query_vars = json_decode(stripslashes($_POST['query_vars']), true);
	$get = $_POST['get'];
	$post = $_POST['post'];
	$filters = $_POST['filters'];
	$page = $_POST['page'];
	$qtdImoveis = 4;

	// $produto = [
	// 			'key' => 'produtos',
	// 			'value' => 258,
	// 			'compare' => 'LIKE',
	// 		];

	// 		array_push($query_array, $produto); // Busca por produto

	//var_dump($query); die();

	$items = new WP_Query(array(
		// 's' => 'L.', //Busca por termo keyword
		'post_type' => 'estabelecimentos',
		'post_status' => 'publish',
		'posts_per_page' => $qtdImoveis,
		'category_name' => $query_vars['category_name'],
		'paged' => $page,
		'meta_query' => $query_array,
	));

	$totalItems = $items->found_posts;
	$itemsFiltrados = $items->posts;

	header('Content-type: application/json');

	$html = array();
	$itemFilters = array();

	$i = 0;

	foreach($itemsFiltrados as $imovel) {

		$endereco = get_field('endereco', $imovel->ID);

		$imovel->lat = $endereco['lat'];
		$imovel->lng = $endereco['lng'];
		$imovel->address = $endereco;
		$imovel->horario = get_field('horario_de_funcionamento', $imovel->ID);

			array_push($html, '<div class="col-sm-6">
				<div class="list-item imovel-card ">
					<a href="'. get_post_permalink($imovel->ID) .'">
					<div class="imovel-container">
						<div class="imovel-content">
							

							<div class="imovel-details">
								<header class="imovel-title">
									<h3 class="imovel-nome">'.$imovel->post_title.'</h3>
									<i class="arrow-hover gray"></i>	

								</header>
								

								<div class="imovel-description">'. $imovel->address['address'] .'</div>

								<div class="imovel-price">
									<small>A partir de</small>
									<strong class="price">
										<small class="price-cifrao">R$</small>
									</strong>
								</div>
							</div>
						</div>


					</div>
					</a>
					
				</div>
			</div>');

			$i += 1;
		}

	$return = array('html' => $html, 'imoveis' => $itemsFiltrados, 'total' => $totalItems);
	echo json_encode($return);
	
	die();

	header('HTTP/1.1 500 '. $response->mensagem);
	header('Content-Type: application/json; charset=utf-8');
	die($response->mensagem);
}


?>