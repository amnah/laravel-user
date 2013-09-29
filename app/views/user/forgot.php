
<?php
/**
 * @var bool $errorEmail
 */
?>


<?php echo View::make("user._menu"); ?>

<div class="container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">

                <div class="panel panel-primary">
                <div class="panel-heading">Forgot password</div>
                <div class="panel-body">

                    <?php if (Session::has("success")): ?>
                        <p class="text-center">Email sent</p>
                        <p class="text-center"><?php echo HTML::link("/user/login", "Login"); ?></p>
                    <?php else: ?>
                        <?php echo View::make("user._formForgot", array(
                            "errorEmail" => $errorEmail,
                        )); ?>
                    <?php endif; ?>

                </div>
            </div>

        </div>

    </div>
</div>