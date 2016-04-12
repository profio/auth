@extends(config('profio.auth.view.layout'))

@section(config('profio.auth.view.content_title_section_name'))
Mapping Menu
@stop

@section(config('profio.auth.view.main_content_section_name'))

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Aliran Kerja {{ $workflow->name }}</h3>
            </div>
            <form action="" method="post" role="form">
                <div class="box-body">
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#process">Tambah Proses</button>
                    <br><br>
                    <div class="row">
                        <div class="col-md-8">
                            <table id="processes" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-md-5">Peran</th>
                                        <th class="col-md-5">Menu</th>
                                        <th class="col-md-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($workflow->menus as $menu)
                                    <tr class="{{ $menu->pivot->role_id . '-' . $menu->id }}">
                                        <td>{{ $roles[$menu->pivot->role_id] }} <input type="hidden" name="role_ids[]" value="{{ $menu->pivot->role_id }}"></td>
                                        <td>{{ $menu->name }} <input type="hidden" name="menu_ids[]" value="{{ $menu->id }}"></td>
                                        <td><button class="btn btn-danger btn-sm removeProcess" data-id="{{ $menu->pivot->role_id . '-' . $menu->id }}" type="button"><span class="fa fa-remove"></span></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {!! csrf_field() !!}
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="process" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addProcessLabel">Tambah Proses</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="role_id">Peran</label>
                <select class="form-control" id="role_id">
                @foreach ($roles as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="menu_id">Menu</label>
                <select class="form-control" id="menu_id">
                @foreach ($menus as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="addProcess">Tambah</button>
      </div>
    </div>
  </div>
</div>
@stop

@section(config('profio.auth.view.end_body_section_name'))
<script>
    $('#addProcess').click(function(){
        var roleId = $('#role_id').val();
        var roleName = $('#role_id option[value="' + roleId + '"]').text();
        var menuId = $('#menu_id').val();
        var menuName = $('#menu_id option[value="' + menuId + '"]').text();
        var row = $('<tr class="' + roleId + '-' + menuId  + '"></tr>')
            .append($('<td>' + roleName + '<input type="hidden" name="role_ids[]" value="' + roleId + '"></td>'))
            .append($('<td>' + menuName + '<input type="hidden" name="menu_ids[]" value="' + menuId + '"></td>'))
            .append($('<td><button class="btn btn-danger btn-sm removeProcess" data-id="' + roleId + '-' + menuId  + '" type="button"><span class="fa fa-remove"></span></a></td>'));
        $('#processes tbody').append(row);
    });
    $('#processes tbody').on('click', '.removeProcess', function(){
        var id = $(this).data('id');
        $('.' + id).remove();
    });
</script>
@append
