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
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        return view('admin.setting.priority.create', compact('countTotalProject', 'countTotalTicket'));
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
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $priorities = Priority::find($id);
        return view('admin.setting.priority.edit', compact('priorities', 'countTotalProject', 'countTotalTicket'));
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

        $priorities = Priority::find($id);
        $priorities->name = $request->name;
        $priorities->color = $request->color;
        $priorities->update();
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
        $priorities = Priority::find($id);
        $priorities->delete();
        return redirect('/setting')->with('statusDelete', 'Data Berhasil Dihapus!');
    }
}
