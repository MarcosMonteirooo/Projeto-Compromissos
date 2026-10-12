<?php
require_once 'fabrica.php';
require_once 'src/Compromisso.php';

$id = htmlspecialchars( $_POST[ 'id' ] ?? '' );
$descricao = htmlspecialchars( $_POST[ 'descricao' ] ?? '' );
$data = htmlspecialchars( $_POST[ 'data' ] ?? '' );
$hora = htmlspecialchars( $_POST[ 'hora' ] ?? '' );
$status = StatusCompromisso::tryFrom(
    htmlspecialchars( $_POST[ 'status' ] ?? '' )
);

$compromisso = null;
try {
    $compromisso = new Compromisso( (int) $id, $descricao, $data, $hora, $status );
} catch ( RuntimeException $e ) {
    http_response_code( 400 ); // Bad Request
    die( $e->getMessage() );
}

try {
    $repositorio = criarRepositorio();
    $id = $repositorio->salvar( $compromisso );

    if ( $id == 0 ) {
        http_response_code( 404 ); // Not Found
        die( 'Não encontrado.' );
    }

    // http_response_code( 200 );
    header( 'Location: index.php' ); // Redireciona para o index se deu tudo certo
    die();

} catch ( RepositorioException | PDOException $e ) {
    http_response_code( 500 ); // Internal Server Error
    die( $e->getMessage() );
}