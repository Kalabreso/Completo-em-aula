<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;
use App\Models\Curso;
use Dompdf\Dompdf;

class EixoController extends Controller
{
    private $regras = [
        'name' => 'required|max:20|min:3',
        'description' => 'required|max:300|min:10',
        
    ];
    
    private $msgs = [
        "required" => "O preenchimento do campo [:attribute] é obrigatório!",
        "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
        "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        "unique" => "Já existe um endereço cadastrado com esse [:attribute]!"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Eixo::with('curso')->get();
        
        
        return view('eixo.index', compact(['data']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eixo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->regras, $this->msgs);
        
        $eixo = new Eixo();
            $eixo->name = $request->name;
            $eixo->description = $request->description;
        $eixo->save();
        
        return redirect()->route('eixo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $eixo = Eixo::find($id);

        if(isset($eixo)){
            return view('eixo.show', compact('eixo'));
        }

        return "<h1>Eixo não encontrado</h1>";

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eixo = Eixo::find($id);

        if(isset($eixo)){
            return view('eixo.edit', compact('eixo'));
        }

        return "<h1>Eixo não encontrado</h1>";
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
       $eixo = Eixo::find($id);

       if(isset($eixo)){

        $eixo->name = $request->name;
        $eixo->description = $request->description;
        $eixo->save();
        return redirect()->route('eixo.index');

       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eixo = Eixo::find($id);

        if(isset($eixo)){
            $eixo->delete();
            return redirect()->route('eixo.index');


        }
        return "<h1>Eixo não encontrado</h1>";

        
        return $id;
    }
    public function report($id){

        $cursos = Curso::where('eixo_id', $id)->get();
        
        // Instancia um Objeto da Classe Dompdf
        $dompdf = new Dompdf();
        // Carrega o HTML
        $dompdf->loadHtml(view('eixo.report', compact('cursos')));
        // (Opcional) Configura o Tamanho e Orientação da Página
        $dompdf->setPaper('A4', 'landscape');
        // Converte o HTML em PDF
        $dompdf->render();
        // Serializa o PDF para Navegador
        $dompdf->stream("relatorio-horas-turma.pdf", array("Attachment" => false));
    }

    public function graph(){
        
        $eixos = Eixo::with('curso')->orderBy('name')->get();

      

       $data = [
        ["EIXO", "NÚMERO DE CURSOS"]
       ];

       $cont = 1;
       foreach($eixos as $item){
            $data[$cont] = [
                $item->name, count($item->curso)
            ];
        $cont++;
       }    
    

        //dd($eixos);
        $data = json_encode($data);
           
            return view('eixo.graph', compact(['data']));
    }
}
