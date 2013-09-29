
<?php
/**
 * @var User $user
 * @var Profile $profile
 */
?>


<?php echo View::make("user._menu"); ?>

<div class="container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">

            <?php if ($successUser = Session::get("success")): ?>

                <div class="alert alert-success">
                    <p>You have successfully registered as [ <strong><?php echo $successUser->email; ?> / <?php echo $successUser->username; ?></strong> ]</p>

                    <?php if (Config::get("auth.emailActivation")): ?>
                        <p>Please activate your account by visiting the link sent to your email address.</p>
                    <?php else: ?>
                        <p><?php echo HTML::link("/", "Go home"); ?></p>
                    <?php endif; ?>
                </div>

            <?php else: ?>

                <div class="panel panel-primary">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">

                        <?php echo View::make("user._formRegister", array(
                            "user" => $user,
                            "profile" => $profile,
                        )); ?>

                    </div>
                </div>

            <?php endif; ?>

        </div>

    </div>
</div>