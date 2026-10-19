
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Imóveis</title>
</head>

<body>

    <h1>Lista de Imóveis</h1>

    <form method="POST" action="<?= base_url('imoveis') ?>">
        <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">

        <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
    </form>

    <br>

    <table border="1"

        <tr>
            <th>Endereço</th>
            <th>Ano</th>
            <th>Valor</th>
            <th>Proprietário</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>

        <?php foreach ($imoveis as $imo): ?>

            <tr>

                <td><?= $imo['IMO_ENDERECO'] ?></td>

                <td> <?= $imo['IMO_ANO'] ?></td>

                <td> <?= $imo['IMO_VALOR'] ?></td>



                  <td> <?= $imo['PRO_NOME'] ?> </td>

                <td><a href="<?= base_url('imoveis/editar/' .$imo['IMO_ID']) ?>">Editar</a></td>

                <td><a href="<?= base_url('imoveis/excluir/' .$imo['IMO_ID']) ?>">Excluir</a></td>

            </tr>

        <?php endforeach; ?>

    </table>

    <br>

    <a href="<?= base_url('imoveis/novo') ?>">
        <button>Cadastrar imóvel</button>
    </a>

    <br><br>

    <a href="<?= base_url('inicio') ?>">
        <button>Voltar</button>
    </a>

</body>

</html>

