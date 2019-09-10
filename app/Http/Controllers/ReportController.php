<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Survivor;

class ReportController extends Controller
{
    public function infected_suvivors()
    {
        $zumbis = Survivor::where('infected', '>=', 3)->count();
        $survivor = Survivor::where('infected', '<', 3)->count();
        $total = $survivor + $zumbis;
        $infecteds = ($zumbis/$total) * 100;
        return response()->json(['Percentual infectado.', number_format($infecteds,2).'%'], 200);
    }

    public function non_infected_suvivors()
    {
        $zumbis = Survivor::where('infected', '>=', 3)->count();
        $survivor = Survivor::where('infected', '<', 3)->count();
        $total = $survivor + $zumbis;
        $non_infected = ($survivor/$total) * 100;
        return response()->json(['Percentual não infectado.', number_format($non_infected, 2).'%'], 200);
    }

    public function avg_recourses()
    {
        $items = DB::table('survivors')
        ->select('items.name', 
        DB::raw('sum(recourses.amount) as total'))
        ->join('recourses', 'survivors.id', '=', 'recourses.survivor_id')
        ->join('items', 'items.id', '=', 'recourses.item_id')
        ->where('survivors.infected', '<', 3)
        ->groupBy('items.id')->get();

        $survivor = Survivor::where('infected', '<', 3)->count();
        $items_avg = array();
        foreach ($items as $key => $value) {
            $items_avg[$value->name] = $value->total/$survivor;
        }
        return response()->json(["Média de itens: ", $items_avg], 200);
    }

    public function lost_point()
    {
        $items = DB::table('survivors')
        ->select(DB::raw('sum(items.point * recourses.amount) as points'))
        ->join('recourses', 'survivors.id', '=', 'recourses.survivor_id')
        ->join('items', 'items.id', '=', 'recourses.item_id')
        ->where('survivors.infected', '<', 3)
        ->get();
        return response()->json(['Pontos perdido', $items], 200);
    }
}
