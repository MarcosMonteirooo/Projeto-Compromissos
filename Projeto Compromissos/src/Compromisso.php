<?php
class Compromisso {

    public function __construct(
        public readonly int $id,
        public readonly string $descricao,
        public readonly string $data,
        public readonly string $hora,
        public readonly StatusCompromisso $status,
    ) {
        $this->validar();
    }

    private function validar(): void {
        if ( $this->id < 0 ) {
            throw new RuntimeException( 'Id não pode ser negativo.' );
        }
        $tamanhoDescricao = mb_strlen( $this->descricao );
        if ( $tamanhoDescricao < 3 || $tamanhoDescricao > 50 ) {
            throw new RuntimeException( 'Descrição deve ter de 3 a 50 caracteres.' );
        }
        $partes = explode( '-', $this->data );
        if ( count( $partes ) != 3 ) {
            throw new RuntimeException( 'Data inválida.' );
        }
        [ $ano, $mes, $dia ] = $partes;
        if ( ! checkdate( $mes, $dia, $ano ) ) {
            throw new RuntimeException( 'Data incorreta.' );
        }
        $partes = explode( ':', $this->hora );
        if ( count( $partes ) < 2 || count( $partes ) > 3 ) {
            throw new RuntimeException( 'Hora inválida.' );
        }
        [ $hora, $minuto ] = $partes;
        if ( $hora < 0 || $hora > 24 || $minuto < 0 || $minuto > 59 ) {
            throw new RuntimeException( 'Hora incorreta.' );
        }
    }
}

enum StatusCompromisso: string {
    case AGENDADO = 'A';
    case CANCELADO = 'C';
    case REALIZADO = 'R';
}