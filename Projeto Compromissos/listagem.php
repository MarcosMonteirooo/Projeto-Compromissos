<?php
require_once 'fabrica.php';

function gerarLinhasCompromissos( string $pesquisa ) {
    try {
        $repositorio = criarRepositorio();
        $compromissos = $repositorio->todos( $pesquisa );
        desenharCompromissos( $compromissos );
    } catch ( PDOException|RepositorioException $e ) {
        echo 'Erro';
    }
}

/**
 * Desenha os compromissos como linhas de tabela.
 * @param Compromisso[] $compromissos
 * @return void
 */
function desenharCompromissos( array $compromissos ): void {
    foreach ( $compromissos as $c ) {
        $horario = $c->data . ' ' . $c->hora;
        $status = match ( $c->status->value ) {
            'A' => 'Agendado',
            'C' => 'Cancelado',
            'R' => 'Realizado'
        };
        $remover = 'remover.php?id=' . $c->id;
        echo <<<HTML
            <tr>
                <td>{$c->id}</td>
                <td>{$c->descricao}</td>
                <td>{$horario}</td>
                <td>{$status}</td>
                <td><a href="$remover" >Remover</a></td>
            </tr>
        HTML;
    }
}
