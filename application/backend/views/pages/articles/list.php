<!-- jqgrid -->
<script src="<?= base_url() ?>assets/lib/jqGrid/js/grid.locale-en.js" type="text/javascript"></script>   
<script src="<?= base_url() ?>assets/lib/jqGrid/js/jquery.jqGrid.src.js" type="text/javascript"></script>    
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>assets/lib/jqGrid/css/smoothness/jquery-ui-1.8.19.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?= base_url() ?>assets/lib/jqGrid/css/ui.jqgrid.css" />   
<!-- end  jqgrid --> 

<script type="text/javascript" >

    $(document).ready(function() {

        jQuery("#list").jqGrid({
            url: '<?= base_url() ?>articles/get',
            datatype: "json",
            mtype: 'POST',
            autoencode: true,
            loadonce: false,
            colNames: ['ID', 'Title', 'Text', 'Uri'],
            colModel: [
                {name: 'id', index: 'id',  editable: false, editoptions: {readonly: true, size: 10}},
                {name: 'title', index: 'title',  height: 50, resizable: true, align: "left", editable: true, edittype: "text"},
                {name: 'text', index: 'text',  resizable: true, align: "left", sorttype: "text", editable: true, edittype: "text"},
                {name: 'uri', index: 'uri',  resizable: true, align: "left", sorttype: "text", editable: true, edittype: "text"},
            ],
            rowNum: 15,
            multiselect: false,
            rowList: [15, 30, 45],
            pager: '#pager',
            altRows: true,
            sortname: 'id',
            viewrecords: true,
            sortorder: "asc",
            height: $(window).height()*0.7,
            width: $('.center_content').width()-10,
            caption: "",
            editurl: '<?= base_url() ?>articles/edit',
            ondblClickRow: function(rowid) {
                window.location.href = '<?= base_url() ?>articles/form/'+rowid;
            },
            loadComplete: function() {
            },
            onSelectRow: function() {
            }
        });

        jQuery("#list").jqGrid('navGrid','#pager',
        {search:false,delete:false},
        {width:400,reloadAfterSubmit:true,closeOnEscape:true,closeAfterEdit:true,
            beforeShowForm: function(form){
                var id = $(form).find("#id_g").val();
                window.location.href = "<?= base_url() ?>articles/form/"+id;
                return false;
            },
            afterShowForm:function($form){},
            onclickSubmit: function(params,postdata){}
        },
        {width:400,reloadAfterSubmit:true,closeOnEscape:true, closeAfterAdd:true,  //insert
            beforeShowForm: function(){
                window.location.href = "<?= base_url() ?>articles/add";
            },
            afterShowForm:function(){},
            onclickSubmit: function(params,postdata){return {id_vars:'id'}}
        },
        {onclickSubmit: function(){return {}},closeOnEscape:true},{});
        
        $(".center_content .ui-jqgrid-titlebar, span.ui-icon.ui-icon-trash").remove();
    });
</script>   


<div class="center_content" style="width:100%" >
    <div style='margin-top:5px;'>
        <table id="list" ></table>
        <div id="pager"></div>           
    </div>      
</div> <!-- end center_content -->
