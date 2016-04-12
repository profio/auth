<!-- SIMTA ITS script -->
<script type="text/javascript">
    function showModalDelete(modalName, url, title, body, ids)
    {
        var modal = $('#' + modalName).clone();

        $('.modal-footer form', modal).attr('action', url);

        if (title) {
            $('.modal-title', modal).text(title);
        }
        if (body) {
            $('.modal-body p', modal).text(body);
        }
        if (ids) {
            $('input[name=ids]', modal).val(JSON.stringify(ids));
        }

        modal.modal();
    }

$(document).ready(function(){
    // button destroy handler, showing modal confirmation
    $('button.destroy').click(function(){
        var url = $(this).data('url');
        showModalDelete('modal-delete', url);
    });
    $('button.destroy-many').click(function(){
        var ids = [];
        $('tr td div.checked input[type=checkbox]').each(function(){
            ids.push(this.value);
        });

        if (ids.length == 0) {
            return;
        }

        var url = $(this).data('url');
        var message = 'Anda yakin ingin menghapus ' + ids.length + ' data tersebut?';
        showModalDelete('modal-delete-many', url, false, message, ids);
    });

});
</script>
<div id="modal-delete" class="modal modal-primary fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data tersebut?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
            <form method="get">
                <input type="hidden" name="_method" value="GET">
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="modal-delete-many" class="modal modal-primary fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data tersebut?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
            <form method="get">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="ids">
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
