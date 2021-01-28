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
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $users = User::all();
        $statuses = Status::all();
        $projects = Project::all();
        $tickets = Ticket::all();
        return view('admin.laporan.index', compact('tickets', 'users', 'statuses', 'projects', 'countTotalProject', 'countTotalTicket'));
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
        $namaFile = 'laporan pengerjaan issue - ' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new laporanExport, $namaFile);
    }

    public function exportPDF()
    {
        $tickets = Ticket::all();
        $pdf = 'PDF'::loadView('admin.previewlaporan', compact('tickets'))->setPaper('a4', 'potrait');
        return $pdf->stream('laporan pengerjaan issue - ' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function sort(Request $request)
    {
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $users = User::all();
        $statuses = Status::all();
        $projects = Project::all();

        $tickets = Ticket::where('', '')
            ->where('', '')
            ->where('', '')
            ->where('', '')
            ->where('', '');

        return view('admin.laporan.index', compact('countTotalProject', 'countTotalTicket', 'users', 'statuses', 'projects', 'tickets'));
    }
}
