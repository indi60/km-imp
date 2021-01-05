<?php

namespace App\Exports;

use App\Ticket;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class laporanExport implements FromView
{
    public function view(): View
    {
        $Tickets = Ticket::all();
        return view('admin.previewlaporan', compact('Tickets'));
    }
}
