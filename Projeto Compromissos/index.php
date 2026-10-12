<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compromissos</title>
</head>
<body>
    <h1>Compromissos</h1>
    <a href="form.php" >Cadastrar</a>
    <?php
    $pesquisa = $_GET[ 'pesquisa' ] ?? '';
    ?>
    <form action="index.php" method="get" >
        <label for="pesquisa">Pesquisa:</label>
        <input type="search" name="pesquisa" id="pesquisa"
            value="<?php echo $pesquisa; ?>" >
        <button>Pesquisar</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descrição</th>
                <th>Horário</th>
                <th>Status</th>
                <th>Remoção</th>
            </tr>
        </thead>
        <tbody>
        <?php
        require_once 'listagem.php';
        gerarLinhasCompromissos( $pesquisa );
        ?>
        </tbody>
    </table>
</body>
</html>