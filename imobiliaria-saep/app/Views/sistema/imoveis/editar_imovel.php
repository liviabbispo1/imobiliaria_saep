<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar imovel</title>
    </head>
    <body>
        <h1>Editar imovel</h1>

        <form action="<?= base_url('imoveis/atualizar/'.$imoveis['IMO_ID']) ?>" method="POST">
            <label>Endereço:</label><br>
            <input type="text" id="endereco" name="endereco" value="<?= $imoveis['IMO_ENDERECO'] ?>" required>
            <br><br>
            <label>Ano</label><br>
            <input type="text" id="ano" name="ano" value="<?= $imoveis['IMO_ANO'] ?>" required>
            <br><br>

            <label>Valor</label><br>
            <input type="text" id="valor" name="valor" value="<?= $imoveis['IMO_VALOR'] ?>" required>
            <br><br>

              <select id="proprietarios" name="proprietarios" required>
                <?php foreach($proprietarios as $pro): ?>
                    <option value="<?= $pro['PRO_ID'] ?>"
                        <?= $pro['PRO_ID'] == $imoveis['FK_PRO_ID'] ? 'selected' : '' ?>>
                        <?= $pro['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <input type="submit" id="editar_imovel" name="editar_imovel" value="Salvar Alterações">
        </form>

        <br>
        <a href="<?= base_url('imoveis') ?>"><button>Voltar</button></a>
    </body>
</html>