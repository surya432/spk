@extends('adminlte::page')

@section('title', 'Histori Training')

@section('content_header')
<h1>List Data Histori</h1>
@stop

@section('content')
<div class="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Chart
                </div>
                <div class="panel-body">
                    {!! $chart->container() !!}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Daftar Histori
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Pengajuan</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>

                        </table>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@stop
@section('js')
{!! $chart-> script() !!}

<script>
    $(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("tableHistori") }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nasabah.nama'
                }, {
                    data: 'nilaiPengajuan'
                }, {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }

            ]
        });


    });
</script>
@stop