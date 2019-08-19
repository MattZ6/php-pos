<?php

namespace App\Http\Controllers;

use App\models\Project;
use App\models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $projects = Project::all()->count();
    $tasks = Task::all()->count();

    return view('home', compact('projects', 'tasks'));
  }
}
