<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\operation;
use Illuminate\Support\Facades\DB;

class operationController extends Controller
{

    public function create(){

        return View("operation.create");
    
    }

    
    public function index(){

        $op=DB::table('operations')
        ->select('id','modif', 'type', 'montant', 'date','status','status2') // Remplacez par vos colonnes spécifiques
        ->get();

        return View("operation.index",["val"=>$op]);
    
    }

    public function terminer($id){

         // Mettre à jour le statut d'une opération spécifique (par exemple, `status = 1`)
         DB::table('operations')
         ->where('id', $id) // Filtrer par l'ID passé en paramètre
         ->update(['status2' => 1]); // Mise à jour du champ `status`

     // Récupérer toutes les opérations après mise à jour
     $op = DB::table('operations')
         ->select('id', 'modif', 'type', 'montant', 'date', 'status','status2') // Colonnes spécifiques
         ->get();

     // Retourner la vue avec les données mises à jour
     return redirect()->route("operation.index");

    }
   

    public function save(Request $request){

        if($request->input("type_propriete")=="-1"){
            operation::create([
            "modif"=>$request->input("motif"),
            "montant"=>$request->input("montant"),
            "status"=>0,
            "status2"=>0,
            "date"=>date('Y-m-d')]);

        }else{
            operation::create(["id_propriete"=>$request->input("contenue"),
            "type"=>$request->input("type_propriete"),
            "modif"=>$request->input("motif"),
            "montant"=>$request->input("montant"),
            "status"=>0,
            "status2"=>0,
            "date"=>date('Y-m-d')]);


        }
     


        return View("operation.create");
    
    }

    
}
