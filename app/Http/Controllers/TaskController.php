<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Dotenv\Exception\ValidationException;

class TaskController extends Controller
{
    public function index($project_id)
    {
      Project::findOrFail($project_id);

      $tasks = Task::where('project_id', $project_id)->get();

      return  json_encode($tasks);
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

    public function store($project_id, Request $request)
    {
      $projectExists = Project::where('id', $project_id)->count() > 0;

      if(!$projectExists){
        throw new ValidationException("Projeto não encontrado");
      }

      $task = $request->all();

      $validacao = \Validator::make($task, [
        "title" => "required",
        "description" => "required",
        "type" => "required"
      ]);

      if($validacao->fails()){
        throw new ValidationException("Falha na validação");
      }

      $task['completed'] = false;
      $task['project_id'] = $project_id;

      $id = Task::create($task)->id;

      return json_encode($id);
    }

    public function show($project_id, $id)
    {
      $projectExists = Project::where('id', $project_id)->count() > 0;

      if(!$projectExists){
        throw new ValidationException("Projeto não encontrado");
      }

      $task = Task::where('project_id', $project_id)->findOrFail($id);

      return json_encode($task);
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

    public function update(Request $request, $project_id, $id)
    {
      $projectExists = Project::where('id', $project_id)->count() > 0;

      if(!$projectExists){
        throw new ValidationException("Projeto não encontrado");
      }

      $taskExists = Task::where('id', $id)->count() > 0;

      if(!$taskExists){
        throw new ValidationException("Tarefa não encontrada");
      }

      Task::findOrFail($id);

      $data = $request->all("title", "description", "completed");

      $validacao = \Validator::make($data,[
        "title" => "required",
        "description" => "required",
        "completed" => "required",
      ]);

      if($validacao->fails()){
        throw new ValidationException("Falha na validação");
      }

      Task::find($id)->update($data);
    }

    public function destroy($project_id, $id)
    {
      $projectExists = Project::where('id', $project_id)->count() > 0;

      if(!$projectExists){
        throw new ValidationException("Projeto não encontrado");
      }

      Task::where('project_id', $project_id)->findOrFail($id);

      Task::destroy($id);
    }
}
