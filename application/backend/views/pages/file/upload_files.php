<script src="<?= base_url() ?>assets/js/ajaxupload.js" type="text/javascript"></script>

<a class='btn btn-success' id='upload-file'>Select file</a>
<br><br>
<div id='upload-file-list'>

</div>

<script type="text/javascript">/*<![CDATA[*/
    function get_files_list() {
        $.post("<?= base_url(); ?>file/get/<?= $module_name; ?>/<?= $module_id; ?>", {}, function(data) {
            $("#upload-file-list").html("<table class='table table-bordered'>" + data.html + "</table>");
        }, 'json');
    }

    function delete_file(id) {
        $.post('<?= base_url(); ?>file/delete', {id: id}, function() {
            get_files_list();
        });
    }

    $(document).ready(function() {

        new AjaxUpload('upload-file', {
            action: '<?= base_url(); ?>file/upload/<?= $module_name; ?>/<?= $module_id; ?>',
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


    });/*]]>*/
</script>