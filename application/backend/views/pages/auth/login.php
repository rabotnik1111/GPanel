        <div id="login" class="tab-pane active">
            <form action="<?=base_url();?>auth/login" class="form-signin" method="post">
                <p class="text-muted text-center">
                    <?=$error;?>
                </p>
                <input type="text" placeholder="Username" name="username" class="form-control">
                <input type="password" placeholder="Password" name="password" class="form-control">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div>