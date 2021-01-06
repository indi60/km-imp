<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Project;
use App\Ticket;
use App\Priority;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        return view('admin.setting.priority.create', compact('count_total_project', 'count_total_tiket'));
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
            'color' => 'required'
        ]);
        Priority::create($request->all());
        return redirect('/setting')->with('status', 'Data ' . $request->name . ' Berhasil Ditambahkan!');
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
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Priorities = Priority::find($id);
        return view('admin.setting.priority.edit', compact('Priorities', 'count_total_project', 'count_total_tiket'));
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
            'color' => 'required'
        ]);

        $Priorities = Priority::find($id);
        $Priorities->name = $request->name;
        $Priorities->color = $request->color;
        $Priorities->update();
        return redirect('/setting')->with('status', 'Data ' . $request->name . ' Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Priorities = Priority::find($id);
        $Priorities->delete();
        return redirect('/setting')->with('statusDelete', 'Data Berhasil Dihapus!');
    }
}
