
<?php
/**
 * @var string $token
 * @var User $user
 * @var bool $success
 */
?>


<?php echo View::make("user._menu"); ?>

<div class="container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">

            <?php if ($success): ?>

                <div class="alert alert-success">
                    <p class="text-center">Account activated</p>
                    <p class="text-center"><?php echo HTML::link("/user/login", "Login"); ?></p>
                </div>

            <?php else: ?>

                <div class="alert alert-danger">
                    <p class="text-center">Invalid token</p>
                </div>

            <?php endif; ?>

        </div>

    </div>
</div>