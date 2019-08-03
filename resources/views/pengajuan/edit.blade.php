@extends('adminlte::page')

@section('title', 'Edit Nasabah')

@section('content_header')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Nasabah</h2>
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


{!! Form::model($data, ['method' => 'PATCH','route' => ['nasabah.update', $data->id]]) !!}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label("Nama Calon Nasabah:", null, ['class' => 'control-label']) }}
            {!! Form::text('nama', null, array('placeholder' => 'Nama Nasabah','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {{ Form::label("Status:", null, ['class' => 'control-label']) }}
            {{Form::select("status",['Menikah' => 'Menikah', 'Belum Menikah' => 'Belum Menikah'], $data->status,
                    [
                        "class" => "form-control",
                        "placeholder" => "Status Nasabah"
                    ])
            }}
        </div>

        <div class="form-group">
            {{ Form::label("Pekerjaan:", null, ['class' => 'control-label']) }}
            {!! Form::text('pekerjaan', $data->pekerjaan, array('placeholder' => 'Pekerjaan','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {{ Form::label("Telp:", null, ['class' => 'control-label']) }}
            {!! Form::text('telp', $data->telp, array('placeholder' => 'No. Telepon','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {{ Form::label("Tanggal Lahir:", null, ['class' => 'control-label']) }}
            {!! Form::date('tanggalLahir', $data->tanggalLahir, array('placeholder' => 'Tanggal Lahir','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">

        <div class="form-group">
            {{ Form::label("Nama Istri / Suami:", null, ['class' => 'control-label']) }}
            {!! Form::text('istriSuami', $data->istriSuami, array('placeholder' => 'Nama Istri/Suami','class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {{ Form::label("Alamat:", null, ['class' => 'control-label']) }}
            {{Form::textarea("alamat", old("alamat") ? old("alamat") : (!empty($data) ?  $data->alamat : null), 
             [
                "class" => "form-control",
             ])
            }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
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