<?php

namespace App\Http\Controllers;

use App\models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskViewController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $listaMigalhas = json_encode([
      ["titulo" => "Home", "url" => route('home')],
      ["titulo" => "Lista de Tasks", "url" => ""]

    ]);

    $projects = Project::all();

    $listaDados = json_encode(Task::select('id', 'title', 'description', 'completed', 'type')->get());

    return view('Tasks.index', compact('listaMigalhas', 'listaDados', 'projects'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  { }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //dd($request->all());
    $data = $request->all();
    //validação
    $validacao = \Validator::make($data, [
      "title" => "required",
      "description" => "required",
      "type" => "required"
    ]);

    $data['completed'] = false;

    /* O teste para validar os campos e voltar mostrando os erros
        e os campos ja preenchindos  com o withInput e o helper old */
    if ($validacao->fails()) {
      return redirect()->back()->withErrors($validacao)->withInput();
    }

    Task::create($data);

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
    return Task::find($id);
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
    $validacao = \Validator::make($data, [
      "title" => "required",
      "description" => "required"
    ]);

    if ($validacao->fails()) {
      return redirect()->back()->withErrors($validacao)->withInput();
    }

    Task::find($id)->update($data);
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
    Task::find($id)->delete();
    return redirect()->back();
  }
}
