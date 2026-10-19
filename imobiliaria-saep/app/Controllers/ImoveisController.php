<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProprietariosModel;
use App\Models\ImoveisModel;

// Vincula o Imoveis com seu respectivo PROPRIETARIO
class ImoveisController extends BaseController
{
    // Exibe a listagem de Imoveiss
    public function index()
    {
        // Instancia o Model de Imoveis
        $model = new ImoveisModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado pelo usuário
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os Imóvels juntamente com o nome do PROPRIETARIO
            // responsável por cada Imoveis
            $dados['imoveis'] = $model
                ->select('IMOVEIS.*, PROPRIETARIOS.PRO_NOME')

                // Relaciona imoveis com proprietarios pela chave estrangeira
                ->join(
                    'PROPRIETARIOS',
                    'PROPRIETARIOS.PRO_ID = IMOVEIS.FK_PRO_ID'
                )

                // Agrupa as condições da pesquisa
                ->groupStart()

                    // Pesquisa pelo endereço
                    ->like('IMO_ENDERECO', $pesquisar)

                    // Pesquisa pela valor
                    ->orLike('IMO_VALOR', $pesquisar)

                    // Também permite pesquisar pelo nome do proprietário
                    ->orLike('PROPRIETARIOS.PRO_NOME', $pesquisar)

                ->groupEnd()

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso não exista pesquisa, busca todos os Imóvels
            // juntamente com o nome dos PROpectivos PROPRIETARIOS
            $dados['imoveis'] = $model
                ->select('IMOVEIS.*, PROPRIETARIOS.PRO_NOME')
                ->join(
                    'PROPRIETARIOS',
                    'PROPRIETARIOS.PRO_ID = IMOVEIS.FK_PRO_ID'
                )
                ->findAll();
        }

        // Carrega a View de IMOVEIS
        return view('sistema/imoveis/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo imoveis
    public function novo()
    {
        // Instancia o Model de responsaveis
        $proprietariosModel = new ProprietariosModel();

        // Busca todos os responsaveis cadastrados
        // Esses dados serão utilizados em um campo SELECT
        $dados['proprietarios'] = $proprietariosModel->findAll();

        // Carrega o formulário de cadastro do imoveis
        return view('sistema/imoveis/novo_imovel', $dados);
    }


    // Insere um novo imoveis
    public function inserir()
    {
        // Instancia o Model de imoveis
        $model = new ImoveisModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'IMO_ENDERECO' => $this->request->getPost('endereco'),
            'IMO_ANO' => $this->request->getPost('ano'),
            'IMO_VALOR' => $this->request->getPost('valor'),
            
            // Guarda o ID do proprietarios escolhido no formulário
            // como chave estrangeira do imoveis
            'FK_PRO_ID' => $this->request->getPost('proprietarios')
        ];

        // Insere o imoveis no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imoveis'))
            ->with('success', 'Imóvel cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia o Model de imoveis
        $imoveisModel = new ImoveisModel();

        // Instancia o Model de responsáveis
        $proprietariosModel = new ProprietariosModel();

        // Busca o Imóvel que será editado
        $dados['imoveis'] = $imoveisModel->find($id);

        // Busca todos os proprietarios para preencher o SELECT
        $dados['proprietarios'] = $proprietariosModel->findAll();

        // Carrega a View de edição
        return view('sistema/imoveis/editar_imovel', $dados);
    }


    // Atualiza um imóvel
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new ImoveisModel();

        // Recupera os novos dados do formulário
        $dados = [
            'IMO_ENDERECO' => $this->request->getPost('endereco'),
            'IMO_ANO' => $this->request->getPost('ano'),
            'IMO_VALOR' => $this->request->getPost('valor'),
            
            // Guarda o ID do proprietarios escolhido no formulário
            // como chave estrangeira do imoveis
            'FK_PRO_ID' => $this->request->getPost('proprietarios')
        ];


        // Atualiza o Imoveis pelo ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imoveis'))
            ->with('success', 'Imóvel atualizado com sucesso!');
    }


    // Exclui um Imóvel
    public function excluir($id)
    {
        // Instancia o Model
        $model = new ImoveisModel();

        // Exclui o Imóvel pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imoveis'))
            ->with('success', 'Imóvel excluído com sucesso!');
    }
}