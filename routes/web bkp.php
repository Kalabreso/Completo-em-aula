<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/', 
    function () {
        return view('welcome');
});

Route::get('/cliente/{total}',  function ($total) {
   

    $dados = array(
        "Daniela",
        "Felipe",
        "Guilherme",

    );    

    $msg = "<ul>";

    if($total <= count($dados)){
        $cont = 0;
        $cont = 0;
        //for($cont=0; $cont<$total; $cont++){
        foreach($dados as $item){
            $msg = $msg . "<li>$item</li>";
            $cont++;
            if($cont == $total) break;
        }
    }else{
        $msg = $msg . "<li>Tamanho máximo  = " . count($dados);
    }

    $msg = $msg . "</ul>";
    //dd($msg);
  

    

    return $msg;
});

///Lista de Clientes: $total</hl>

Route::get('/alunos/{total}/{nome?}',  
    function ($total, $nome= " João") {
    return "OK" . $nome;
}
)->where('total', '[0-9]+')->where('nome', '[A-Za-z]+');

Route::prefix('prova')->group(function(){

    Route::get('/', function () {
        return view('prova.lista');
    })->name('prova');

    Route::get('/aprovar', function () {
        return view('prova.aprovar');
    })->name('prova.aprovar');

    Route::get('/recuperar', function () {
        return view('prova.recuperar');
    })->name('prova.recuperar');

    Route::get('/reprovar', function () {
        return view('prova.reprovar');
        })->name('prova.reprovar');
    

});


///
 //  ///Route::ger('/agendar', function () {
    //return "Agendar COnsulta";
   

/// Só usei para marcar daqui pra frente prode apagar 

///<?php

//use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/', 
    function () {
        return view('welcome');
});

Route::get('/cliente/{total}',  function ($total) {
   

    $dados = array(
        "Daniela",
        "Felipe",
        "Guilherme",

    );    

    $msg = "<ul>";

    if($total <= count($dados)){
        $cont = 0;
        $cont = 0;
        //for($cont=0; $cont<$total; $cont++){
        foreach($dados as $item){
            $msg = $msg . "<li>$item</li>";
            $cont++;
            if($cont == $total) break;
        }
    }else{
        $msg = $msg . "<li>Tamanho máximo  = " . count($dados);
    }

    $msg = $msg . "</ul>";
    //dd($msg);
  

    

    return $msg;
});

///Lista de Clientes: $total</hl>

Route::get('/alunos/{total}/{nome?}',  
    function ($total, $nome= " João") {
    return "OK" . $nome;
}
)->where('total', '[0-9]+')->where('nome', '[A-Za-z]+');

Route::prefix('consulta')->group(function(){

    Route::get('/', function () {
        return view('consulta.lista');
    })->name('consulta');

    Route::get('/agendar', function () {
        return view('consulta.agendar');
    })->name('consulta.agendar');

    Route::get('/cancelar', function () {
        return view('consulta.cancelar');
        })->name('consulta.cancelar');
    

});


///
 //  ///Route::ger('/agendar', function () {
    //return "Agendar COnsulta";