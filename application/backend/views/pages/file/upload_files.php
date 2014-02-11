<script src="<?= base_url() ?>assets/js/ajaxupload.js" type="text/javascript"></script>

<a class='btn btn-success' id='upload-file'>Selecteaza fisier</a><br>
<small style="color: #bbb">Extensii disponibile: doc,jpg,jpeg,gif,pdf,docx,xls,xlsx,png,m4a,mp4,mp3</small>
<br><br>
<div id='upload-file-list'></div>

<!-- Modal -->
<div class="modal fade" id="file-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Detalii fisier</h4>
            </div>

            <div class="modal-body" id="file-details-content">
                Loading...
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="file-details-close" data-dismiss="modal">Anuleaza</button>
                <button type="button" class="btn btn-primary" id="file-details-save" data-id="0">Salveaza</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">/*<![CDATA[*/
    function get_files_list() {
        $.post("<?= base_url(); ?>file/get/<?= $module_name; ?>/<?= $module_id; ?>/<?=isset($module_type)?$module_type:'';?>", {}, function(data) {
            $("#upload-file-list").html("<table class='table table-bordered'>" + data.html + "</table>");

            $(".change_category").on('change', function() {
                var id = $(this).attr('data-id');
                var value = $(this).val();
                $.post('<?= base_url(); ?>file/category', {id: id, category: value}, function() {
                    get_files_list();
                });
            });
        }, 'json');
    }

    function delete_file(id) {
        var r = confirm("Sunteti sigur ca doriti sa stergeti fisierul?");
        if (r == true) {
            $.post('<?= base_url(); ?>file/delete', {id: id}, function() {
                get_files_list();
            });
        }
    }

    $(document).ready(function() {

        new AjaxUpload('upload-file', {
            action: '<?= base_url(); ?>file/upload/<?= $module_name; ?>/<?= $module_id; ?>/<?=isset($module_type)?$module_type:'';?>',
            responseType: 'json',
            allowedExtensions: ['*'],
            onSubmit: function(file, ext) {
                $('#upload-file').text('Uploading...');
            },
            onComplete: function(file, responseJSON) {
                $('#upload-file').text('Select file');
                get_files_list();
            }
        });

        get_files_list();

        $("body").on('click', '.open-file-datails', function() {
            var fid = $(this).attr('data-id');
            $("#file-details-save").attr('data-id', fid);
            $.post('<?= base_url(); ?>file/details', {id: fid}, function(data) {
                $("#file-details-content").html(data.html);
                $('#file-details-content .make-switch').bootstrapSwitch();
            }, 'json');
        });

        $("body").on('click', '#file-details-save', function() {
            var dat = $("#file-details-form").find('input, select, textarea').serialize();
            $.post('<?= base_url(); ?>file/details_save', dat, function(data) {
                $('#file-details').modal('hide');
                get_files_list();
            });
        });

        $("body").on('click', '.file-move', function() {
            var id = $(this).attr('data-id');
            var dir = $(this).attr('data-dir');
            console.log($(this).data());
            $.post('<?= base_url(); ?>file/move', $(this).data(), function() {
                get_files_list();
            });
        });

    });/*]]>*/
</script>