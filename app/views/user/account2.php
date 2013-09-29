
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

            <?php if ($success = Session::get("success")): ?>

                <div class="alert alert-success">
                    <p><?php echo $success; ?></p>
                </div>

            <?php endif; ?>

                <?php echo View::make("user._formAccount2", array(
                    "user" => $user,
                    "profile" => $profile,
                    "errorOldPassword" => $errorOldPassword,
                )); ?>

        </div>

    </div>
</div>