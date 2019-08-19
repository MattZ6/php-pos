<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectViewController extends Controller
{
  public function index()
  {
   $listaMigalhas=json_encode( [
      ["titulo"=>"Home","url"=>route('home')],
      ["titulo"=>"Lista de Projetos","url"=>""]

   ]);

  $listaDados=json_encode( Project::select('id','name','description' )->get());

 return view('Projects.index',compact('listaMigalhas','listaDados'));
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data=$request->all();
        //validação
        $validacao = \Validator::make($data,[
            "name"=> "required",
            "description" => "required"
        ]);

        /* O teste para validar os campos e voltar mostrando os erros
        e os campos ja preenchindos  com o withInput e o helper old */
        if($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();
        }

        Project::create($data);

       return redirect()->back();

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return Project::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      $data = $request->all();
      $validacao = \Validator::make($data,[
        "name" => "required",
        "description" => "required"

      ]);

      if($validacao->fails()){
        return redirect()->back()->withErrors($validacao)->withInput();
      }

      Project::find($id)->update($data);
      return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Project::find($id)->delete();
      return redirect()->back();
    }
}
