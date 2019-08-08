@extends('adminlte::page')

@section('title', 'Hasil Training Pengajuan Nasabah')

@section('content_header')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Hasil Training Pengajuan Nasabah</h2>
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
                <h3 class="box-title">Hasil Training Form</h3>
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
        <!-- /.box -->
        <div class='col-md-6'>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Value</h3>
                </div>
                <div class="box-body">
                    <div class="row">

                        <div class="table-responsive">
                            <table id="tableHistoriInput" class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="10%">No</th>
                                        <th>Keys</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>

                            </table>

                        </div>
                    </div>

                    <!-- /.box-footer -->
                </div>
            </div>
            <!-- /.box -->
        </div>
        <div class='col-md-6'>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Hasil</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table id="tableHistoriOutput" class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="10%">No</th>
                                        <th>Keys</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>

                            </table>

                        </div>


                    </div>

                    <!-- /.box-footer -->
                </div>
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
            $('#tableHistoriInput').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("tableHistoriInput",$data->id) }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'keys'
                    }, {
                        data: 'value'
                    }

                ]
            });
            $('#tableHistoriOutput').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("tableHistoriOutput",$data->id) }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'keys'
                    }, {
                        data: 'value'
                    }

                ]
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