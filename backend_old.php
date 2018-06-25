<?php
require_once( dirname( __FILE__ ) . '/admin.php' );


function valorUF(){
/*
    $apiUrl = 'http://mindicador.cl/api';

    if ( ini_get('allow_url_fopen') ) {
        $json = file_get_contents($apiUrl);
    } else {
        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($curl);
        curl_close($curl);
    }

    $dailyIndicators = json_decode($json);

    return $dailyIndicators->uf->valor;
*/

$JsonSource = "http://indicadoresdeldia.cl/webservice/indicadores.json";
$json = json_decode(file_get_contents($JsonSource));

return substr($json->moneda->uf,1);
}

global $wpdb;
$price_1;
$ufhoy = valorUF();

$fivesdrafts = $wpdb->get_results( 
	"
	SELECT ID
	FROM $wpdb->posts
        WHERE post_status = 'publish' AND
              post_type = 'property'
	"
);

$count = $wpdb->get_var( 
	"
	SELECT COUNT(*)
	FROM $wpdb->posts
        WHERE post_status = 'publish' AND
              post_type = 'property'
	"
);

foreach ( $fivesdrafts as $fivesdraft ) 
{
        $price_2 = $wpdb->get_results( 
	    "
	    SELECT meta_value
	    FROM $wpdb->postmeta
            WHERE post_id = $fivesdraft->ID
                        AND meta_key = 'REAL_HOMES_property_price_2'

	    "
        );
        if($price_2[0]->meta_value != null){
            $price_1 = $price_2[0]->meta_value*number_format(substr($ufhoy,0,6), 3, '', ''); /* echo $price_1.' - '.number_format($ufhoy, 3, '', '').'<br>'; */
            $wpdb->query( $wpdb->prepare(
	        "
	        UPDATE $wpdb->postmeta
                SET meta_value = %d
                WHERE post_id = %d AND meta_key = 'REAL_HOMES_property_price'

	        ",$price_1,$fivesdraft->ID
            ));

        }
}
