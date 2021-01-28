<?php

namespace App\Http\Controllers\admin;

use App\CategoryProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Ticket;

class CategoryProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $categoryProjects = CategoryProject::all();
        return view('admin.category_project.index', compact('categoryProjects', 'countTotalProject', 'countTotalTicket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        return view('admin.category_project.create', compact('countTotalProject', 'countTotalTicket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        CategoryProject::create($request->all());
        return redirect('/category-project')->with('status', 'Data ' . $request->name . ' Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $categoryProjects = CategoryProject::find($id);
        return view('admin.category_project.edit', compact('categoryProjects', 'countTotalProject', 'countTotalTicket'));
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
        $request->validate([
            'name' => 'required',
        ]);

        $categoryProjects = CategoryProject::find($id);
        $categoryProjects->name = $request->name;
        $categoryProjects->update();
        return redirect('/category-project')->with('status', 'Data ' . $request->name . ' Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryProjects = CategoryProject::find($id);
        $categoryProjects->delete();
        return redirect('/category-project')->with('statusDelete', 'Data Berhasil Dihapus!');
    }
}
