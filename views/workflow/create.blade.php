@extends(config('profio.auth.view.layout'))

@section(config('profio.auth.view.content_title_section_name'))
Add Workflow
@stop

@section(config('profio.auth.view.main_content_section_name'))

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            {!! BootForm::openHorizontal(['sm' => [4, 8], 'lg' => [2, 10]]) !!}
            {{ BootForm::bind($workflow) }}
            <div class="box-body">
                {!! BootForm::text('Name', 'name', $workflow->name) !!}
                {!! BootForm::textarea('Description', 'description', $workflow->description) !!}
                {!! BootForm::submit('Save'); !!}
            </div>
            {!! BootForm::close() !!}
        </div>
    </div>
</div>

@stop
