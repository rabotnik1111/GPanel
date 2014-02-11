<!-- jqgrid -->
<script src="<?= base_url() ?>assets/lib/jqGrid/js/grid.locale-en.js" type="text/javascript"></script>   
<script src="<?= base_url() ?>assets/lib/jqGrid/js/jquery.jqGrid.src.js" type="text/javascript"></script>    
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>assets/lib/jqGrid/css/smoothness/jquery-ui-1.8.19.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>assets/lib/jqGrid/css/ui.jqgrid.css" />   
<!-- end  jqgrid --> 

<script type="text/javascript" >

    $(document).ready(function() {

        function link_formatter(cellvalue, options, rowObject) {
            return true ? "<center><a href='<?= base_url(); ?>vars/index/" + cellvalue + "' class='btn btn-xs btn-metis-5' style='color:white;'>List</a></center>" : "";
        }

        jQuery("#list").jqGrid({
            url: '<?= base_url() ?>vars/get/<?= $parent; ?>',
            datatype: "json",
            mtype: 'POST',
            autoencode: true,
            loadonce: false,
            colNames: ['ID', 'Name', 'List', 'Childrens'],
            colModel: [
                {name: 'id', index: 'id', editable: false, editoptions: {readonly: true, size: 10}},
                {name: 'name', index: 'name', height: 50, resizable: true, align: "left", editable: true, edittype: "text"},
                {name: 'list', index: 'list', resizable: true, align: "left", sorttype: "text", editable: false, edittype: "text"},
                {name: 'page_id', index: 'page_id', editable: false, formatter: link_formatter, editoptions: {readonly: true, size: 10}},
            ],
            rowNum: 30,
            multiselect: false,
            rowList: [30, 60, 90],
            pager: '#pager',
            altRows: true,
            sortname: 'id',
            viewrecords: true,
            sortorder: "asc",
            height: $(window).height() * 0.6,
            width: $('.center_content').width() - 10,
            caption: "",
            editurl: '<?= base_url() ?>articles/edit',
            ondblClickRow: function(rowid) {
                window.location.href = '<?= base_url() ?>vars/langs/' + rowid;
            },
            loadComplete: function() {
            },
            onSelectRow: function() {
            }
        });

        jQuery("#list").jqGrid('navGrid', '#pager',
                {search: false, delete: false},
        {width: 400, reloadAfterSubmit: true, closeOnEscape: true, closeAfterEdit: true,
            beforeShowForm: function(form) {
                var id = $(form).find("#id_g").val();
                window.location.href = "<?= base_url() ?>vars/langs/" + id;
                return false;
            },
            afterShowForm: function($form) {
            },
            onclickSubmit: function(params, postdata) {
            }
        },
        {width: 400, reloadAfterSubmit: true, closeOnEscape: true, closeAfterAdd: true, //insert
            beforeShowForm: function() {
                //window.location.href = "<?= base_url() ?>articles/add";
            },
            afterShowForm: function() {
            },
            onclickSubmit: function(params, postdata) {
            }
        },
        {onclickSubmit: function() {
                return {}
            }, closeOnEscape: true}, {});

        $(".center_content .ui-jqgrid-titlebar, span.ui-icon.ui-icon-trash, span.ui-icon.ui-icon-plus").remove();
    });
</script>   


<div class="center_content" style="width:100%" >
    <div style='margin-top:5px;'>
        <table id="list" ></table>
        <div id="pager"></div>           
    </div>      
</div> <!-- end center_content -->

<br>
<h4>Add variable</h4>
<form method='post' action='<?=base_url();?>vars/add'>
    <input type="hidden" name="new_var[parent]" value="<?= $parent; ?>"/>
    <label> 
        <input name="new_var[name]" placeholder="Name for variable" class='form-control'/>
    </label>
    <div class='clearfix'></div>
    <?php foreach ($langs as $lang) { ?>
        <input style='width: <?=90/count($langs);?>%; float:left; margin-right:<?=10/count($langs);?>%;' name="new_var[values][<?=$lang['id'];?>]" placeholder="Variable for <?=$lang['name'];?>" class='form-control'/>
    <?php } ?>
        <div class='clearfix'></div><br>
    <button class="btn btn-success">Create</button>
</form>