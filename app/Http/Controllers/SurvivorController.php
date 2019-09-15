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
        $validatedData = $request->validate(Survivor::$createRules);
        $result = DB::transaction(
            function() use($validatedData){
                try{
                    $validateData = $this->validate(request(), Survivor::$createRules);
                    $survivor = Survivor::create($validateData);
                    $survivor->recourses()->createMany($validateData['recourses']);
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
        if(!$survivor->is_infected){
            $survivor->update($request->all());
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

    public function report_contamination(Request $request, Survivor $report, Survivor $reported){
        if($report != $reported)
        {
            try
            {
                $reported->reporteds()->attach($report);
                $reported->save();
                return response()->json(['name' => $reported->name, 'votes' => $reported->reporteds->count()], 200);
            }
            catch(\Illuminate\Database\QueryException $e)
            {
                return response()->json(['Repoted votes is unique per survivors. Vote not computed!.'], 402);
            }
            
        }
        else
        {
            return response()->json('Report and Reported are equals', 406);
        }
       
    }

    public function update_location(Request $request, Survivor $survivor){
        $survivor->latitude = $request->input('latitude');
        $survivor->longitude = $request->input('longitude');
        $survivor->save();
        return response()->json($survivor, 200);
    }
}
