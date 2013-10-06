



<div class="row">
    <div class="col-lg-<?=isset($page) && $page?3:12;?>">
        <div class="box">
            <header>
                <h5>Pages</h5>
            </header>
            <div class="body">
                <?= $this->load->view('pages/pages/left_tree'); ?>
                <br><h4>Add page</h4>
                <?= $this->load->view('pages/pages/add'); ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <?php if (isset($page) && $page) { ?>
    <div class="col-lg-9">
        <div class="box">
            <header>
                <h5>Form</h5>
            </header>
            <div class="body">
                <?= $this->load->view('pages/pages/form'); ?>
            </div>
        </div>
    </div>
    <?php } ?>

</div>
<!-- /.row -->