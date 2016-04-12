@extends(config('profio.auth.view.layout'))

@section('content-title')
Add Role
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            {!! BootForm::openHorizontal(['sm' => [4, 8], 'lg' => [2, 10]]) !!}
            {{ BootForm::bind($role) }}
            <div class="box-body">
                {!! BootForm::text('Nama', 'name', $role->name) !!}
                {!! BootForm::text('Tampilan', 'display_name', $role->display_namea) !!}
                {!! BootForm::text('Deskripsi', 'description', $role->description) !!}
                {!! BootForm::submit('Simpan'); !!}
            </div>
            {!! BootForm::close() !!}
        </div>
    </div>
</div>

@stop
