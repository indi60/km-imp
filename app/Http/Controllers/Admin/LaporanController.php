<?php

namespace App\Http\Controllers\Admin;

use App\Ticket;
use App\Project;
use App\Status;
use App\User;
use App\Exports\laporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Users = User::all();
        $Statuses = Status::all();
        $Projects = Project::all();
        $Tickets = Ticket::all();
        return view('admin.laporan', compact('Tickets', 'Users', 'Statuses','Projects', 'count_total_project', 'count_total_tiket'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportExcel()
    {
        $nama_file = 'laporan pengerjaan issue - ' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new laporanExport, $nama_file);
    }

    public function exportPDF()
    {
        $Tickets = Ticket::all();
        $pdf = 'PDF'::loadView('admin.previewlaporan', compact('Tickets'))->setPaper('a4', 'potrait');
        return $pdf->stream('laporan pengerjaan issue - ' . date('Y-m-d_H-i-s') . '.pdf');
    }
}
