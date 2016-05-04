@extends(config('profio.auth.view.layout'))

@section(config('profio.auth.view.content_title_section_name'))
Manage Menu
@stop

@section(config('profio.auth.view.main_content_section_name'))

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-10">
                        <ol id="menus" class="sortable">
                            @foreach ($role->sidebarMenu() as $menu)
                            <li id="menuItem_{{ $menu->id }}">
                                <div><span class="menuName"><span class="{{ $menu->icon }}"></span> {{ $menu->name }}</span><span class="menuUrl">{{ $menu->url }}</span></div>
                                @if ($menu->child->count())
                                <ol>
                                    @foreach ($menu->child as $child)
                                        <li id="menuItem_{{ $child->id }}">
                                            <div><span class="menuName"><span class="{{ $child->icon }}"></span> {{ $child->name }}</span><span class="menuUrl">{{ $child->url }}</span></div>
                                            @if ($child->child->count())
                                            <ol>
                                                @foreach ($child->child as $grandChild)
                                                    <li id="menuItem_{{ $grandChild->id }}">
                                                        <div><span class="menuName"><span class="{{ $grandChild->icon }}"></span> {{ $grandChild->name }}</span><span class="menuUrl">{{ $grandChild->url }}</span></div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                                @endif
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" id="save"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
                <form method="post" id="form" role="form">
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section(config('profio.auth.view.end_head_section_name'))
<style>
    ol.sortable, ol.sortable ol {
        margin: 0 0 0 25px;
        padding: 0;
        list-style-type: none;
    }

    ol.sortable {
        margin: 4em 0;
    }

    .sortable li {
        margin: 5px 0 0 0;
        padding: 0;
    }

    .sortable li div  {
        border: 1px solid #d4d4d4;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        border-color: #D4D4D4 #D4D4D4 #BCBCBC;
        padding: 6px;
        margin: 0;
        cursor: move;
        background: #f6f6f6;
        background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #ededed 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(47%,#f6f6f6), color-stop(100%,#ededed));
        background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
        background: -o-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
        background: -ms-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
        background: linear-gradient(to bottom,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 );
    }

    .sortable li.mjs-nestedSortable-branch div {
        background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #f0ece9 100%);
        background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#f0ece9 100%);

    }

    .sortable li.mjs-nestedSortable-leaf div {
        background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #bcccbc 100%);
        background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#bcccbc 100%);

    }

    li.mjs-nestedSortable-collapsed.mjs-nestedSortable-hovering div {
        border-color: #999;
        background: #fafafa;
    }
    .menuUrl {
        font-family: Consolas;
        float: right;
    }
</style>
@append

@section(config('profio.auth.view.end_body_section_name'))
<link rel="stylesheet" href="{{ url('css/jquery-ui.css') }}" />
<script src="{{ url('js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.mjs.nestedSortable.js') }}"></script>
<script>
    var menus = $('#menus');
    var obj;
    $(document).ready(function(){
        menus.nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div'
        });

        $('#save').click(function(){
            var menuArray = menus.nestedSortable('toArray');
            var form = $('form#form');
            for (var i = 0; i < menuArray.length; i++) {
                if (menuArray[i].id != undefined) {
                    form.append($('<input type="hidden" name="menus[]" value="' + menuArray[i].id + '">'));
                    form.append($('<input type="hidden" name="parents[]" value="' + menuArray[i].parent_id + '">'));
                }
            }
            form.submit();
        });
    });
</script>
@append
