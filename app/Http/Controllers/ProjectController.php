<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
      $projects = Project::all();

      return  json_encode($projects);
    }

    public function store(Request $request)
    {
      $project = $request->all();

      $validacao = \Validator::make($project, [
        "name" => "required",
        "description" => "required",
      ]);

      if($validacao->fails()){
        throw new ValidationException("Falha na validação");
      }

      return json_encode(Project::create($project)->id);
    }

    public function show($id)
    {
      $project = Project::findOrFail($id);

      return json_encode($project);
    }

    public function update(Request $request, $id)
    {
      $project = $request->all();

      $validacao = \Validator::make($project,[
        "name" => "required",
        "description" => "required",
      ]);

      if($validacao->fails()){
        throw new ValidationException("Falha na validação");
      }

      Project::findOrfail($id)->update($project);
    }

    public function destroy($id)
    {
      Project::findOrFail($id);

      Project::destroy($id);
    }
}
