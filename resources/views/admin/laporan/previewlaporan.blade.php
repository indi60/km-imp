<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Peminjaman Barang Guru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

    <!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-center">Laporan Pengerjaan Issue</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">Tiket-id</th>
                            <th scope="col" class="text-center">Nama Penulis</th>
                            <th scope="col" class="text-center">Email Penulis</th>
                            <th scope="col" class="text-center">Judul Tiket</th>
                            <th scope="col" class="text-center">Project</th>
                            <th scope="col" class="text-center">Assigned To</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Priority</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <th scope="row" class="text-center">
                                    <strong>
                                            TCK-{{ $ticket->id }}
                                    </strong>
                                </th>
                                <td class="text-center">{{ $ticket->author_name }}</td>
                                <td class="text-center">{{ $ticket->author_email }}</td>
                                <td class="text-center">{{ $ticket->title }}</td>
                                <td class="text-center">
                                    @foreach($ticket->project as $item)
                                        {{ $item->name }} Bagian
                                        @foreach($item->category_project as $items)
                                            {{ $items->name }}
                                        @endforeach
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @foreach($ticket->assigned_to as $item)
                                        {{ $item->name }}
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @foreach($ticket->status as $item)
                                        <span class="badge badge-pill text-white" style="background-color: {{ $item->color }}">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @foreach ($ticket->priority as $item)
                                        <span class="badge badge-pill text-white" style="background-color: {{ $item->color }}">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</body>
</html>

