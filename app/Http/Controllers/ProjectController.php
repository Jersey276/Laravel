<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('projects/list',[ 'projects' => Project::all()]);
    }

    public function adminIndex()
    {
        return view('admin/projects/list',['projects' => Project::all()]);
    }
    
    public function detail(string $title)
    {
        return view('projects/detail', [ 'project' => Project::where(['title' => $title])->first()]);
    }

    public function create(Request $request)
    {
        $project = new Project([
            'title' => $request->title,
            'slug' => $request->slug,
            'text' => $request->text,
            'startedAt' => $request->startedAt,
            'finishedAt' => $request->finishedAt
        ]);
        if($project->save()) {
            $this->successFlash($request, 'Le projet à été crée');
        } else {
            $this->errorFlash($request, 'Le projet n\'a pu être crée');
        }
        return redirect('admin/projects');
    }

    public function createForm()
    {
        return view('admin/projects/form');
    }

    public function edit(Request $request, int $id)
    {
        $project = Project::find($id);
        if ($project->update([
        'title' => $request->title,
        'slug' => $request->slug,
        'text' => $request->text,
        'startedAt' => $request->startedAt,
        'finishedAt' => $request->finishedAt
        ])) {
            $this->successFlash($request, 'Le projet '. $project->title.' à été mis à jour');
        } else {
            $this->errorFlash($request, 'Le projet '. $project->title.' n\'a pu être mis à jour');
        }
        return redirect('/admin/projects');
    }

    public function editForm(int $id)
    {
        return view('admin/projects/form', ['project' => Project::find($id)]);
    }

    public function remove(Request $request, int $id)
    {
        if(Project::find($id)->delete()) {
            $this->successFlash($request, 'Le projet à été supprimée');
        } else {
            $this->errorFlash($request, 'Le projet n\'a pu être supprimé');
        }
        return redirect('/admin/projects');
    }
}
