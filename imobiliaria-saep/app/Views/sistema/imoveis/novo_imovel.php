<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Imóvel</title>
    </head>
    <body>
        <h1>Novo Imóvel</h1>
        <form action="<?= base_url('imoveis/inserir') ?>" method="POST">
            <label>Endereço:</label><br>
            <input type="text" id="endereco" name="endereco" required>

            <br><br>
           
            <label>Ano:</label><br>
            <input type="text" id="ano" name="ano" required>

            <br><br>


               <label>Valor:</label><br>
            <input type="text" id="valor" name="valor" required>

            <br><br>

            <label>Proprietario</label><br>
            <select id="proprietario" name="proprietarios" required>
                <option value = "">Selecione um proprietário</option>
                <?php foreach($proprietarios as $pro): ?>

                    <option value ="<?= $pro['PRO_ID']?>">
                        <?= $pro['PRO_NOME']?>
                </option>

                    <?php endforeach;?>



         </select>
         <br><br>


            <input type="submit" id="cadastrar_imovel" name="cadastrar_imovel" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('imoveis') ?>"><button>Voltar</button></a>
    </body>
</html>