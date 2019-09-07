<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recourse;
use App\Http\Resources\RecourseCollection;
use App\Http\Resources\Recourse as RecourseResource;


class RecourseController extends Controller
{
    //
    public function index()
    {
        return new RecourseCollection(Recourse::all());
    }

    public function show(Request $request, Recourse $recourse)
    {
        return new RecourseResource($recourse);
    }

    public function store(Request $request)
    {
        $recourse = Recourse::create($request->all());
        return response()->json($recourse, 201);
    }

    public function update(Request $request, Recourse $recourse)
    {
        $recourse->update($request->all());
        return response()->json($recourse, 200);
    }

    public function delete(Request $request, Recourse $recourse)
    {
        $recourse->delete();
        return response()->json(null, 204);
    }
}
