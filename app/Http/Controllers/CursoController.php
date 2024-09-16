<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Models\Eixo;

class CursoController extends Controller
{
    
    public function index(){
        $data = Curso::with(['eixo'])->get();
        return view('curso.index', compact('data'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function index()
    
        //
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eixos = Eixo::orderBy('name')->get();
        return view('curso.create', compact('eixos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $eixo = Eixo::find($request->eixo);

        if(isset($eixo)){
         
            $curso = new Curso();
            $curso->nome = mb_strtoupper($request->nome, 'UTF-8');
            $curso->abreviatura = mb_strtoupper($request->abreviatura, 'UTF-8');
            $curso->duracao = $request->duracao;
            $curso->eixo()->associate($eixo);
            $curso->save();
        
            return redirect()->route('curso.index');
        }

        return "<h1>Eixo não encontrado!!</h1>";

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::with('eixo')->find($id);

        if(isset($curso)){
            return view('curso.show', compact('curso'));
        }
        return "<h1>Curso não encontrado!!</h1>";

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Curso::find($id);
        $eixos = Eixo::orderBy('name')->get();

        if(isset($eixo)){
            return view('curso.edit', compact(['curso', 'eixos']));
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $curso = Curso::find($id);
        $eixo = Eixo::find($request->eixo);

        if(isset($eixo) && isset($curso)){
            $curso->nome = mb_strtoupper($request->nome, 'UTF-8');
            $curso->abreviatura = mb_strtoupper($request->abreviatura, 'UTF-8');
            $curso->duracao = $request->duracao;
            $curso->eixo()->associate($eixo);
            $curso->save();
        
            return redirect()->route('curso.index');
        }

        return "<h1>Eixo não encontrado!!</h1>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Curso::destroy($id)){
            return redirect()->route('curso.index');
        }
        return "<h1>Curso não deletado!!</h1>";
    }
}

