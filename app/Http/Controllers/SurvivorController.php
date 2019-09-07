<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Survivor;
use App\Http\Resources\SurvivorCollection;
use App\Http\Resources\Survivor as SurvivorResource;


class SurvivorController extends Controller
{
    //
    public function index()
    {
        return new SurvivorCollection(Survivor::paginate());
    }

    public function show(Request $request, Survivor $survivor)
    {
        return new SurvivorResource($survivor);
    }

    public function store(Request $request)
    {
        $survivor = Survivor::create($request->all());
        $recourses = $request->get('recourses');
        $survivor->recourses()->createMany($recourses);
        $survivor->save();
        return response()->json(new SurvivorResource($survivor), 201);
    }

    public function update(Request $request, Survivor $survivor)
    {
        $survivor->update($request->all());
        return response()->json($survivor, 200);
    }

    public function delete(Request $request, Survivor $survivor)
    {
        $survivor->delete();
        return response()->json(null, 204);
    }

    public function report_contamination(Request $request, Survivor $report, Survivor $reported){
        if($report != $reported)
        {
            $reported->infected += 1;
            $reported->save();
            if($reported->is_infected){
                return response()->json($reported->name.' está infectado(a).', 200);
            }
            return response()->json($reported->name.' votes: '.$reported->infected, 200);
        }
        else
        {
            return response()->json('Report and Reported equals', 406);
        }
       
    }
}
