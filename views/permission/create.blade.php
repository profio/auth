@extends(config('profio.auth.view.layout'))

@section(config('profio.auth.view.content_title_section_name'))
{{ $title }}
@stop

@section(config('profio.auth.view.main_content_section_name'))

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            {!! BootForm::openHorizontal(['sm' => [4, 8], 'lg' => [2, 10]]) !!}
            {{ BootForm::bind($permission) }}
            <div class="box-body">
                {!! BootForm::text('Name', 'name', $permission->name)->required() !!}
                {!! BootForm::text('Display Name', 'display_name', $permission->display_name) !!}
                {!! BootForm::text('Description', 'description', $permission->description) !!}
                <div class="form-group">
                    <label class="col-sm-4 col-lg-2 control-label" for="roles">Roles</label>
                    <div class="col-sm-8 col-lg-10">
                        <table class="table datatable table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="col-md-10">Role Name</th>
                                    <th class="col-md-2">Choose</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;?>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td><input type="checkbox" name="role_ids[]" id="role-{{ $role->id }}" value="{{ $role->id }}"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="result">
                </div>
                {!! BootForm::submit('Save')->id('submit'); !!}
            </div>
            {!! BootForm::close() !!}
        </div>
    </div>
</div>

@stop

@section(config('profio.auth.view.end_body_section_name'))
@include('profio/auth::partials.index-datatable')
<script>
$(function(){
    var permissionRoles = [
        @foreach ($permission->roles as $role)
        {{ $role->id . ',' }}
        @endforeach
    ];

    for (var i = 0; i < permissionRoles.length; i++) {
        console.log(datatable.$('#role-' + permissionRoles[i]));
        datatable.$('#role-' + permissionRoles[i]).prop('checked', true);
    }
    datatable.draw();

    $('#submit').click(function(){
        $('#result').append(datatable.$('input:checked'));
    });
});
</script>

@append