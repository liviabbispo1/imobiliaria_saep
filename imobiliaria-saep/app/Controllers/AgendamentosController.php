<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AgendamentosModel;
use App\Models\ImoveisModel;
use App\Models\ProprietariosModel;

// Vincula o Agendamento ao Imoveis (FK_IMO_ID) com seu respectivo proprietario (FK_PRO_ID)
class AgendamentosController extends BaseController
{
    // Exibe a listagem de agendamentos
    public function index()
    {
        // Instancia o Model de agendamento
        $model = new AgendamentosModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o termo digitado
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os agendamentos juntamente com
            // informações do Imoveis e do PROprietario
            $dados['agendamentos'] = $model
                ->select(
                    'AGENDAMENTOS.*,
                    IMOVEIS.IMO_ENDERECO,
                    PROPRIETARIOS.PRO_NOME'
                )

                // Relaciona o agendamento ao Imoveis
                ->join(
                    'IMOVEIS',
                    'IMOVEIS.IMO_ID = AGENDAMENTOS.FK_IMO_ID'
                )

                // Relaciona o agendamento ao responsável
                ->join(
                    'PROPRIETARIOS',
                    'PROPRIETARIOS.PRO_ID = AGENDAMENTOS.FK_PRO_ID'
                )

                // Agrupa as condições utilizadas na pesquisa
                ->groupStart()

                    // Pesquisa pelo nome do Imoveis
                    ->like('IMOVEIS.IMO_ENDERECO', $pesquisar)

                    // Pesquisa pelo nome do responsável
                    ->orLike('PROPRIETARIOS.PRO_NOME', $pesquisar)

                    // Pesquisa pelo motivo
                    ->orLike('AGE_SERVICO', $pesquisar)

                    // Pesquisa pelo status
                    ->orLike('AGE_STATUS', $pesquisar)

                ->groupEnd()

                // Ordena os agendamentos pela data e hora
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os agendamentos
            $dados['agendamentos'] = $model
                ->select(
                    'AGENDAMENTOS.*,
                    IMOVEIS.IMO_ENDERECO,
                    PROPRIETARIOS.PRO_NOME'
                )

                // Relaciona o Imoveis ao agendamento
                ->join(
                    'IMOVEIS',
                    'IMOVEIS.IMO_ID = AGENDAMENTOS.FK_IMO_ID'
                )

                // Relaciona o responsável ao agendamento
                ->join(
                    'PROPRIETARIOS',
                    'PROPRIETARIOS.PRO_ID = AGENDAMENTOS.FK_PRO_ID'
                )

                // Ordena pela data e hora do agendamento
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }

        // Carrega a View com os agendamentos encontrados
        return view('sistema/agendamentos/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo agendamento
    public function novo()
    {
        // Instancia o Model de Imoveis
        $imoveisModel = new ImoveisModel();

        // Instancia o Model de responsável
        $proprietariosModel = new ProprietariosModel();

        // Busca todos os imoveis para preencher o SELECT
        $dados['imoveis'] = $imoveisModel->findAll();

        // Busca todos os responsáveis para preencher o SELECT
        $dados['proprietarios'] = $proprietariosModel->findAll();

        // Carrega o formulário
        return view(
            'sistema/agendamentos/novo_agendamento',
            $dados
        );
    }


    // Insere um novo agendamento
    public function inserir()
    {
        // Instancia o Model
        $model = new AgendamentosModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_SERVICO' => $this->request->getPost('servico'),
            'AGE_STATUS' => $this->request->getPost('status'),

            // imoveis escolhido no formulário
            'FK_IMO_ID' => $this->request->getPost('imoveis'),

            // Responsável escolhido no formulário
            'FK_PRO_ID' => $this->request->getPost('proprietarios')
        ];

        // Insere o agendamento no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamentos'))
            ->with('success', 'Agendamento cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia os três Models necessários
        $agendamentosModel = new AgendamentosModel();
        $imoveisModel = new ImoveisModel();
        $proprietariosModel = new ProprietariosModel();

        // Busca o agendamento pelo ID
        $dados['agendamentos'] = $agendamentosModel->find($id);

        // Busca os imoveiss para preencher o SELECT
        $dados['imoveis'] = $imoveisModel->findAll();

        // Busca os responsáveis para preencher o SELECT
        $dados['proprietarios'] = $proprietariosModel->findAll();

        // Carrega a View de edição
        return view(
            'sistema/agendamentos/editar_agendamento',
            $dados
        );
    }


    // Atualiza um agendamento
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new AgendamentoSModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_SERVICO' => $this->request->getPost('servico'),
            'AGE_STATUS' => $this->request->getPost('status'),
            'FK_IMO_ID' => $this->request->getPost('imoveis'),
            'FK_PRO_ID' => $this->request->getPost('proprietarios')
        ];

        // Atualiza o agendamento no banco
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamentos'))
            ->with('success', 'Agendamento atualizado com sucesso!');
    }


    // Exclui um agendamento
    public function excluir($id)
    {
        // Instancia o Model
        $model = new AgendamentosModel();

        // Exclui o agendamento pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamentos'))
            ->with('success', 'Agendamento excluído com sucesso!');
    }
}