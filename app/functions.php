<?php

use Sunra\PhpSimple\HtmlDomParser;

/**
 * Update all quotes from https://prostocoin.com/marketcap
 */
function update( $max_pages = 2 ) {
	$url_base  = "https://prostocoin.com/marketcap&page=";
	$btc_array = array();
	for ( $i = 1; $i <= $max_pages; $i ++ ) {
		sleep( 1 );
		$html = get_page( $url_base . $i );
		$dom  = HtmlDomParser::str_get_html( $html );
		foreach ( $dom->find( "tr" ) as $index => $row ) {
			// strip first row
			if ( $index === 0 ) {
				continue;
			}

			$cryptoCurrency = new CryptoCurrency( $row );
			$btc_array[]    = $cryptoCurrency->toArray();
		}
		echo "Обработана страница #$i" . PHP_EOL;
	}

	save( $btc_array );
}

/**
 * @param $url
 *
 * @return bool|string
 */
function get_page( $url ) {
	return file_get_contents( $url );
}

/**
 * @param $array
 */
function save( $array ) {
	if ( ! empty( $array ) ) {
		echo "Найдено " . count( $array ) . " КРИПТОВАЛЮТ" . PHP_EOL;
		file_put_contents( 'data.json', json_encode( $array ) );
	} else {
		echo "КРИПТОВАЛЮТ не найдено";
	}
}
