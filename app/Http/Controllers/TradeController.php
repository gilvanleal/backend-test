<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Survivor;
use App\Recourse;

class TradeController extends Controller
{
    //
    public function store(Request $request, Survivor $survivor1, Survivor $survivor2)
    {
        if($survivor1 == $survivor2 | $survivor1->is_infected | $survivor2->is_infected ){
            return response()->json("Traders equals or infetected", 406);
        }
        $survivors = [$survivor1->id => $survivor1, $survivor2->id => $survivor2];
        $recourse_paramns = $request->input('recourses', [[]]);
        DB::beginTransaction();
        $point_backup = null;
        $msg = ['msg'=> "Trade Sucesso", 'code' => 200];
        foreach ($recourse_paramns as $key => $value) {
            $flag = -1;
            $items = array_column($value, 'item_id');
            $recources = $survivors[$key]->recourses()->whereIn('item_id', $items)->get()->keyBy('item_id');
            if($recources->count() != count($items)){
                $msg = ['msg'=> "Item indisponível", 'code' => 406];
                break;
            }
            $points = 0;
            foreach ($value as $r)
            {                  
                if($recources[$r['item_id']]->amount >= $r['amount']){
                    $points +=  $recources[$r['item_id']]->item_point * $r['amount'];
                    }
                else{
                    $points = -1;
                    break;
                }
                $recourse_array1 = $recourse_array2 = ['item_id'=> $r['item_id']];
                if ($key == $survivor1->id){
                    $recourse_array1['survivor_id'] = $survivor1->id;
                    $recourse_array2['survivor_id'] = $survivor2->id;
                }
                else if ($key == $survivor2->id){
                    $recourse_array1['survivor_id'] = $survivor2->id;
                    $recourse_array2['survivor_id'] = $survivor1->id;
                }else{
                    $points = -2;
                    break;
                }
                    $recourse1 = Recourse::updateOrCreate($recourse_array1);
                    $recourse1->amount -= $r['amount'];
                    $recourse1->save();
                    $recourse2 = Recourse::updateOrCreate($recourse_array2);
                    $recourse2->amount += $r['amount'];
                    $recourse2->save();            
            }
            if($points == -1)
            {
                $msg = ['msg'=> "Um ou mais Itens etão sem estoque ou em quantidade insuficiente.", 'code' => 406];
                break;
            }
            if($points < -2){
                $msg = ['msg'=> "Id Survivor não corresponde ao da lista de recursos", 'code' => 406];
                break;
            }
            if($point_backup != null & $point_backup != $points){
                $msg = ['msg'=> "Troca não realizada. Diferença de pontos: ".abs($point_backup - $points), 'code' => 406];
                break;
            }
            $point_backup = $points;

        }
        if ($msg['code'] == 406){
            DB::rollBack();
        }else{
            DB::commit();
        }
        return response()->json($msg['msg'], $msg['code']);
    }
}
