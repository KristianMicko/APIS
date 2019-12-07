<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/skuska', function (){
    $value = DB::select("SELECT Miestnost.id as ID, Miestnost.label as Miestnosti, Regal.label as Regale, Miesto.label as Miesta, Polozka.nazov as Polozka, Polozka.nakupna_cena as Nakupna_cena, Polozka.predajna_cena as Predajna_cena, Polozka.balenie as Balenie, Polozka.mnozstvo as Mnozstvo,Vlastnost.nazov as Vlastnosti, Vlastnost.popis as Popis from Miestnost inner JOIN Regal on Miestnost.id = Regal.id_miestnost inner join Miesto on Regal.id = Miesto.id_regal inner join Polozka on Miesto.id = Polozka.id_miesto left join Vlastnost on Vlastnost.id_polozka = Polozka.id");
    return response()->json($value,200);
});

/*Route::get('/Miestnost', function (){
    $value = DB::select("SELECT Miestnost.id as ID, Miestnost.label as Miestnosti, Regal.label as Regale, Miesto.label as Miesta, Polozka.nazov as Polozka, Polozka.nakupna_cena as Nakupna_cena, Polozka.predajna_cena as Predajna_cena, Polozka.balenie as Balenie, Polozka.mnozstvo as Mnozstvo,Vlastnost.nazov as Vlastnosti, Vlastnost.popis as Popis from Miestnost inner JOIN Regal on Miestnost.id = Regal.id_miestnost inner join Miesto on Regal.id = Miesto.id_regal inner join Polozka on Miesto.id = Polozka.id_miesto left join Vlastnost on Vlastnost.id_polozka = Polozka.id");
    return response()->json($value,200);
});*/

Route::get('/Miestnost/{id}', function ($id){
    $value = DB::select("SELECT *FROM Miestnost where id=".$id);
    return response()->json($value,200);

});

Route::post('/Miestnost/',function (Request $request){
    DB::insert("INSERT into Miestnost(label) values(?)",[$request['label']]);
    return response()->json("Nahravka bola uspesne vytvorena ",201);
});

Route::put('/Miestnost/{id}', function ($id,Request $request){
    $value = DB::update("UPDATE Miestnost set label=? where id= ?",[$request['label'],$id]);
    return response()->json("Nahravka bola uspesne prepisana",200);
});

Route::delete('/Miestnost/{id}', function ($id){
    DB::delete("DELETE FROM Miestnost where id=?", [$id]);
    return response()->json("Nahravka bola uspesne vymazana",204);
});