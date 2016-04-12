@extends(config('profio.auth.view.layout'))

@section(config('profio.auth.view.content_title_section_name'))
Add Role
@stop

@section(config('profio.auth.view.main_content_section_name'))

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
