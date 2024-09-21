<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Votacoes\Questoes;
use App\Models\Votacoes\Respostas;
use App\Models\Votacoes\Sufragios;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use stdClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin');
    }

    public function resultados()
    {
        return view('resultados');
    }

    public function gerenciador()
    {
        return view('gerenciador');
    }

    public function votacao(?int $id = null)
    {
        if(empty($id)){
            $sufragio = new stdClass;
        }else{
            $sufragio = Sufragios::findOrfail($id);
            if(new Carbon($sufragio->inicio) <= now() || new Carbon($sufragio->fim) <= now()){
                return abort('403', 'Votação em andamento');
            }
        }

        return view(
            'formVotacao',
            [
                'votacao' => $sufragio,
                'ufs' => Estado::all()
            ]
        );
    }

    public function arquivos(int|string $sufragioId)
    {
        $sufragio = Sufragios::findOrfail($sufragioId);
        if(new Carbon($sufragio->inicio) <= now() || new Carbon($sufragio->fim) <= now()){
            return abort('403', 'Votação em andamento');
        }
        return view(
            'formArquivos',
            [
                'votacao' => $sufragio,
            ]
        );
    }

    public function questoes(int $sufragioId, int $id = null)
    {
        $sufragio = Sufragios::findOrfail($sufragioId);
        if(new Carbon($sufragio->inicio) <= now() || new Carbon($sufragio->fim) <= now()){
            return abort('403', 'Votação em andamento');
        }
        $questao = !empty($id)
            ? Questoes::where([
                    'id' => $id,
                    'sufragioId' => $sufragioId,
                ])
                ->firstOrFail()
            : new stdClass;
        return view(
            'formQuestoes',
            [
                'votacao' => $sufragio,
                'questao' => $questao,
            ]
        );
    }

    public function respostas(int $sufragioId, int $questaoId, ?int $id = null)
    {
        $sufragio = Sufragios::findOrfail($sufragioId);
        $questao = Questoes::findOrfail($questaoId);
        if(new Carbon($sufragio->inicio) <= now() || new Carbon($sufragio->fim) <= now()){
            return abort('403', 'Votação em andamento');
        }

        $resposta = !empty($id)
            ? Respostas::where([
                    'id' => $id,
                    'questaoId' => $questaoId,
                ])
                ->firstOrFail()
            : new stdClass;

        return view(
            'formRespostas',
            [
                'votacao' => $sufragio,
                'questao' => $questao,
                'resposta' => $resposta,
            ]
        );
    }

    public function relatorio()
    {
        return view(
            'A4.Portrait.Relatorio',
            [
                'sufragio' => Sufragios::find(2)
            ]
        );
    }

}
