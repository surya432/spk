@extends('adminlte::page')

@section('title', 'Data Training Pengajuan')

@section('content_header')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Data Training Pengajuan Nasabah</h2>
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
            <script>
                function prosesData() {
                    let inputs = $('.classW');
                    inputs.each(function() {
                        $(this).val($(this).attr('var') + ":::" + $(this).val());
                        console.log($(this).val())
                    });
                    let inputsX = $('.classX');
                    inputsX.each(function() {
                        $(this).val($(this).attr('var') + ":::" + $(this).val());
                        console.log($(this).val())
                    });
                    let inputsZ = $('.classZ');
                    inputsZ.each(function() {
                        $(this).val($(this).attr('var') + ":::" + $(this).val());
                        console.log($(this).val())
                    });
                };
            </script>
            {!! Form::open(array('route' => 'datatraining.store','method'=>'POST','class'=>'form-horizontal', 'onsubmit'=>"prosesData()")) !!}

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
                                {!! Form::text('umur', $data->umur, array('placeholder' => 'Umur Nasabah', 'readonly' => 'true','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("Perkerjaan :", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::text('perkerjaan', $data->perkerjaan, array('placeholder' => 'Perkerjaan Nasabah', 'readonly' => 'true','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("Pengajuan:", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::text('nilaiPengajuan', $data->nilaiPengajuan, array('id'=>'nilaiPengajuan','placeholder' => 'Pengajuan Kredit', 'readonly' => 'true','class' => 'form-control uang')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("Nilai Asset :", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::text('nilaiAsset',$data->nilaiAsset, array('id'=>'nilaiAsset','placeholder' => 'Nilai Asset', 'readonly'=>true, 'class' => 'form-control uang')) !!}
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
                                {!! Form::text('tenorPinjaman', $data->tenorPinjaman, array('placeholder' => 'Tenor Pinjaman (Bulan)','readonly' => 'true','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label("Gaji :", null, ['class' => 'col-sm-4 control-label']) }}
                            <div class="col-sm-8">
                                {!! Form::text('gaji', $data->gaji, array('placeholder' => 'Gaji Nasabah', 'readonly' => 'true','class' => 'form-control uang')) !!}
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.box-body
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Training Data</button>
                </div> -->
                <!-- /.box-footer -->
        </div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Bobot X</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-3">
                        {!! Form::text("x[]", $data->x1, array('placeholder' => 'x1', 'required' => 'required','var'=>"x1", 'class' => "form-control classX")) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::text("x[]", $data->x2, array('placeholder' => 'x2', 'required' => 'required','var'=>"x2",'class' => "form-control classX")) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::text("x[]", $data->x3, array('placeholder' => 'x3', 'required' => 'required','var'=>"x3",'class' => "form-control classX")) !!}
                    </div>
                    <div class="col-xs-3">
                        {!! Form::text("x[]", $data->x4, array('placeholder' => 'x4','required' => 'required', 'var'=>"x4", 'class' => "form-control classX")) !!}
                    </div>
                    @if ($data->inputanX > 4)
                    @for ($i = 5; $i <= $data->inputanX; $i++)
                        <div class="col-xs-3">
                            {!! Form::text("x[]".$i, null, array('placeholder' => 'x'.$i,'var'=>"x$i", 'class' => "form-control 'required' => 'required', classX")) !!}
                        </div>
                        @endfor
                        @endif
                </div>

            </div>
        </div>
        <!-- /.box -->


        @if ($data->datatraining < 1) <!-- /.box-body -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Bobot Layer</h3>
                </div>
                <div class="box-body">
                    @for ($j=1; $j <=$data->bobotLayers; $j++)
                        Neuron {{ $j}}
                        <div class="row">
                            @for($i=1; $i <=$data->inputanX; $i++)
                                <div class="col-xs-3">
                                    {!! Form::text("w[]", null, array('placeholder' => 'w'.$j.$i, 'var'=>"w$j$i",'required' => 'required', 'class' => "form-control classW")) !!}
                                </div>
                                @endfor
                        </div>
                        @endfor



                </div>
            </div>
            <!-- /.box-body -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Bobot Output</h3>
                </div>
                <div class="box-body">
                    <div class="row">

                        @for ($i=1; $i <=$data->bobotLayers; $i++)
                            <div class="col-xs-3">
                                {!! Form::text("z[]".$i, null, array('placeholder' => 'z3'.$i, 'var'=>"z$i",'required' => 'required','class' => "form-control classZ")) !!}
                            </div>
                            @endfor

                    </div>

                </div>
            </div>
            <!-- /.box-body -->
            @endif
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Bobot Bias</h3>
                </div>
                <div class="box-body">
                    <div class="row">

                        <div class="col-xs-3">
                            {!! Form::text("bias", null, array('placeholder' => 'bias','required' => 'required', 'class' => "form-control")) !!}
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Training Data</button>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
            <!-- /.box -->
            {!! Form::close() !!}

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
        $('.uang').mask('000.000.000.000.000', {
            reverse: true
        });

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '2', ',', '.');
        }
    </script>
    @stop