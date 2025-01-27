<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Survivor;
use App\Recourse;
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
        $validatedData = $request->validate(Survivor::createRules());
        $result = DB::transaction(
            function() use ($validatedData){
                try{
                    $survivor = Survivor::create($validatedData);
                    $survivor->recourses()->createMany($validatedData['recourses']);
                    $survivor->save();
                    return response()->json(new SurvivorResource($survivor), 201);
                }catch(\Excpetion $e){
                    return response()->json($e->getMessage(), 402);
                }
        });
        return $result;
    }

    public function update(Request $request, Survivor $survivor)
    {
        $validatedData = $request->validate(Survivor::$updateRules);
        if(!$survivor->is_infected){
            $survivor->update($validatedData);
            return response()->json($survivor, 200);
        }else{
            return response()->json("Não atualizado", 406);
        }
        
    }

    public function delete(Request $request, Survivor $survivor)
    {
        $survivor->delete();
        return response()->json(null, 204);
    }

    public function report_contamination(Request $request, $report, $reported){
        if($report == $reported){
            return response()->json('Report and Reported are equals', 406);
        }

        $result = DB::transaction(
            function() use($report, $reported){
                try{
                    //$report_s = Survivor::find($report);
                    $reported_s = Survivor::find($reported);
                    $reported_s->reporteds()->attach($report);
                    // $reported_s->save();
                    return response()->json(['name' => $reported_s->name, 'votes' => $reported_s->reporteds->count()], 200);
                }
                catch(\Illuminate\Database\QueryException $e)
                {
                    return response()->json(['Repoted votes is unique per survivors. Vote not computed!.'], 402);
                }
                catch(\Excpetion $e){
                    return response()->json([$e->getMessage()], 501);
                }
        }); 
        return $result;    
    }

    public function update_location(Request $request, Survivor $survivor){
        $survivor->latitude = $request->input('latitude');
        $survivor->longitude = $request->input('longitude');
        $survivor->save();
        return response()->json($survivor, 200);
    }
}
