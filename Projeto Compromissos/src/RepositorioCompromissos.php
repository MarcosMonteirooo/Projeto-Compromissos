<?php

interface RepositorioCompromissos {

    /**
     * Obtém todos os compromissos.
     * @param string $pesquisa Pesquisa pela descrição.
     * @return Compromisso[]
     */
    public function todos( string $pesquisa = '' ): array;

    /**
     * Remove um compromisso, retornando `true` se encontrou ou `false` caso contrário.
     * @param int $id
     * @return bool
     */
    public function removerPeloId( int $id ): bool;


    /**
     * Salva o compromisso, dependendo de seu id.
     * @param Compromisso $c
     * @return int Id gerado ou id atual.
     */
    public function salvar( Compromisso $c ): int;
}