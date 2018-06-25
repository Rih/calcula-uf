<?php
require_once( dirname( __FILE__ ) . '/admin.php' );

global $wpdb;

$ufhoy = $_POST['uf'];
//meta_value y REAL_HOMES_property_price_2 es el valor en UF
//meta_value y REAL_HOMES_property_price es el valor en pesos

$fivesdrafts = $wpdb->get_results( 
	"
	SELECT ID
    FROM $wpdb->posts P
    INNER JOIN $wpdb->postmeta PM ON P.ID = PM.post_id
    WHERE P.post_status = 'publish' AND
            P.post_type = 'property' AND 
            PM.meta_value is NOT NULL AND
            PM.meta_key = 'REAL_HOMES_property_price_2'
	"
);


//meta_value y REAL_HOMES_property_price_2 es el valor en UF
//meta_value y REAL_HOMES_property_price es el valor en pesos
if($ufhoy > 0){
    $count = count($fivesdrafts);
    $wpdb->query( $wpdb->prepare(
        "
        UPDATE $T MAIN_TABLE
        INNER JOIN 
        (SELECT t1.ID ID_pesos, t2.ID ID_uf, t1.meta_value uf, t2.meta_value pesos
        FROM $T1 t1
        INNER JOIN $T2 t2 
        ON 
            t1.post_id = t2.post_id 
            AND t1.meta_key = 'REAL_HOMES_property_price'
            AND t2.meta_key = 'REAL_HOMES_property_price_2'
        WHERE t1.meta_value IS NOT NULL
        GROUP BY t1.post_id
        ) T ON T.post_id = MAIN_TABLE.post_id AND MAIN_TABLE.meta_key = 'REAL_HOMES_property_price_2'
        SET MAIN_TABLE.meta_value = T.uf * %d
        WHERE MAIN_TABLE.ID = t1.ID_pesos
        ", $ufhoy));
    $status = "200";
    $err = "";

}else{
    $count = 0;
    $status = "403";
    $err = "Valor UF ingresado inválido para actualizar registros";
}
    
echo json_encode(array('totalAffected' => $count, "status"=>$status, "err" => $err));