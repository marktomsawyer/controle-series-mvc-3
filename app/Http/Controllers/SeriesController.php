<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    //
    public function index(Request $request)
    {
        //$series = DB::select('select * from series');
        //$series = Serie::All();
        //dd($series);

        //$series = Serie::query()->orderBy('nome')->get();

        $series = Series::with(['seasons'])->get();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        //Serie::create($request->all());
        //$request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!");
        //return redirect('/series');
        //return redirect(route('series.index'));
        //dd($request);

        $serie = Series::create($request->all());

        $seasons = [];
        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i
            ];
        }

        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->seasons as $season) {
            for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j
                ];
            }
        }
        Episode::insert($episodes);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series)
    {
        //dd($request->route());
        //Serie::destroy($request->series);
        //$request->session()->flash('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");

        $series->delete();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");
    }

    public function edit(Series $series)
    {
        return view('series.edit')
            ->with('serie', $series);
    }

    public function update(SeriesFormRequest $request, Series $series)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso!");
    }
}
