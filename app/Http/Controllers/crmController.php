<?php

namespace App\Http\Controllers;
use App\Models\atividade;
use App\Models\conta;
use App\Models\contato;
use App\Models\empresa;
use App\Models\fluxo_op;
use App\Models\funcionario;
use App\Models\OP;
use App\Models\produto;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\DB;
use Illuminate\Support\Facades\Storage;
use Psr\EventDispatcher\StoppableEventInterface;


class crmController extends Controller
{
    protected function BuscaCNPJ(Request $request)
    {

        $cnpj = $request->get("CNPJ");
        $acao = $request->get("acao");
        $url = "https://publica.cnpj.ws/cnpj/$cnpj";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("'Accept': 'application/json'", "Content-Type: 'application/json'"));

        $resp = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($resp);
        $razao_social = $response->razao_social;
        $nome_fantasia = $response->estabelecimento->nome_fantasia;
        $endereco = $response->estabelecimento->tipo_logradouro . " " . $response->estabelecimento->logradouro . ", " . $response->estabelecimento->numero . ", " . $response->estabelecimento->bairro;
        $uf = $response->estabelecimento->estado->sigla;
        $cidade = $response->estabelecimento->cidade->nome;
        $pais = $response->estabelecimento->pais->nome;

        return view("cadempresa", compact("razao_social", "nome_fantasia", "endereco", "uf", "cidade", "cnpj", "pais", "acao"));


    }

    protected function cadempresa(Request $request)
    {
        $conta = new conta();
        $cnpj = $request->get('CNPJ');
        $id_conta = uniqid($cnpj);
        $conta->id_conta = $id_conta;
        $conta->nome_fantasia = $request->get('nome_fantasia');
        $conta->razao_social = $request->get('razao_social');
        $conta->cnpj = $request->get('CNPJ');
        $conta->ie = $request->get('IE');
        $conta->observacoes = $request->get('observacoes');
        $oportunidades_trabalhadas = $request->get('oportunidades_trabalhadas');
        $encode_oportunidades_trabalhadas = json_encode($oportunidades_trabalhadas);
        $conta->oportunidades_trabalhadas = $encode_oportunidades_trabalhadas;
        $conta->cnae = $request->get('cnae');
        $tipo_conta = $request->get('tipo_conta');
        $encode_tipo_conta = json_encode($tipo_conta);
        $conta->tipo_conta = $encode_tipo_conta;
        $conta->telefone1 = $request->get('telefone1');
        $conta->telefone2 = $request->get('telefone2');
        $conta->website = $request->get('website');
        $conta->n_funcionario = $request->get('nfuncionarios');
        $conta->endereco = $request->get('endereco');
        $conta->cidade = $request->get('cidade');
        $conta->cep = $request->get('cep');
        $conta->ramo_atividade = $request->get('ramo_atividade');
        $conta->uf = $request->get('uf');
        $conta->save();

        return $this->ConsultaContas();
    }

    protected function ConsultaContas()
    {
        $dados_conta = json_encode(conta::all('id_conta', 'razao_social', 'nome_fantasia', 'cnpj', 'endereco', 'cidade', 'uf'));
        $lista_dados = json_decode($dados_conta);

        return view("consultaempresa", compact("lista_dados"));
    }

    protected function acessarempresa(Request $request)
    {
        $id_conta = $request->get('id_conta');
        $dados = json_encode(conta::where('id_conta', $id_conta)->get());
        $lista_dados = json_decode($dados);

        $dados_contato = json_encode(contato::where('id_conta', $id_conta)->get());
        $lista_dados_contato = json_decode($dados_contato);

        $dados_op = json_encode(OP::where('id_conta', $id_conta)->get());
        $lista_dados_op = json_decode($dados_op);
        $anexos=glob('../storage/app/anexos/'.$id_conta.'/*');

        return view("acessarempresa", compact("lista_dados", "lista_dados_contato", "lista_dados_op","anexos"));
    }

    protected function editaempresa(Request $request)
    {
        $id_conta = $request->get('id_conta');
        $dados = json_encode(conta::where('id_conta', $id_conta)->get());
        $lista_dados = json_decode($dados);

        return view("editaempresa", compact("lista_dados"));
    }

    protected function atualizaempresa(Request $request)
    {

        $id_conta = $request->get("id_conta");
        $conta = conta::find("$id_conta");
        $conta->nome_fantasia = $request->get('nome_fantasia');
        $conta->razao_social = $request->get('razao_social');
        $conta->cnpj = $request->get('CNPJ');
        $conta->ie = $request->get('IE');
        $conta->observacoes = $request->get('observacoes');
        $oportunidades_trabalhadas = $request->get('oportunidades_trabalhadas');
        $encode_oportunidades_trabalhadas = json_encode($oportunidades_trabalhadas);
        $conta->oportunidades_trabalhadas = $encode_oportunidades_trabalhadas;
        $conta->cnae = $request->get('cnae');
        $tipo_conta = $request->get('tipo_conta');
        $encode_tipo_conta = json_encode($tipo_conta);
        $conta->tipo_conta = $encode_tipo_conta;
        $conta->telefone1 = $request->get('telefone1');
        $conta->telefone2 = $request->get('telefone2');
        $conta->website = $request->get('website');
        $conta->n_funcionario = $request->get('nfuncionarios');
        $conta->endereco = $request->get('endereco');
        $conta->cidade = $request->get('cidade');
        $conta->cep = $request->get('cep');
        $conta->ramo_atividade = $request->get('ramo_atividade');
        $conta->uf = $request->get('uf');
        $conta->save();

        $dados_contato = json_encode(contato::where('id_conta', $id_conta)->get());
        $lista_dados_contato = json_decode($dados_contato);

        $dados = json_encode(conta::where('id_conta', $id_conta)->get());
        $lista_dados = json_decode($dados);

        return view("acessarempresa", compact("lista_dados", "lista_dados_contato"));
    }

    protected function cadcontato(Request $request)
    {
        $id_conta = $request->get('id_conta');
        $dados = json_encode(conta::where('id_conta', $id_conta)->get());
        $lista_dados = json_decode($dados);

        return view("cadcontato", compact("lista_dados"));
    }

    protected function novocontato(Request $request)
    {

        $id_contato = uniqid($request->id_conta);
        $contato = new contato();
        $contato->id_contato = $id_contato;
        $contato->nome = $request->nome;
        $contato->telefone1 = $request->telefone1;
        $contato->telefone2 = $request->telefone2;
        $contato->email = $request->email1;
        $contato->email2 = $request->email2;
        $contato->nivel_tomada_decisao = $request->nivel_tomada_decisao;
        $contato->tratativa_contato = $request->tratativa_contato;
        $contato->decisor = $request->decisor;
        $contato->linkedin = $request->linkedin;
        $contato->parceiro_comercial = $request->parceiro_comercial;
        $contato->info_add = $request->info_add;
        $contato->id_conta = $request->id_conta;
        $contato->save();

        return $this->consultacontatos();

    }

    protected function pesquisarconta(Request $request)
    {
        $razao_social = $request->get('razao_social');
        $cnpj = $request->get('cnpj');
        $uf = $request->get('uf');
        $dados = json_encode(conta::where('razao_social', 'ILIKE', '%' . $razao_social . '%')->where('cnpj', 'ILIKE', '%' . $cnpj . '%')->where('uf', 'ILIKE', '%' . $uf . '%')->get());
        $lista_dados = json_decode($dados);

        return view("consultaempresa", compact("lista_dados"));
    }

    protected function editacontato(Request $request)
    {
        $dados = json_encode(contato::where('id_contato', $request->id_contato)->join('contas', 'contatos.id_conta', '=', 'contas.id_conta')
            ->select('contatos.telefone1 AS ctelefone1', 'contatos.telefone2 AS ctelefone2', 'nome', 'email', 'email2', 'nivel_tomada_decisao', 'tratativa_contato', 'decisor', 'linkedin', 'parceiro_comercial', 'info_add', 'id_contato', 'razao_social')
            ->get());
        $lista_dados = json_decode($dados);
        return view("editacontato", compact("lista_dados"));
    }

    protected function atualizacontato(Request $request)
    {
        $contato = contato::find($request->id_contato);
        $contato->nome = $request->nome;
        $contato->telefone1 = $request->telefone1;
        $contato->telefone2 = $request->telefone2;
        $contato->email = $request->email1;
        $contato->email2 = $request->email2;
        $contato->nivel_tomada_decisao = $request->nivel_tomada_decisao;
        $contato->tratativa_contato = $request->tratativa_contato;
        $contato->decisor = $request->decisor;
        $contato->linkedin = $request->linkedin;
        $contato->parceiro_comercial = $request->parceiro_comercial;
        $contato->info_add = $request->info_add;
        $contato->save();

        $dados = json_encode(contato::where('id_contato', $request->id_contato)->join('contas', 'contatos.id_conta', '=', 'contas.id_conta')
            ->select('contatos.telefone1 AS ctelefone1', 'contatos.telefone2 AS ctelefone2', 'nome', 'email', 'email2', 'nivel_tomada_decisao', 'tratativa_contato', 'decisor', 'linkedin', 'parceiro_comercial', 'info_add', 'id_contato', 'razao_social', 'contatos.id_conta')
            ->get());
        $lista_dados = json_decode($dados);
        return view('acessarcontato', compact('lista_dados'));
    }

    protected function acessarcontato(Request $request)
    {
        $dados = json_encode(contato::where('id_contato', $request->id_contato)->join('contas', 'contatos.id_conta', '=', 'contas.id_conta')
            ->select('contatos.telefone1 AS ctelefone1', 'contatos.telefone2 AS ctelefone2', 'nome', 'email', 'email2', 'nivel_tomada_decisao', 'tratativa_contato', 'decisor', 'linkedin', 'parceiro_comercial', 'info_add', 'id_contato', 'razao_social', 'contatos.id_conta')
            ->get());
        $lista_dados = json_decode($dados);


        return view('acessarcontato', compact('lista_dados'));
    }

    protected function cadproduto(Request $request)
    {
        $produto = new produto();
        $produto->id_produto = uniqid();
        $produto->nome = $request->nome_produto;
        $produto->descricao = $request->descricao_produto;
        $produto->save();

        return $this->consultaprodutos();
    }

    protected function consultaprodutos()
    {
        $dados = json_encode(produto::all('id_produto', 'nome', 'descricao', 'created_at', 'updated_at'));
        $lista_dados = json_decode($dados);

        return view('consultaprodutos', compact('lista_dados'));

    }

    protected function pesquisarproduto(Request $request)
    {
        $nome = $request->get('nome');
        $dados = json_encode(produto::where('nome', 'ILIKE', '%' . $nome . '%')->get());
        $lista_dados = json_decode($dados);
        return view("consultaprodutos", compact("lista_dados"));
    }

    protected function editaproduto(Request $request)
    {
        $id_produto = $request->id_produto;
        $dados = json_encode(produto::where('id_produto', $id_produto)->get());
        $lista_dados = json_decode($dados);

        return view('editaproduto', compact('lista_dados'));
    }

    protected function atualizaproduto(Request $request)
    {

        $id_produto = $request->id_produto;
        $produto = produto::find($id_produto);
        $produto->nome = $request->nome_produto;
        $produto->descricao = $request->descricao_produto;
        $produto->save();

        return route('contatos');
    }

    protected function consultacontatos()
    {
        $dados = json_encode(contato::select('id_contato', 'nome', 'contatos.telefone1 AS ctelefone1', 'contatos.telefone2 AS ctelefone2', 'email', 'razao_social')
            ->join('contas', 'contatos.id_conta', '=', 'contas.id_conta')->get());
        $lista_dados = json_decode($dados);

        return view('consultacontatos', compact('lista_dados'));
    }

    protected function pesquisarcontato(Request $request)
    {
        $nome = $request->get('nome');
        $razao_social = $request->get('razao_social');

        $dados = json_encode(\DB::table('contatos')
            ->join('contas', 'contatos.id_conta', '=', 'contas.id_conta')
            ->where('nome', 'ILIKE', '%' . $nome . '%')
            ->where('contas.razao_social', 'ILIKE', '%' . $razao_social . '%')
            ->select('contatos.telefone1 AS ctelefone1', 'contatos.telefone2 AS ctelefone2', 'nome', 'email', 'email2', 'nivel_tomada_decisao', 'tratativa_contato', 'decisor', 'linkedin', 'parceiro_comercial', 'info_add', 'id_contato', 'razao_social', 'contatos.id_conta')
            ->get());
        $lista_dados = json_decode($dados);
        return view("consultacontatos", compact("lista_dados"));
    }

    protected function cadfuncionario(Request $request)
    {
        $funcionario = new funcionario();
        $funcionario->id_funcionario = uniqid();
        $funcionario->nome = $request->nome;
        $funcionario->tipo = $request->tipo;
        $funcionario->descricao = $request->descricao;
        $funcionario->save();

        return $this->consultafuncionarios();
    }

    protected function consultafuncionarios()
    {
        $dados = json_encode(funcionario::all('nome', 'tipo', 'descricao', 'created_at', 'updated_at', 'id_funcionario'));
        $lista_dados = json_decode($dados);

        return view('consultafuncionarios', compact('lista_dados'));

    }

    protected function editafuncionario(Request $request)
    {
        $dados = json_encode(funcionario::where('id_funcionario', $request->id_funcionario)->get());
        $lista_dados = json_decode($dados);

        return view('editafuncionario', compact('lista_dados'));
    }

    protected function atualizafuncionario(Request $request)
    {
        $funcionario = funcionario::find($request->id_funcionario);
        $funcionario->nome = $request->nome;
        $funcionario->tipo = $request->tipo;
        $funcionario->descricao = $request->descricao;
        $funcionario->save();

        return $this->consultafuncionarios();
    }

    protected function pesquisafuncionario(Request $request)
    {
        $nome = $request->nome;
        $dados = json_encode(funcionario::where('nome', 'ILIKE', '%' . $nome . '%')->get());
        $lista_dados = json_decode($dados);

        return view('consultafuncionarios', compact('lista_dados'));
    }

    protected function cadop(Request $request)
    {
        $id_conta = $request->id_conta;
        $conta = json_encode(conta::where('id_conta', $id_conta)
            ->select('razao_social')
            ->get());
        $lista_conta = json_decode($conta);
        $nome_conta = $lista_conta[0]->razao_social;
        $busca_op = json_encode(OP::orderBy('proposta', 'desc')->get());
        $lista_op = json_decode($busca_op);
        $ultima_op = $lista_op[0]->proposta + 1;
        $busca_tecnicos = json_encode(funcionario::where('tipo', 'Tecnico')->get());
        $lista_tecnicos = json_decode($busca_tecnicos);
        $busca_comercial = json_encode(funcionario::where('tipo', 'Comercial')->get());
        $lista_comercial = json_decode($busca_comercial);
        $busca_produtos = json_encode(produto::all('id_produto', 'nome'));
        $lista_produtos = json_decode($busca_produtos);

        return view('cadoportunidade', compact('lista_tecnicos', 'lista_comercial', 'id_conta', 'nome_conta', 'lista_produtos', 'ultima_op'));
    }

    protected function cadastrarop(Request $request)
    {

        $nome_fase_oportunidade = json_encode(fluxo_op::where('ordem', '=', 1)->get());
        $lista_nome_fase_oportunidade = json_decode($nome_fase_oportunidade);
        $oportunidade = new OP();
        $oportunidade->nome = $request->nome;
        $oportunidade->fase_oportunidade = 1;
        $oportunidade->parceiros = json_encode($request->parceiros);
        $oportunidade->nome_fase_oportunidade = $lista_nome_fase_oportunidade[0]->nome;
        $oportunidade->proposta = $request->numero_op;
        $oportunidade->gerente_projeto = $request->gerente_projeto;
        $oportunidade->comissao_parceiro = $request->comissao_parceiro;
        $oportunidade->numero_contrato = $request->numero_contrato;
        $oportunidade->data_prevista_aceite = $request->data_prevista_aceite;
        $oportunidade->data_entrega_proposta = $request->data_entrega_proposta;
        $oportunidade->descricao_tecnica = $request->descricao_tecnica;
        $oportunidade->chance_negocio = $request->chance_negocio;
        $oportunidade->regional = $request->regional;
        $oportunidade->implantador = $request->implantador;
        $oportunidade->vertical = $request->vertical;
        $oportunidade->empresa_resp_fat = $request->empresa_resp_fat;
        $oportunidade->origem_contato = $request->origem_contato;
        $oportunidade->parceiro_venda = $request->parceiro_venda;
        $oportunidade->tipo_parceiro = $request->tipo_parceiro;
        $oportunidade->prospeccao = $request->prospeccao;
        $oportunidade->tipo_treinamento = $request->tipo_treinamento;
        $oportunidade->valor_setup = $request->valor_setup;
        $oportunidade->qta_parcelas = $request->qta_parcelas;
        $oportunidade->numero_contrato_setup = $request->numero_contrato_setup;
        $oportunidade->mensalidade = $request->mensalidade;
        $oportunidade->num_contrato_mensal = $request->num_contrato_mensal;
        $oportunidade->valor_anual = $request->valor_anual;
        $oportunidade->num_contrato_anual = $request->num_contrato_anual;
        $oportunidade->previsao_receita_kbyte = $request->previsao_receita_kbyte;
        $oportunidade->tipo_kbyte = $request->tipo_kbyte;
        $oportunidade->sub_fat = $request->sub_fat;
        $oportunidade->n_nf = $request->n_nf;
        $oportunidade->itens_contrato = $request->itens_contrato;
        $oportunidade->data_fat = $request->data_faturamento;
        $oportunidade->contato_tecnico = $request->contato_tecnico;
        $oportunidade->issue_orcamento = $request->issue_orcamento;
        $oportunidade->issue_projeto = $request->issue_projeto;
        $oportunidade->issue_complementar = $request->issue_complementar;
        $oportunidade->software_house = $request->software_house;
        $oportunidade->analista_implantacao = $request->analista_implantacao;
        $oportunidade->inicio_implantacao = $request->inicio_implantacao;
        $oportunidade->final_implantacao = $request->final_implantacao;
        $oportunidade->previsao_entrega = $request->previsao_entrega;
        $oportunidade->data_disponibilidade = $request->data_disponibilidade;
        $oportunidade->id_conta = $request->id_conta;
        $oportunidade->id_funcionario = $request->gerente_projeto;
        $oportunidade->id_produto = $request->produto;
        $oportunidade->id_op = uniqid();
        $oportunidade->save();

        return $this->consultaop();

    }

    protected function consultaop()
    {
        $dados = json_encode(OP::select('id_op', 'ops.nome_fase_oportunidade', 'ops.nome AS nomeop', 'produtos.nome AS nomeproduto', 'razao_social', 'proposta')
            ->join('contas', 'ops.id_conta', '=', 'contas.id_conta')
            ->join('produtos', 'ops.id_produto', '=', 'produtos.id_produto')
            ->get());
        $produtos = json_encode(produto::select('nome')->get());
        $lista_produtos = json_decode($produtos);
        $lista_dados = json_decode($dados);
        $status = json_encode(fluxo_op::select('nome')->get());
        $lista_status = json_decode($status);

        return view('consultaop', compact('lista_dados', 'lista_produtos', 'lista_status'));
    }

    protected function pesquisarop(Request $request)
    {
        $cnpj = $request->get('cnpj');
        $razao_social = $request->get('razao_social');
        $produto = $request->get('produto');
        $nomeop = $request->get('nomeop');
        $op = $request->get('op');
        $fase_oportunidade = $request->get('fase_oportunidade');

        $dados = json_encode(\DB::table('ops')
            ->join('contas', 'ops.id_conta', '=', 'contas.id_conta')
            ->join('produtos', 'ops.id_produto', '=', 'produtos.id_produto')
            ->where('produtos.nome', 'ILIKE', '%' . $produto . '%')
            ->where('contas.razao_social', 'ILIKE', '%' . $razao_social . '%')
            ->where('contas.cnpj', 'ILIKE', '%' . $cnpj . '%')
            ->where('ops.nome', 'ILIKE', '%' . $nomeop . '%')
            ->where('ops.proposta', 'ILIKE', '%' . $op . '%')
            ->where('ops.nome_fase_oportunidade', 'ILIKE', '%' . $fase_oportunidade . '%')
            ->select('id_op', 'nome_fase_oportunidade', 'ops.nome AS nomeop', 'produtos.nome AS nomeproduto', 'razao_social', 'proposta')
            ->get());
        $lista_dados = json_decode($dados);
        $produtos = json_encode(produto::select('nome')->get());
        $lista_produtos = json_decode($produtos);
        $status = json_encode(fluxo_op::select('nome')->get());
        $lista_status = json_decode($status);
        return view('consultaop', compact('lista_dados', 'lista_produtos', 'lista_status'));
    }


    protected function acessarop(Request $request)
    {
        $dados = json_encode(OP::where('id_op', $request->id_op)
            ->join('contas', 'ops.id_conta', '=', 'contas.id_conta')
            ->get());
        $lista_dados = json_decode($dados);
        $busca_proxima_etapa = json_encode(fluxo_op::where('ordem', $lista_dados[0]->fase_oportunidade + 1)
            ->orwhere('qualquer_etapa', 'Sim')
            ->get());
        $proxima_etapa = json_decode($busca_proxima_etapa);
        $gerente_projeto = json_encode(funcionario::where('id_funcionario', $lista_dados[0]->gerente_projeto)->get());
        $lista_gerente_projeto = json_decode($gerente_projeto);
        $responsavel_prospeccao = json_encode(funcionario::where('id_funcionario', $lista_dados[0]->prospeccao)->get());
        $lista_responsavel_prospeccao = json_decode($responsavel_prospeccao);
        $analista_implantacao = json_encode(funcionario::where('id_funcionario', $lista_dados[0]->analista_implantacao)->get());
        $lista_analista_implantacao = json_decode($analista_implantacao);
        $lista_parceiros = json_decode($lista_dados[0]->parceiros);
        $produto_atual = json_encode(produto::where('id_produto', $lista_dados[0]->id_produto)->get());
        $lista_produto_atual = json_decode($produto_atual);
        $id_op = $request->id_op;
        $atividades = json_encode(atividade::where('id_op', $id_op)->get());
        $lista_atividades = json_decode($atividades);


        if (is_null($lista_parceiros) === false) {
            $contador_parceiros = count($lista_parceiros);
            $nome_parceiros_array = array();
            $id_parceiros_array = array();
            for ($i = 0; $i < $contador_parceiros; $i++) {
                $nome_parceiros = json_encode(conta::where('id_conta', $lista_parceiros[$i])->get());
                $lista_nome_parceiros = json_decode($nome_parceiros);
                array_push($nome_parceiros_array, $lista_nome_parceiros[0]->razao_social);
                array_push($id_parceiros_array, $lista_nome_parceiros[0]->id_conta);
            }

        } else {
            $nome_parceiros_array = array('Sem Parceiro');
            $id_parceiros_array = array('0');
        }
        if ($request->acao === 'acessar') {
            $anexos=glob('../storage/app/anexos/'.$id_op.'/*');
            return view('acessarop', compact('lista_dados', 'proxima_etapa', 'lista_responsavel_prospeccao', 'lista_gerente_projeto', 'lista_analista_implantacao', 'nome_parceiros_array', 'lista_produto_atual', 'id_op', 'lista_atividades','anexos'));

        }
        if ($request->acao === 'editar') {
            $busca_produtos = json_encode(produto::all('id_produto', 'nome'));
            $lista_produtos = json_decode($busca_produtos);
            $busca_tecnicos = json_encode(funcionario::where('tipo', 'Tecnico')->get());
            $lista_tecnicos = json_decode($busca_tecnicos);
            $busca_comercial = json_encode(funcionario::where('tipo', 'Comercial')->get());
            $lista_comercial = json_decode($busca_comercial);

            return view('editaop', compact('lista_dados', 'proxima_etapa', 'lista_responsavel_prospeccao', 'lista_gerente_projeto', 'lista_analista_implantacao', 'nome_parceiros_array', 'lista_produtos', 'lista_tecnicos', 'lista_comercial', 'id_parceiros_array', 'lista_produto_atual', 'id_op'));
        }
    }

    protected function cadetapa(Request $request)
    {

        if ($request->qualquer_etapa == 'Sim') {
            $ordem = '';
        } else {
            $ordem = $request->ordem;
        }

        $fluxo_op = new fluxo_op();
        $fluxo_op->id_fluxo_op = uniqid();
        $fluxo_op->nome = $request->nome;
        $fluxo_op->ordem = $ordem;
        $fluxo_op->qualquer_etapa = $request->qualquer_etapa;
        $fluxo_op->save();

        return $this->consultafluxoop();
    }

    protected function consultafluxoop()
    {
        $dados = json_encode(fluxo_op::orderby('ordem', 'asc')->get());
        $lista_dados = json_decode(($dados));

        return view('consultafluxoop', compact('lista_dados'));
    }

    protected function editaetapa(Request $request)
    {
        $dados = json_encode(fluxo_op::where('id_fluxo_op', $request->id_fluxo_op)->get());
        $lista_dados = json_decode($dados);

        return view('editafluxoop', compact('lista_dados'));
    }

    protected function atualizaetapafluxoop(Request $request)
    {
        if ($request->qualquer_etapa == 'Sim') {
            $ordem = 0;
        } else {
            $ordem = $request->ordem;
        }

        $etapa = fluxo_op::find($request->id_fluxo_op);
        $etapa->nome = $request->nome;
        $etapa->ordem = $ordem;
        $etapa->qualquer_etapa = $request->qualquer_etapa;
        $etapa->save();

        return $this->consultafluxoop();
    }

    protected function pesquisaetapa(Request $request)
    {
        $dados = json_encode(fluxo_op::where('nome', 'ILIKE', '%' . $request->nome . '%')->get());
        $lista_dados = json_decode($dados);

        return view('consultafluxoop', compact('lista_dados'));
    }

    protected function atualizaetapaop(Request $request)
    {
        $op = OP::find($request->get('id_op'));
        $op->fase_oportunidade = $request->get('nova_etapa_ordem');
        $op->nome_fase_oportunidade = $request->get('nova_etapa_nome');
        $op->save();
    }

    protected function excluir_registro(Request $request)
    {
        if ($request->tabela == 'contato') {
            contato::where('id_contato', $request->id_registro)->delete();
        }
        if ($request->tabela == 'ops') {
            OP::where('id_op', $request->id_registro)->delete();
        }
        if ($request->tabela == 'fluxo_op') {
            fluxo_op::where('id_fluxo_op', $request->id_registro)->delete();
        }
        if ($request->tabela == 'funcionario') {
            funcionario::where('id_funcionario', $request->id_registro)->delete();
        }
        if ($request->tabela == 'produto') {
            produto::where('id_produto', $request->id_registro)->delete();
        }
        if ($request->tabela == 'atividade') {
            atividade::where('id_atividades', $request->id_registro)->delete();
        }
    }

    protected function pesquisaparceiroop(Request $request)
    {
        $cnpj = $request->cnpj;
        $razao_social = $request->razao_social;
        $dados = json_encode(conta::where('razao_social', 'ILIKE', '%' . $razao_social . '%')->where('cnpj', 'ILIKE', '%' . $cnpj . '%')->get());
        $lista_dados = json_decode($dados);
        return response()->json($lista_dados);

    }

    protected function atualizaop(Request $request)
    {

        $oportunidade = OP::find($request->id_op);
        $oportunidade->nome = $request->nome;
        $oportunidade->parceiros = json_encode($request->parceiros);
        $oportunidade->proposta = $request->numero_op;
        $oportunidade->gerente_projeto = $request->gerente_projeto;
        $oportunidade->comissao_parceiro = $request->comissao_parceiro;
        $oportunidade->numero_contrato = $request->numero_contrato;
        $oportunidade->data_prevista_aceite = $request->data_prevista_aceite;
        $oportunidade->data_entrega_proposta = $request->data_entrega_proposta;
        $oportunidade->descricao_tecnica = $request->descricao_tecnica;
        $oportunidade->chance_negocio = $request->chance_negocio;
        $oportunidade->regional = $request->regional;
        $oportunidade->implantador = $request->implantador;
        $oportunidade->vertical = $request->vertical;
        $oportunidade->empresa_resp_fat = $request->empresa_resp_fat;
        $oportunidade->origem_contato = $request->origem_contato;
        $oportunidade->parceiro_venda = $request->parceiro_venda;
        $oportunidade->tipo_parceiro = $request->tipo_parceiro;
        $oportunidade->prospeccao = $request->prospeccao;
        $oportunidade->tipo_treinamento = $request->tipo_treinamento;
        $oportunidade->valor_setup = $request->valor_setup;
        $oportunidade->qta_parcelas = $request->qta_parcelas;
        $oportunidade->numero_contrato_setup = $request->numero_contrato_setup;
        $oportunidade->mensalidade = $request->mensalidade;
        $oportunidade->num_contrato_mensal = $request->num_contrato_mensal;
        $oportunidade->valor_anual = $request->valor_anual;
        $oportunidade->num_contrato_anual = $request->num_contrato_anual;
        $oportunidade->previsao_receita_kbyte = $request->previsao_receita_kbyte;
        $oportunidade->tipo_kbyte = $request->tipo_kbyte;
        $oportunidade->sub_fat = $request->sub_fat;
        $oportunidade->n_nf = $request->n_nf;
        $oportunidade->itens_contrato = $request->itens_contrato;
        $oportunidade->data_fat = $request->data_faturamento;
        $oportunidade->contato_tecnico = $request->contato_tecnico;
        $oportunidade->issue_orcamento = $request->issue_orcamento;
        $oportunidade->issue_projeto = $request->issue_projeto;
        $oportunidade->issue_complementar = $request->issue_complementar;
        $oportunidade->software_house = $request->software_house;
        $oportunidade->analista_implantacao = $request->analista_implantacao;
        $oportunidade->inicio_implantacao = $request->inicio_implantacao;
        $oportunidade->final_implantacao = $request->final_implantacao;
        $oportunidade->previsao_entrega = $request->previsao_entrega;
        $oportunidade->data_disponibilidade = $request->data_disponibilidade;
        $oportunidade->id_conta = $request->id_conta;
        $oportunidade->id_funcionario = $request->gerente_projeto;
        $oportunidade->id_produto = $request->produto;
        $oportunidade->save();

        return $this->retornarop($request->id_op);
    }

    protected function novaatividade(Request $request)
    {
        $id_op = $request->id_op;
        $funcionarios = json_encode(funcionario::all());
        $lista_funcionario = json_decode($funcionarios);
        $proposta = $request->proposta;

        return view('cadatividade', compact('id_op', 'lista_funcionario', 'proposta'));
    }

    protected function cadatividade(Request $request)
    {
        $atividade = new atividade();
        $atividade->id_atividades = uniqid();
        $atividade->nome = $request->nome;
        $atividade->descricao = $request->descricao;
        $atividade->responsavel = $request->responsavel;
        $atividade->id_op = $request->id_op;
        $atividade->proposta = $request->proposta;
        $atividade->status = 'Iniciada';
        $atividade->save();

        return $this->retornarop($request->id_op);
    }

    protected function editaatividade(Request $request)
    {

        $proposta = $request->proposta;
        $atividade = json_encode(atividade::find($request->id_atividade)->get());
        $lista_atividade = json_decode($atividade);
        $funcionarios = json_encode(funcionario::all());
        $lista_funcionario = json_decode($funcionarios);
        $id_atividade = $request->id_atividade;

        return view('editaatividade', compact('lista_funcionario', 'lista_atividade', 'proposta', 'id_atividade'));

    }

    protected function atualizaatividade(Request $request)
    {
        $atividade = atividade::find($request->id_atividade);
        $atividade->nome = $request->nome;
        $atividade->descricao = $request->descricao;
        $atividade->responsavel = $request->responsavel;
        $atividade->status = $request->status;
        $atividade->save();

        return $this->consultaop();
    }

    protected function consultaatividades()
    {
        $atividades = json_encode(atividade::select('atividades.nome AS nome_atividade', 'status', 'responsavel', 'atividades.proposta', 'atividades.created_at AS atividade_criada', 'ops.nome as nome_op', 'id_atividades', 'atividades.id_op as id_op_atividade')
            ->join('ops', 'atividades.id_op', '=', 'ops.id_op')->get());
        $lista_atividades = json_decode($atividades);
        $funcionarios = json_encode(funcionario::all());
        $lista_funcionario = json_decode($funcionarios);

        return view('consultaatividades', compact('lista_atividades', 'lista_funcionario'));
    }

    protected function pesquisaatividade(Request $request)
    {
        $nome = $request->nome;
        $n_op = $request->n_op;
        $status = $request->status;
        $responsavel = $request->responsavel;
        $atividades = json_encode(atividade::select('atividades.nome AS nome_atividade', 'status', 'responsavel', 'atividades.proposta', 'atividades.created_at AS atividade_criada', 'ops.nome as nome_op', 'id_atividades', 'atividades.id_op as id_op_atividade')
            ->join('ops', 'atividades.id_op', 'ILIKE', 'ops.id_op')
            ->where('atividades.nome', 'ILIKE', '%' . $nome . '%')
            ->where('atividades.proposta', 'ILIKE', $n_op)
            ->where('atividades.status', 'ILIKE', $status)
            ->where('responsavel', 'ILIKE', $responsavel)->get());
        $lista_atividades = json_decode($atividades);
        $funcionarios = json_encode(funcionario::all());
        $lista_funcionario = json_decode($funcionarios);

        return view('consultaatividades', compact('lista_atividades', 'lista_funcionario'));

    }

    public function anexar(Request $request)
    {
        $file=$request->file('anexo');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('/'.$request->id_registro.'/', $fileName);
        if ($request->tipo_registro==='OP') {
            return $this->retornarop($request->id_registro);
        }
        if ($request->tipo_registro==='conta'){
            return $this->retornarempresa($request->id_registro);
        }
    }

    protected function retornarop($id_op){
        $dados = json_encode(OP::where('id_op', $id_op)
            ->join('contas', 'ops.id_conta', '=', 'contas.id_conta')
            ->get());
        $lista_dados = json_decode($dados);
        $busca_proxima_etapa = json_encode(fluxo_op::where('ordem', $lista_dados[0]->fase_oportunidade + 1)
            ->orwhere('qualquer_etapa', 'Sim')
            ->get());
        $proxima_etapa = json_decode($busca_proxima_etapa);
        $gerente_projeto = json_encode(funcionario::where('id_funcionario', $lista_dados[0]->gerente_projeto)->get());
        $lista_gerente_projeto = json_decode($gerente_projeto);
        $responsavel_prospeccao = json_encode(funcionario::where('id_funcionario', $lista_dados[0]->prospeccao)->get());
        $lista_responsavel_prospeccao = json_decode($responsavel_prospeccao);
        $analista_implantacao = json_encode(funcionario::where('id_funcionario', $lista_dados[0]->analista_implantacao)->get());
        $lista_analista_implantacao = json_decode($analista_implantacao);
        $lista_parceiros = json_decode($lista_dados[0]->parceiros);
        $produto_atual = json_encode(produto::where('id_produto', $lista_dados[0]->id_produto)->get());
        $lista_produto_atual = json_decode($produto_atual);
        $atividades = json_encode(atividade::where('id_op', $id_op)->get());
        $lista_atividades = json_decode($atividades);


        if (is_null($lista_parceiros) === false) {
            $contador_parceiros = count($lista_parceiros);
            $nome_parceiros_array = array();
            $id_parceiros_array = array();
            for ($i = 0; $i < $contador_parceiros; $i++) {
                $nome_parceiros = json_encode(conta::where('id_conta', $lista_parceiros[$i])->get());
                $lista_nome_parceiros = json_decode($nome_parceiros);
                array_push($nome_parceiros_array, $lista_nome_parceiros[0]->razao_social);
                array_push($id_parceiros_array, $lista_nome_parceiros[0]->id_conta);
            }

        } else {
            $nome_parceiros_array = array('Sem Parceiro');
            $id_parceiros_array = array('0');
        }
        $anexos=glob('../storage/app/anexos/'.$id_op.'/*');


            return view('acessarop', compact('lista_dados', 'proxima_etapa', 'lista_responsavel_prospeccao', 'lista_gerente_projeto', 'lista_analista_implantacao', 'nome_parceiros_array', 'lista_produto_atual', 'id_op', 'lista_atividades','anexos'));
    }

    protected function baixararquivo (Request $request){
        $nome_arquivo=$request->nome_arquivo;
        $id_registro=$request->id_registro;

        return Storage::download('/'.$id_registro.'/'.$nome_arquivo);
    }

    protected function retornarempresa($id_conta){

        $dados = json_encode(conta::where('id_conta', $id_conta)->get());
        $lista_dados = json_decode($dados);

        $dados_contato = json_encode(contato::where('id_conta', $id_conta)->get());
        $lista_dados_contato = json_decode($dados_contato);

        $dados_op = json_encode(OP::where('id_conta', $id_conta)->get());
        $lista_dados_op = json_decode($dados_op);
        $anexos=glob('../storage/app/anexos/'.$id_conta.'/*');

        return view("acessarempresa", compact("lista_dados", "lista_dados_contato", "lista_dados_op","anexos"));

    }
}
