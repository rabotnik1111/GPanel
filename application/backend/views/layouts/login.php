<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="<?=base_url();?>assets/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/login.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/lib/magic/magic.css">

  </head>
  <body>

	      
<div class="container">
    <div class="text-center">
        <img src="<?=base_url();?>assets/img/logo.png" alt="Metis Logo">
    </div>
    <div class="tab-content">
        <?=$template['body'];?>
    </div>


</div> <!-- /container -->

	      
	      
      <script src="<?=base_url();?>assets/lib/jquery-2.0.3.min.js"></script>
      <script src="<?=base_url();?>assets/lib/bootstrap/js/bootstrap.js"></script>
      
      <script>
            $('.list-inline li > a').click(function() {
                var activeForm = $(this).attr('href') + ' > form';
                //console.log(activeForm);
                $(activeForm).addClass('magictime swap');
                //set timer to 1 seconds, after that, unload the magic animation
                setTimeout(function() {
                    $(activeForm).removeClass('magictime swap');
                }, 1000);
            });

        </script>
  </body>
</html>
