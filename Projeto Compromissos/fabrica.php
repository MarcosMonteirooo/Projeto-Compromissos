<?php
require_once 'src/RepositorioCompromissos.php';
require_once 'src/RepositorioCompromissosEmPDO.php';

function criarRepositorio(): RepositorioCompromissos {
    return new RepositorioCompromissosEmPDO( conectar() );
}

function conectar(): PDO {
    return new PDO( 'mysql:dbname=sistema;host=localhost;charset=utf8', 'root', 'root' );
}