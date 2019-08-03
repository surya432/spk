@extends('adminlte::page')

@section('title', 'Detail Nasabah')

@section('content_header')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Detail Nasabah</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('nasabah.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label("Nama Calon Nasabah:", null, ['class' => 'control-label']) }}
            {!! Form::text('nama', $data->nama, array('placeholder' => 'Nama Nasabah', 'readonly' => 'true','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {{ Form::label("Status:", null, ['class' => 'control-label']) }}
            {!! Form::text('nama', $data->status, array('placeholder' => '-', 'readonly' => 'true',
            'class' => 'form-control')) !!}

        </div>

        <div class="form-group">
            {{ Form::label("Pekerjaan:", null, ['class' => 'control-label']) }}
            {!! Form::text('pekerjaan', $data->pekerjaan, array('placeholder' => '-','readonly' => 'true','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {{ Form::label("Telp:", null, ['class' => 'control-label']) }}
            {!! Form::text('telp', $data->telp, array('placeholder' => 'No. Telepon','class' => 'form-control','readonly' => 'true',)) !!}
        </div>

    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">

        <div class="form-group">
            {{ Form::label("Nama Istri / Suami:", null, ['class' => 'control-label']) }}
            {!! Form::text('istriSuami', $data->istriSuami, array('placeholder' => 'Nama Istri/Suami','readonly' => 'true','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {{ Form::label("Alamat:", null, ['class' => 'control-label']) }}
            {{Form::textarea("alamat", old("alamat") ? old("alamat") : (!empty($data) ?  $data->alamat : null), 
             [
                "class" => "form-control",
                'readonly' => 'true',
                'required' => 'true',
                'rows' => 4, 'cols' => 50, 'style' => 'resize:none'
             ])
            }}
        </div>
        <div class="form-group">
            {{ Form::label("Tanggal Lahir:", null, ['class' => 'control-label']) }}
            {!! Form::date('tanggalLahir', $data->tanggalLahir, array('placeholder' => 'Tanggal Lahir','readonly' => 'true','class' => 'form-control')) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 ">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Asset Nasabah</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="row">
                {!! Form::open(array('route' => 'asset.store','method'=>'POST')) !!}
                {{Form::hidden('nasabah_id', $data->id, array('id' => 'nasabah_id')) }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Nama Aset</label>
                        <div class="col-sm-8">
                            {!! Form::text('namaAsset', null, array('placeholder' => 'Nama Asset','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Nilai Aset</label>
                        <div class="col-sm-8">
                            {!! Form::number('nilaiAsset', null, array('placeholder' => 'Nilai Asset','class' => 'form-control')) !!}
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class='class="box-footer'>
                    <div class="box-footer col-sm-6">
                        <button type="submit" class="btn btn-info pull-right">Simpan</button>
                    </div>
                </div> <!-- /.box-footer -->
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 ">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">List Pengajuan</h3>
                <a class="btn btn-primary" href="{{ route('pengajuan.create') }}"> Tambah Pengajuan</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <table id="tablePengajuan" class="table table-bordered table-responsive">
                <thead class="thead-dark">
                    <tr>
                        <th width="10%">No</th>
                        <th width="20%">Date</th>
                        <th width="40%">Pengajuan</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 ">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Asset Yang Dimiliki</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <table id="table" class="table table-bordered table-responsive">
                <thead class="thead-dark">
                    <tr>
                        <th width="10%">No</th>
                        <th width="50%">Ketetangan Asset</th>
                        <th width="10%">Nilai</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@stop
@section('js')
<script type="text/javascript">
    $(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("tableAsset") }}',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'namaAsset'
                }, {
                    data: 'nilaiAsset'
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