<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compromisso</title>
</head>
<body>
    <h1>Compromisso</h1>
    <form action="cadastrar-ou-alterar.php" method="post">

        <input type="hidden" name="id" id="id" />

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao"
            minlength="3" maxlength="50" required />

        <label for="data">Data:</label>
        <input type="date" name="data" id="data" required />

        <label for="hora">Hora:</label>
        <input type="time" name="hora" id="hora" required />

        <label for="status">Status:</label>
        <select name="status" id="status" required >
            <option value="A" selected >Agendado</option>
            <option value="C" >Cancelado</option>
            <option value="R" >Realizado</option>
        </select>

        <button>Salvar</button>
    </form>
</body>
</html>