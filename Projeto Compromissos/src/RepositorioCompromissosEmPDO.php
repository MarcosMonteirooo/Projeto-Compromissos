<?php
require_once 'Compromisso.php';
require_once 'RepositorioCompromissos.php';
require_once 'RepositorioException.php';

class RepositorioCompromissosEmPDO implements RepositorioCompromissos {

    public function __construct( private PDO $pdo ) {}

    public function todos( string $pesquisa = '' ): array {
        try {
            $stmt = $this->pdo->prepare(
                'SELECT * FROM compromisso WHERE descricao LIKE ?' );
            $stmt->execute( [ '%' . $pesquisa . '%' ]);
            $compromissos = [];
            foreach ( $stmt as $c ) {
                $compromissos []= new Compromisso(
                    $c['id'], $c['descricao'], $c['data'], $c['hora'],
                    StatusCompromisso::tryFrom( $c['status'] )
                    );
            }
            return $compromissos;
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao obter os compromissos.', 0, $e );
        }
    }

    public function removerPeloId( int $id ): bool {
        try {
            $stmt = $this->pdo->prepare( 'DELETE FROM compromisso WHERE id = ?' );
            $stmt->execute( [ $id ] );
            return $stmt->rowCount() > 0;
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao remover o compromisso.', 0, $e );
        }
    }


    public function salvar( Compromisso $c ): int {
        $novo = $c->id == 0;
        try {
            $sql = '';
            $params = [
                'descricao' => $c->descricao,
                'data' => $c->data,
                'hora' => $c->hora,
                'status' => $c->status->value,
            ];
            if ( $novo ) {
                $sql = 'INSERT INTO compromisso ( descricao, data, hora, status ) VALUES
                    ( :descricao, :data, :hora, :status )';
            } else {
                $sql = 'UPDATE compromisso SET
                    descricao = :descricao, data = :data, hora = :hora, status = :status
                    WHERE id = :id';
                $params[ 'id' ] = $c->id;
            }
            $stmt = $this->pdo->prepare( $sql );
            $stmt->execute( $params );

            if ( $novo ) {
                return $this->pdo->lastInsertId();
            }
            return $stmt->rowCount() > 0 ? $c->id : 0; // Zero indica que não achou

        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao salvar o compromisso.', 0, $e );
        }
    }
}