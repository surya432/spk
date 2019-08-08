@extends('adminlte::page')

@section('title', 'Pengajuan Nasabah')

@section('content_header')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Pengajuan Nasabah</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('nasabah.show',$data->id) }}"> Back</a>
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
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Training Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('route' => 'datatraining.store','method'=>'POST','class'=>'form-horizontal')) !!}
            {{Form::hidden('pengajuan_id', $data->id, array('id' => 'pengajuan_id')) }}

            <form class="form-horizontal">
                <div class="box-body">
                    <div class='col-sm-6'>
                        <div class="form-group">
                            {{ Form::label("Nama Nasabah:", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::text('nama', $nasabah->nama, array('placeholder' => 'Nama Nasabah', 'readonly' => 'true','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("Umur:", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::text('umur', $nasabah->yearOld, array('placeholder' => 'Umur Nasabah', 'readonly' => 'true','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("Perkerjaan :", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::text('perkerjaan', $data->perkerjaan, array('placeholder' => 'Perkerjaan Nasabah', 'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("Pengajuan:", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::number('nilaiPengajuan', $data->nilaiPengajuan, array('id'=>'nilaiPengajuan','placeholder' => 'Pengajuan Kredit', 'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("Nilai Asset :", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::text('nilaiAsset', $data->nilaiAsset, array('id'=>'nilaiAsset','placeholder' => 'Nilai Asset', 'readonly'=>true, 'class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class='col-sm-6'>
                        <div class="form-group">
                            {{ Form::label("Telp:", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::text('telp', $nasabah->telp, array('placeholder' => 'Telepon Nasabah', 'readonly' => 'true','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("Alamat:", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {{Form::textarea("alamat", old("alamat") ? old("alamat") : (!empty($data) ?  $nasabah->alamat : null), 
                                [
                                    "class" => "form-control",
                                    'readonly' => 'true',
                                    'required' => 'true',
                                    'rows' => 3, 'cols' => 25, 'style' => 'resize:none'
                                ])
                                }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("Tenor Pinjaman :", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::number('tenorPinjaman', $data->tenorPinjaman, array('placeholder' => 'Tenor Pinjaman (Bulan)', 'class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("Gaji :", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::number('gaji', $data->gaji, array('placeholder' => 'Gaji Nasabah', 'class' => 'form-control')) !!}
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Training Data</button>
                </div>
                <!-- /.box-footer -->
                {!! Form::close() !!}
        </div>
        <!-- /.box -->
    </div>
</div>

@stop
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.permisionlist').select2();
        var x = $('#nilaiAsset').val();
        $('#nilaiAsset').val(x);
        $('#jaminan').on('change', function() {

            $('#nilaiJaminan').val($(this).find(":selected").data("nilai"));
        });
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '2', ',', '.');
    }
</script>
@stop