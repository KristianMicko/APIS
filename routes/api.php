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

Route::get('/Miestnost', function (){
    $value = DB::select("SELECT *FROM Miestnost");
    return response()->json($value,200);
});

Route::get('/Miestnost/{id}', function ($id){
    $value = DB::select("SELECT *FROM Miestnost where id=".$id);
    return response()->json($value,200);

});

Route::post('/Miestnost/',function (Request $request){
    DB::insert("INSERT into Miestnost(label) values(?)",[$request['label']]);
    return response()->json("Nahravka bola uspesne vytvorena ",201);
});

Route::put('/Miestnost/{id}', function ($id,Request $request){
    DB::update("UPDATE Miestnost set label=? where id= ?",[$request['label'],$id]);
    return response()->json("Nahravka bola uspesne prepisana",200);
});

Route::delete('/Miestnost/{id}', function ($id){
    DB::delete("DELETE FROM Miestnost where id=?", [$id]);
    return response()->json("Nahravka bola uspesne vymazana",204);
});

Route::get('/Regal',function (){
    $value=DB::select("SELECT *FROM Regal");
    return response()->json($value,200);
});

Route::get('/Regal/{id}', function ($id){
    $value = DB::select("SELECT *FROM Regal where id=?",[$id]);
    return response()->json($value,200);
});

Route::post('/Regal', function (Request $request){
    DB::insert("INSERT INTO Regal(label,id_miestnost)VALUES(?,?)",[$request['regal'],$request['id_miestnost']]);
    return response()->json("Nahravka bola uspesne vytvorena",201);
});

Route::put('/Regal/{id}',function ($id,Request $request){
    DB::update("UPDATE Regal set label=?, id_miestnost=? where id= ?",[$request['regal'],$request['id_miestnost'],$id]);
    return response()->json("Nahravka bola uspesne prepisana",200);
});

Route::delete('/Regal/{id}',function ($id){
    DB::delete("DELETE FROM Regal where id=?",[$id]);
    return response()->json("Nahravka bola uspesne vymazana",204);
});


Route::get('/Miesto',function (){
    $value = DB::select("SELECT *FROM Miesto");
    return response()->json($value,200);
});

Route::get('/Miesto/{id}',function ($id){
    $value = DB::select("SELECT *FROM Miesto where id = ?",[$id]);
    return response()->json($value,200);
});

Route::post('/Miesto',function (Request $request){
    DB::insert("INSERT INTO Miesto (label, id_regal) values (?,?)",[$request['miesto'],$request['id_regal']]);
    return response()->json("Nahravka bola uspesne vytvorena",201);
});

Route::put('/Miesto/{id}', function ($id,Request $request){
    DB::update("UPDATE Miesto set label=?, id_regal=? where id=?",[$request['miesto'],$request['id_regal'],$id]);
    return response()->json("Nahravka bola uspesne prepisana",200);
});

Route::delete('/Miesto/{id}', function ($id){
    DB::delete("DELETE FROM Miesto where id=?",[$id]);
    return response()->json("Nahravka bola uspesne vymazana",204);
});

Route::get('/Polozka',function (){
    $value = DB::select("SELECT *FROM Polozka");
    return response()->json($value,200);
});

Route::get('/Polozka/{id}', function ($id){
    $value = DB::select("SELECT *FROM Polozka where id=?",[$id]);
    return response()->json($value,200);
});

Route::post('/Polozka',function (Request $request){
    DB::insert("INSERT INTO Polozka(nazov,nakupna_cena,predajna_cena,balenie,mnozstvo,id_miesto,pridana) values(?,?,?,?,?,?,?)",[$request['nazov'],$request['nakupnaCena'],$request['predajnaCena'],
        $request['balenie'],$request['mnozstvo'],$request['id_miesto'],$request['pridana']]);
    return response()->json("Nahravka bola uspesne vytvorena",201);
});

Route::put("/Polozka/{id}",function ($id,Request $request){
    DB::update("UPDATE Polozka set nazov=?,nakupna_cena=?,predajna_cena=?,balenie=?,mnozstvo=?,id_miesto=?,pridana=? where id =?",
        [$request['nazov'],$request['nakupnaCena'],$request['predajnaCena'],
            $request['balenie'],$request['mnozstvo'],$request['id_miesto'],$request['pridana'],$id]);
    return response()->json("Nahravka bola uspesne prepisana", 200);
});

Route::delete('/Polozka/{id}', function ($id){
    DB::delete("DELETE FROM Polozka where id=?", [$id]);
    return response()->json("Nahravka bola uspesne vymazana", 204);
});

Route::get('/Transakcie',function (){
    $value = DB::select("SELECT *FROM Transakcie");
    return response()->json($value,200);
});

Route::get('/Transakcie/{id}', function ($id){
    $value = DB::select("SELECT *FROM Transakcie where id=?",$id);
    return response()->json($value,200);
});

Route::post('/Transakcie', function (Request $request){
    DB::insert("INSERT INTO Transakcie(mnozstvo,typ,id_polozka,datum) values (?,?,?,?)", [$request['mnozstvo'],$request['typ'],
        $request['id_polozka'],$request['datum']]);
    return response()->json("Nahravka bola uspesne vytvorena",201);
});

Route::put('/Transakcie/{id}', function ($id,Request $request){
    DB::update("UPDATE Transakcie set mnozstvo=?,typ=?,id_polozka=?, datum=? where id=?",[$request['mnozstvo'],$request['typ'],
        $request['id_polozka'],$request['datum']]);
    return response()->json("Nahravka bola uspesne prepisana",200);
});

Route::delete('/Transakcie/{id}',function ($id){
    DB::delete("DELETE FROM Transakcie where id=?",[$id]);
    return response()->json("Nahravka bola uspesne vymazana",204);
});

Route::get('/Vlastnost', function (){
    $value = DB::select("SELECT *FROM Vlastnost");
    return response()->json($value, 200);
});

Route::get('/Vlastnost/{id}',function ($id){
    $value = DB::select("SELECT *FROM Vlastnost where id=?",[$id]);
    return response()->json($value,200);
});

Route::post('/Vlastnost',function (Request $request){
    DB::insert("INSERT INTO Vlastnost(nazov,popis,id_polozka) values (?,?,?)",[$request['nazov'],$request['popis'],$request['id_polozka']]);
    return response()->json("Nahravka bola uspesne vytvorena",201);
});

Route::put('/Vlastnost/{id}', function ($id,Request $request){
    DB::update("UPDATE Vlastnost set nazov=?,popis=?,id_polozka=? where id=?",[$request['nazov'],$request['popis'],$request['id_polozka'],$id]);
    return response()->json("Nahravka bola uspesne prepisana",200);
});

Route::delete('/Vlastnost/{id}', function ($id){
    DB::delete("DELETE FROM Vlastnost where id=?",[$id]);
    return response()->json("Nahravka bola uspesne vymazana",204);
});