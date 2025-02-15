<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class operationController extends Controller
{
     
    public function index(){

        $op=DB::table('operations')
        ->select('id','modif', 'type', 'montant', 'date','status','status2') // Remplacez par vos colonnes spécifiques
        ->get();

        return View("admin.operation.index",["val"=>$op]);
    
    }


    public function valider($id)
        {
            // Mettre à jour le statut d'une opération spécifique (par exemple, `status = 1`)
                DB::table('operations')
                    ->where('id', $id) // Filtrer par l'ID passé en paramètre
                    ->update(['status' => 1,'status2' => -1]); // Mise à jour du champ `status`

         
                return redirect()->route("admin.operation.index");
                
        }

    public function annuler($id){

                    DB::table('operations')
                    ->where('id', $id) // Filtrer par l'ID passé en paramètre
                    ->update(['status' => -1]); // Mise à jour du champ `status`

            

                // Retourner la vue avec les données mises à jour
                return redirect()->route("admin.operation.index");
    
    }

    
    public function NotificationOperation(){

        $val=  DB::table('operations')
        ->where('status', 0) 
        ->get();

      

        $data = ['message' => 'galerie', 'input' =>$val ];

        return response()->json($data);

    }

    
}
