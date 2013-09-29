
<?php
/**
 * @var User $user
 * @var Profile $profile
 * @var bool $errorOldPassword
 */
?>


<?php echo View::make("user._menu"); ?>

<div class="container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">

            <?php if (Session::get("success")): ?>

                <div class="alert alert-success">
                    <p>Account updated</p>
                </div>

            <?php endif; ?>

            <div class="panel panel-primary">
                <div class="panel-heading">Account</div>
                <div class="panel-body">

                    <?php echo View::make("user._formAccount", array(
                        "user" => $user,
                        "profile" => $profile,
                        "errorOldPassword" => $errorOldPassword,
                    )); ?>

                </div>
            </div>

        </div>

    </div>
</div>