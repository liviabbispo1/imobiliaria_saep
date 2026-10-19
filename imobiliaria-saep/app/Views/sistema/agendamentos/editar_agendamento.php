
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Agendamento</title>
    </head>
    <body>
        <h1>Editar Agendamento</h1>

        <form action="<?= base_url('agendamentos/atualizar/'.$agendamentos['AGE_ID']) ?>" method="POST">
            <label>Data e Hora:</label><br>
            <input type="datetime-local" id="data_hora" name="data_hora" value="<?= date('Y-m-d\TH:i', strtotime($agendamentos['AGE_DATA_HORA'])) ?>" required>
            <br><br>

            <label>Serviço:</label><br>
            <input type="text" id="servico" name="servico" value="<?= $agendamentos['AGE_SERVICO'] ?>" required>
            <br><br>

            <label>Status:</label><br>
            <input type="text" id="status" name="status" value="<?= $agendamentos['AGE_STATUS'] ?>" required>
            <br><br>

            <label>Proprietário:</label><br>
            <select id="proprietarios" name="proprietarios" required>
                <?php foreach($proprietarios as $pro): ?>
                    <option value="<?= $pro['PRO_ID'] ?>"
                        <?= $pro['PRO_ID'] == $agendamentos['FK_PRO_ID'] ? 'selected' : '' ?>>
                        <?= $pro['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>Imóveis:</label><br>
            <select id="imoveis" name="imoveis" required>
                <?php foreach($imoveis as $imo): ?>
                    <option value="<?= $imo['IMO_ID'] ?>"
                        <?= $imo['IMO_ID'] == $agendamentos['FK_IMO_ID'] ? 'selected' : '' ?>>
                        <?= $imo['IMO_ENDERECO'] ?> 
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="editar_agendamento" name="editar_agendamento" value="Salvar Alterações">
        </form>
        <br>
        <a href="<?= base_url('agendamentos') ?>"><button>Voltar</button></a>
    </body>
</html>