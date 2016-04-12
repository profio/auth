@extends(config('profio.auth.view.layout'))

@section('content-title')
Add Permission
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            {!! BootForm::openHorizontal(['sm' => [4, 8], 'lg' => [2, 10]]) !!}
            {{ BootForm::bind($permission) }}
            <div class="box-body">
                {!! BootForm::text('Nama', 'name', $permission->name) !!}
                {!! BootForm::text('Tampilan', 'display_name', $permission->display_name) !!}
                {!! BootForm::text('Deskripsi', 'description', $permission->description) !!}
                {!! BootForm::submit('Simpan'); !!}
            </div>
            {!! BootForm::close() !!}
        </div>
    </div>
</div>

@stop

@include('profio/auth::partials.index-datatable')
