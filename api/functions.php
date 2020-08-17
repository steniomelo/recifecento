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

function isAberto($horarios) {
	$map = array(
		'á' => 'a',
		'à' => 'a',
		'ã' => 'a',
		'â' => 'a',
		'é' => 'e',
		'ê' => 'e',
		'í' => 'i',
		'ó' => 'o',
		'ô' => 'o',
		'õ' => 'o',
		'ú' => 'u',
		'ü' => 'u',
		'ç' => 'c',
		'Á' => 'A',
		'À' => 'A',
		'Ã' => 'A',
		'Â' => 'A',
		'É' => 'E',
		'Ê' => 'E',
		'Í' => 'I',
		'Ó' => 'O',
		'Ô' => 'O',
		'Õ' => 'O',
		'Ú' => 'U',
		'Ü' => 'U',
		'Ç' => 'C'
	);
	$dayofweek = strftime('%A', strtotime('today'));
	$dayofweek = explode(" ", $dayofweek);  
	$dayofweek = strtolower(strtr($dayofweek[0], $map));

	return (in_array($dayofweek, $horarios['dias_da_semana']) && compareDates($horarios['horario_de_funcionamento']['abertura'], $horarios['horario_de_funcionamento']['fechamento'])) ? 'Aberto' : 'Fechado';
	//return date(strtotime($horarios['horario_de_funcionamento']['abertura']), time());
}

function compareDates($start, $end) {
	$now = date(time());
    $_start = date(strtotime($start), time());
    $_end = date(strtotime($end), time());

    if ($_start < $now && $_end > $now) {
      return true;
    } else {
      return false;
    }
}

function isRecomendado($recomendado) {
	return ($recomendado) ? "<span class='imovel-recomendado'>Recomendado</span>" : "";
}

function formatarHorarios($horarios) {
	if(!empty($horarios['dias_da_semana'])) {
		return $horarios['dias_da_semana'][0] .' - '. end($horarios['dias_da_semana']). ' • ' .  $horarios['horario_de_funcionamento']['abertura'] . ' - ' . $horarios['horario_de_funcionamento']['fechamento'] . 'h';
	}
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
	$qtdImoveis = 10;
	$categoria = '';

	if($filters['produto']) {
	$produto = [
				'key' => 'produtos',
				'value' => $filters['produto'],
				'compare' => 'LIKE',
			];

			array_push($query_array, $produto); // Busca por produto
	}

	//var_dump($query); die();
	
	
	if($query_vars['category_name'] && !$filters['subcategoria']) {
		//var_dump();
		$categoria = $query_vars['category_name'];
	} else if($filters['subcategoria']) {
		$categoria = $filters['subcategoria'];
	} else {
		$categoria = 'comercio';
	}

	$items = new WP_Query(array(
		's' => $filters['keyword'], //Busca por termo keyword
		'post_type' => 'estabelecimentos',
		'post_status' => 'publish',
		'posts_per_page' => $qtdImoveis,
		'category_name' => $categoria,
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
		$imovel->horarios = get_field('horario_de_funcionamento', $imovel->ID);
		$imovel->categoria = get_the_category($imovel->ID);
		$imovel->recomendado = get_field('recomendado', $imovel->ID);

			array_push($html, '<div class="col-sm-12">
				<div class="list-item imovel-card ">
					<a href="'. get_post_permalink($imovel->ID) .'">
					<div class="imovel-container">
						<div class="imovel-content d-flex">

							<div class="imovel-thumbnail">
								'. isRecomendado($imovel->recomendado) .'
								'.get_the_post_thumbnail($imovel->ID, array(183,177)).'
							</div>
							

							<div class="imovel-details">
								<header class="imovel-title d-flex">
									<div>	
										<h2 class="imovel-nome">'.$imovel->post_title.'</h2>
										<small class="imovel-categoria">'. $imovel->categoria[0]->name .'</small>
									</div>
									
									<div class="imovel-aberto ml-auto '. strtolower(isAberto($imovel->horarios)) .'">'. isAberto($imovel->horarios) .'</div>

								</header>
								

								<div class="imovel-description">
									<div>'.  formatarHorarios($imovel->horarios) .' </div>
									<div>'. $imovel->address['address'] .'</div>
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