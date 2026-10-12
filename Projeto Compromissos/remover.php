<?php
require_once 'fabrica.php';

$id = $_GET[ 'id' ] ?? '';

if ( $id == '' || ! is_numeric( $id ) ) {
    http_response_code( 400 ); // Bad Request
    die( 'Por favor informe um id numérico como parâmetro.' );
}

try {
    $repositorio = criarRepositorio();
    $removeu = $repositorio->removerPeloId( (int) $id );
    if ( $removeu ) {
        echo 'Removido com sucesso.';
    } else {
        http_response_code( 404 ); // Not Found
        die( 'Não encontrado.' );
    }
} catch ( Exception $e ) {
    http_response_code( 500 );
    die( 'Erro ao remover: ' . $e->getMessage() );
}