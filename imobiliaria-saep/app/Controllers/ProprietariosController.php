<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProprietariosModel;

class ProprietariosController extends BaseController
{
    // Exibe a listagem de Proprietarios
    public function index()
    {
        // Instancia o Model Proprietario pela tabela Proprietarios
        $model = new ProprietariosModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado no campo de pesquisa
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca proprietarios que possuem o termo informado
            // no nome OU DATA NASCIMENTO
            $dados['proprietarios'] = $model
                ->like('PRO_NOME', $pesquisar)
                ->orLike('PRO_CPF', $pesquisar)
                ->orLike('PRO_TELEFONE', $pesquisar)

                
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os proprietarios cadastrados
            $dados['proprietarios'] = $model->findAll();
        }

        // Carrega a View de listagem e envia os proprietarios encontrados
        return view('sistema/proprietarios/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo proprietarios
    public function novo()
    {
        // Apenas carrega a View com o formulário
        return view('sistema/proprietarios/novo_proprietario');
    }


    // Insere um novo proprietarios no banco de dados
    public function inserir()
    {
        // Instancia o Model
        $model = new ProprietariosModel();

        // Recupera os valor enviados pelo formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_CPF' => $this->request->getPost('cpf'),
            'PRO_TELEFONE' => $this->request->getPost('telefone'),

        ];

        // Insere o novo proprietarios no banco
        $model->insert($dados);

        // Redireciona para a listagem de proprietarios
        return redirect()
            ->to(base_url('proprietarios'))
            ->with('success', 'Proprietario cadastrado com sucesso!');
    }


    // Exibe o formulário para editar um proprietarios
    public function editar($id)
    {
        // Instancia o Model
        $model = new ProprietariosModel();

        // Busca o proprietarios pelo ID recebido na URL
        $dados['proprietarios'] = $model->find($id);

        // Carrega a View de edição enviando os dados do proprietarios
        return view('sistema/proprietarios/editar_proprietario', $dados);
    }


    // Atualiza os dados de um proprietarios
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new ProprietariosModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_CPF' => $this->request->getPost('cpf'),
            'PRO_TELEFONE' => $this->request->getPost('telefone'),
            
        ];

        // Atualiza o registro correspondente ao ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('proprietarios'))
            ->with('success', 'Proprietario atualizado com sucesso!');
    }


    // Exclui um proprietarios
    public function excluir($id)
    {
        // Instancia o Model
        $model = new ProprietariosModel();

        // Exclui o registro correspondente ao ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('proprietarios'))
            ->with('success', 'Proprietario excluído com sucesso!');
    }
}