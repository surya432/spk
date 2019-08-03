@extends('adminlte::page')

@section('title', 'Tambah Nasabah')

@section('content_header')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tambah Nasabah</h2>
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


{!! Form::open(array('route' => 'nasabah.store','method'=>'POST')) !!}
{!! csrf_field() !!}

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label("Nama Calon Nasabah:", null, ['class' => 'control-label']) }}
            {!! Form::text('nama', null, array('placeholder' => 'Nama Nasabah','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {{ Form::label("Status:", null, ['class' => 'control-label']) }}
            {{Form::select("status",['Menikah' => 'Menikah', 'Belum Menikah' => 'Belum Menikah'], null,
                    [
                        "class" => "form-control",
                       
                    ])
            }}
        </div>

        <div class="form-group">
            {{ Form::label("Pekerjaan:", null, ['class' => 'control-label']) }}
            {!! Form::text('pekerjaan', null, array('placeholder' => 'Pekerjaan','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {{ Form::label("Telp:", null, ['class' => 'control-label']) }}
            {!! Form::text('telp', null, array('placeholder' => 'No. Telepon','class' => 'form-control')) !!}
        </div>

    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">

        <div class="form-group">
            {{ Form::label("Nama Istri / Suami:", null, ['class' => 'control-label']) }}
            {!! Form::text('istriSuami', null, array('placeholder' => 'Nama Istri/Suami','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {{ Form::label("Tanggal Lahir:", null, ['class' => 'control-label']) }}
            {!! Form::date('tanggalLahir', null, array('placeholder' => 'Tanggal Lahir','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {{ Form::label("Alamat:", null, ['class' => 'control-label']) }}
            {{Form::textarea("alamat", old("alamat") ? old("alamat") : (!empty($user) ? $user->description : null), 
             [
                "class" => "form-control",
                "rows"=>3
             ])
            }}
        </div>
        
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</div>
{!! Form::close() !!}
@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.permisionlist').select2();
    });
</script>
@stop