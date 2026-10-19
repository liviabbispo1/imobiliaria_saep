<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo proprietario</title>
    </head>
    <body>
        <h1>Novo proprietario</h1>
        <form action="<?= base_url('proprietarios/inserir') ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" placeholder="Nome..." required>

            <br><br>
           
            <label>CPF:</label><br>
            <input type="text" id="cpf" name="cpf" required>

            <br><br>

             <label>Telefone:</label><br>
            <input type="tel" id="telefone" name="telefone" required>

            <br><br>

            <input type="submit" id="cadastrar_proprietario" name="cadastrar_proprietario" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('proprietarios') ?>"><button>Voltar</button></a>
    </body>
</html>