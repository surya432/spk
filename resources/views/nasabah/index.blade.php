@extends('adminlte::page')

@section('title', 'Master Services')

@section('content_header')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>List Nasabah</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-green" href="{{ route('nasabah.create') }}"> Tambah Baru Nasabah</a>
        </div>

    </div>
</div>
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
                    Daftar Nasabah

                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>nama</th>
                                    <th>Alamat</th>
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
<script>
    $(document).ready(function(event) {

        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("tableNasabah") }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nama'
                }, {
                    data: 'alamat'
                }, {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }

            ]
        });

        $('body').on('click', '#btnDelete', function(e) {
            var user_id = $(this).data("id");

            confirm("Apa Anda Yakin menghapus Data Nasabah !");

            $.ajax({
                type: 'get',
                url: "/nasabah/delete/"+user_id,
                success: function(data) {
                    var oTable = $('#table').dataTable();
                    oTable.fnDraw(false);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@stop