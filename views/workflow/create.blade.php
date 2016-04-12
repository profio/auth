@extends(config('profio.auth.view.layout'))

@section('content-title')
Add Workflow
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            {!! BootForm::openHorizontal(['sm' => [4, 8], 'lg' => [2, 10]]) !!}
            {{ BootForm::bind($workflow) }}
            <div class="box-body">
                {!! BootForm::text('Nama', 'name', $workflow->name) !!}
                {!! BootForm::textarea('Deskripsi', 'description', $workflow->description) !!}
                {!! BootForm::submit('Simpan'); !!}
            </div>
            {!! BootForm::close() !!}
        </div>
    </div>
</div>

@stop
