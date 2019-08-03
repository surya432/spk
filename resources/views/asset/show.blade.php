@extends('adminlte::page')

@section('title', 'Edit Nasabah')

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
            {!! Form::text('nama', null, array('placeholder' => 'Nama Nasabah', 'readonly' => 'true',
            'class' => 'form-control')) !!}
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
        <div class="form-group">
            {{ Form::label("Tanggal Lahir:", null, ['class' => 'control-label']) }}
            {!! Form::date('tanggalLahir', $data->tanggalLahir, array('placeholder' => 'Tanggal Lahir','readonly' => 'true','class' => 'form-control')) !!}
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
             ])
            }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 ">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Asset Tambah</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route' => 'aset.store','method'=>'POST')) !!}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Nama Aset</label>
                    <div class="col-sm-9">
                        {!! Form::text('nama', null, array('placeholder' => 'Nama Asset','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">Nilai Aset</label>

                    <div class="col-sm-9">
                        {!! Form::text('nilaiAset', null, array('placeholder' => 'Nilai Asset','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="box-footer col-sm-12">
                    <button type="submit" class="btn btn-info pull-right">Simpan</button>
                </div>
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 ">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Asset Yang Dimiliki</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

        </div>
    </div>

</div>

@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.permisionlist').select2();
    });
</script>
@stop