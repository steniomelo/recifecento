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

	//var_dump($dayofweek);

	//var_dump('abertura', $horarios['horario_de_funcionamento']['abertura']);
	//var_dump('fechamento', $horarios['horario_de_funcionamento']['fechamento']);
	//compareDates($horarios['horario_de_funcionamento']['abertura'], $horarios['horario_de_funcionamento']['fechamento']);
	//var_dump(in_array($dayofweek, $horarios['dias_da_semana']));
	return (in_array($dayofweek, $horarios['dias_da_semana']) && compareDates($horarios['horario_de_funcionamento']['abertura'], $horarios['horario_de_funcionamento']['fechamento'])) ? 'Aberto' : 'Fechado';
	//return date(strtotime($horarios['horario_de_funcionamento']['abertura']), time());
}

function compareDates($start, $end) {
	// $now = date(time());

	$tz = 'America/Sao_Paulo';
	$timestamp = time();
	$now = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
	$now->setTimestamp($timestamp); //adjust the object to correct timestamp

    $_start = (int)str_replace(':', '', date($start));
	$_end = (int)str_replace(':', '', date($end));
	$_now = (int)str_replace(':', '', $now->format(get_option('time_format')));
	
	//var_dump('now', $_start);
	
	// var_dump('now', $_now);
	// var_dump('start', $_start);
	// var_dump('end', $_end);

	// var_dump('now', (int)str_replace(':', '', $now->format(get_option('time_format'))));
	// var_dump('start', (int)str_replace(':', '', $start));
	// var_dump('end', (int)str_replace(':', '', $end));

    if ($_start < $_now && $_end > $_now) {
      return true;
    } else {
      return false;
    }
}

function isRecomendado($recomendado) {
	return ($recomendado) ? '<span class="tags__recomendado recomendado"><img src="'.ASSETS.'/img/icons/star.svg" class="recomendado__icon">Recomendado</span>' : "";
}

function formatarHorarios($horarios) {
	//var_dump($horarios);

	$returnHorarios = ''; 

	if(!empty($horarios['dias_da_semana'])) {
		
		if(($key = array_search('sabado', $horarios['dias_da_semana'])) !== false) {
			unset($horarios['dias_da_semana'][$key]);
		}
		if(($key = array_search('domingo', $horarios['dias_da_semana'])) !== false) {
			unset($horarios['dias_da_semana'][$key]);
		}

		if(!empty($horarios['dias_da_semana'])) {
			$returnHorarios .= ucfirst($horarios['dias_da_semana'][0]) .' - '. ucfirst(end($horarios['dias_da_semana'])). ' • ' .  $horarios['horario_de_funcionamento']['abertura'] . ' - ' . $horarios['horario_de_funcionamento']['fechamento'] . 'h</br>';
		}
	}
	
	if ((!empty($horarios['horario_de_funcionamento_aos_sabados']['abertura']) && !empty($horarios['horario_de_funcionamento_aos_sabados']['fechamento']))) {
		$returnHorarios .= 'Sábado' . ' • ' .  $horarios['horario_de_funcionamento_aos_sabados']['abertura'] . ' - ' . $horarios['horario_de_funcionamento_aos_sabados']['fechamento'] . 'h</br>';
	}


	if ((!empty($horarios['horario_de_funcionamento_aos_domingos']['abertura']) && !empty($horarios['horario_de_funcionamento_aos_domingos']['fechamento']))) {
		$returnHorarios .= 'Domingo' . ' • ' .  $horarios['horario_de_funcionamento_aos_domingos']['abertura'] . ' - ' . $horarios['horario_de_funcionamento_aos_domingos']['fechamento'] . 'h</br>';
	}

	return $returnHorarios;
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
	$categoria = '';
	$produto_by_title;

	if($filters['produto'] && !$filters['keyword']) {
		$produto = [
			'key' => 'produtos',
			'value' => $filters['produto'],
			'compare' => 'LIKE',
		];

		array_push($query_array, $produto); // Busca por produto
	}



	//var_dump($query); die();
	
	
	if($query_vars['category_name'] && !$filters['subcategoria'] && !$filters['keyword']) { //Adicionando keyword para que faça uma busca geral por keyword sem limitar a categoria
		//var_dump();
		$categoria = $query_vars['category_name'];
	} else if($filters['subcategoria']) {
		$categoria = $filters['subcategoria'];
	} else if(!$filters['keyword']) {
		$categoria = 'varejo';
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

	if($filters['keyword']) { // Busca o keyword por Produtos
		//var_dump($filters['keyword']);
		$produto_by_title = get_page_by_title( $filters['keyword'], OBJECT, 'produtos' );
		//var_dump($page); die();
		$produto = [
			'key' => 'produtos',
			'value' => $produto_by_title->ID,
			'compare' => 'LIKE',
		];

		array_push($query_array, $produto); // Busca por produto
	}

	if($items->found_posts == 0 && $produto_by_title) { // Caso não encontre nada com o keyword busca novamente pelo metaquery de produtos por KeyWord
		
		$items = new WP_Query(array(
			'post_type' => 'estabelecimentos',
			'post_status' => 'publish',
			'posts_per_page' => $qtdImoveis,
			'category_name' => $categoria,
			'paged' => $page,
			'meta_query' => $query_array,
		));
	}

	if($items->found_posts == 0 && $filters['keyword']) { // Caso não encontre nada na busca anterior procura novamente com o keyword como Categoria
		
		$items = new WP_Query(array(
			'post_type' => 'estabelecimentos',
			'post_status' => 'publish',
			'posts_per_page' => $qtdImoveis,
			'category_name' => $filters['keyword'],
			'paged' => $page,
		));
	}


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
								'.get_the_post_thumbnail($imovel->ID, array(183,177), array( 'class' => 'imovel-img' )).'
							</div>
							

							<div class="imovel-details">
								<header class="imovel-title d-flex">
									<div>	
										<h2 class="imovel-nome">'.$imovel->post_title.'</h2>
										<small class="imovel-categoria">'. $imovel->categoria[0]->name .'</small>
									</div>
									
									<div class="imovel-aberto imovel-status ml-auto '. strtolower(isAberto($imovel->horarios)) .'">'. isAberto($imovel->horarios) .'</div>

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

function get_estabelecimentos_acf($itemsFiltrados) {

$html = array();
$i = 0;


foreach($itemsFiltrados as $imovel) {

        $endereco = get_field('endereco', $imovel->ID);
		$imovel->lat = $endereco['lat'];
		$imovel->lng = $endereco['lng'];
		$imovel->address = $endereco;
		$imovel->horarios = get_field('horario_de_funcionamento', $imovel->ID);
		$imovel->categoria = get_the_category($imovel->ID);
		$imovel->recomendado = get_field('recomendado', $imovel->ID);

			array_push($html, '
				<div class="list-item imovel-card ">
					<a href="'. get_post_permalink($imovel->ID) .'">
					<div class="imovel-container">
						<div class="imovel-content d-flex"> 

							<div class="imovel-thumbnail">
								'. isRecomendado($imovel->recomendado) .'
								'.get_the_post_thumbnail($imovel->ID, array(183,177), array( 'class' => 'imovel-img' )).'
							</div>
							

							<div class="imovel-details">
								<header class="imovel-title d-flex">
									<div>	
										<h2 class="imovel-nome">'.$imovel->post_title.'</h2>
										<small class="imovel-categoria">'. $imovel->categoria[0]->name .'</small>
									</div>
									
									<div class="imovel-aberto imovel-status ml-auto '. strtolower(isAberto($imovel->horarios)) .'">'. isAberto($imovel->horarios) .'</div>

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
            ');
			$i += 1;
        }
        
return $html;

}
?>