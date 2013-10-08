<!-- jqgrid -->
<script src="<?= base_url() ?>assets/lib/jqGrid/js/grid.locale-en.js" type="text/javascript"></script>   
<script src="<?= base_url() ?>assets/lib/jqGrid/js/jquery.jqGrid.src.js" type="text/javascript"></script>    
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>assets/lib/jqGrid/css/smoothness/jquery-ui-1.8.19.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>assets/lib/jqGrid/css/ui.jqgrid.css" />   
<!-- end  jqgrid --> 

<script type="text/javascript" >

    $(document).ready(function() {

        jQuery("#list").jqGrid({
            url: '<?= base_url() ?>menu/get',
            datatype: "json",
            mtype: 'POST',
            autoencode: true,
            loadonce: false,
            colNames: ['ID', 'Name', 'Icon', 'Url'],
            colModel: [
                {name: 'id', index: 'id',  editable: false, editoptions: {readonly: true, size: 10}},
                {name: 'name', index: 'name',  height: 50, resizable: true, align: "left", editable: true, edittype: "text"},
                {name: 'icon', index: 'icon',  resizable: true, align: "left", sorttype: "text", editable: true, edittype: "text"},
                {name: 'url', index: 'url',  resizable: true, align: "left", sorttype: "text", editable: true, edittype: "text"},
            ],
            rowNum: 15,
            multiselect: true,
            rowList: [15, 30, 45],
            pager: '#pager',
            altRows: true,
            sortname: 'id',
            viewrecords: true,
            sortorder: "asc",
            height: $(window).height()*0.7,
            width: $('.center_content').width()-10,
            caption: "",
            editurl: '<?= base_url() ?>menu/edit',
            ondblClickRow: function(rowid) {
                jQuery(this).jqGrid('editGridRow', rowid,
                        {recreateForm: true, closeAfterEdit: true,
                            closeOnEscape: true, reloadAfterSubmit: false});
            },
            loadComplete: function() {
            },
            onSelectRow: function() {
            }
        });

        jQuery("#list").jqGrid('navGrid','#pager',
        {search:false},
        {width:400,reloadAfterSubmit:true,closeOnEscape:true,closeAfterEdit:true,
            beforeShowForm: function(){},
            afterShowForm:function($form){},
            onclickSubmit: function(params,postdata){}
        },
        {width:400,reloadAfterSubmit:true,closeOnEscape:true, closeAfterAdd:true,  //insert
            beforeShowForm: function(){},
            afterShowForm:function(){},
            onclickSubmit: function(params,postdata){return {id_vars:'id'}}
        },
        {onclickSubmit: function(){return {}},closeOnEscape:true},{});
        
        $(".center_content .ui-jqgrid-titlebar").remove();
    });
</script>   


<div class="center_content" style="width:100%" >
    <div style='margin-top:5px;'>
        <table id="list" ></table>
        <div id="pager"></div>           
    </div>      
</div> <!-- end center_content -->
