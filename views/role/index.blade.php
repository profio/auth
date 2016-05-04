@extends(config('profio.auth.view.layout'))

@section(config('profio.auth.view.content_title_section_name'))
Roles
@stop

@section(config('profio.auth.view.main_content_section_name'))

<div class="row">
    <div class="col-md-12">
        <a href="{{ url('role/create') }}" class="btn btn-social btn-primary">
            <i class="fa fa-plus"></i> Tambah Role
        </a>
        <br><br>
        <div class="box box-primary">
            <div class="box-body table-responsive">
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <button class="btn btn-default btn-sm checkbox-check" data-toggle="tooltip" title="Select All"><i class="glyphicon glyphicon-check"></i></button>&nbsp;
                        <button class="btn btn-default btn-sm checkbox-uncheck" data-toggle="tooltip" title="Deselect All"><i class="glyphicon glyphicon-unchecked"></i></button>&nbsp;
                        <button class="btn btn-danger btn-sm destroy-many" data-url="" title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o"></i></button>&nbsp;
                        <div class="visible-sm-block visible-xs-block"><br></div>
                    </div>

                    <table class="datatable table table-bordered">
                        <thead>
                            <tr>
                                <th class="no-sort" style="width=5px"></th>
                                <th>No.</th>
                                <th class="col-md-3">Name</th>
                                <th class="col-md-6">Display Name</th>
                                <th class="col-md-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;?>
                        @foreach ($roles as $item)
                            <tr>
                                <td><input type="checkbox" value="{{ $item->id }}"></td>
                                <td id="{{$i}}" >{{ $i++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->display_name }}</td>
                                <td>
                                    <a class="btn btn-xs btn-primary" data-toggle="tooltip" title="Edit" href="{{ url('role/edit/' . $item->id) }}">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <a class="btn btn-xs btn-primary" data-toggle="tooltip" title="Manage Menu" href="{{ url('role/menu/' . $item->id) }}">
                                        <i class="fa fa-gear"></i> Manage Menu
                                    </a>
                                    <button class="btn btn-xs btn-danger destroy" data-toggle="tooltip" data-url="{{ url('role/delete/' . $item->id) }}" title="Delete">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section(config('profio.auth.view.end_body_section_name'))
    @include('profio/auth::partials.index-datatable')
    @include('profio/auth::partials.modal-delete')
@append