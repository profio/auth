@extends(config('profio.auth.view.layout'))

@section('content-title')
Add Menu
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            {!! BootForm::openHorizontal(['sm' => [4, 8], 'lg' => [2, 10]]) !!}
            {{ BootForm::bind($menu) }}
            <div class="box-body">
                {!! BootForm::text('Nama', 'name', $menu->name) !!}
                {!! BootForm::text('URL', 'url', $menu->url) !!}
                {!! BootForm::text('Icon', 'icon', $menu->icon) !!}
                <div class="form-group">
                    <label class="col-sm-4 col-lg-2 control-label" for="permissions">Hak Akses</label>
                    <div class="col-sm-8 col-lg-10">
                        <table class="table datatable table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="col-md-10">Hak Akses</th>
                                    <th class="col-md-2">Pilih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;?>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td><input type="checkbox" name="permission_ids[]" id="permission-{{ $permission->id }}" value="{{ $permission->id }}"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="result">
                </div>
                <div class="form-group"><div class="col-sm-offset-4 col-sm-8 col-lg-offset-2 col-lg-10"><button id="submit" type="submit" class="btn btn-primary">Simpan</button></div></div>
            </div>
            {!! BootForm::close() !!}
        </div>
    </div>
</div>

@stop


@section('end-body')
@include('profio/auth::partials.index-datatable')
<script>
$(function(){
    var menuPermissions = [
        @foreach ($menu->permissions as $permission)
        {{ $permission->id . ',' }}
        @endforeach
    ];

    for (var i = 0; i < menuPermissions.length; i++) {
        console.log(datatable.$('#permission-' + menuPermissions[i]));
        datatable.$('#permission-' + menuPermissions[i]).prop('checked', true);
    }
    datatable.draw();

    $('#submit').click(function(){
        $('#result').append(datatable.$('input:checked'));
    });
});
</script>
@append