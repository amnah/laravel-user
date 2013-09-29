
<?php
/**
 * @var string $token
 * @var User $user
 * @var bool $errorToken
 * @var bool $errorEmail
 */
?>


<?php echo View::make("user._menu"); ?>

<div class="container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">

            <?php if (Session::has("success")): ?>

                <div class="alert alert-success">
                    <p class="text-center">Password changed</p>
                    <p class="text-center"><?php echo HTML::link("/user/login", "Login"); ?></p>
                </div>

            <?php elseif ($errorToken): ?>

                <div class="alert alert-danger">
                    <p class="text-center">Invalid token</p>
                </div>

            <?php else: ?>

                <div class="panel panel-primary">
                    <div class="panel-heading">Reset password</div>
                    <div class="panel-body">

                        <?php echo View::make("user._formReset", array(
                            "token" => $token,
                            "user" => $user,
                            "errorEmail" => $errorEmail,
                        )); ?>

                    </div>
                </div>

            <?php endif; ?>

        </div>

    </div>
</div>