
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
                    <p>User updated [ <strong><?php echo $successUser->email; ?> / <?php echo $successUser->username; ?></strong> ]</p>
                </div>

            <?php endif; ?>

            <div class="panel panel-primary">
                <div class="panel-heading">Edit</div>
                <div class="panel-body">

                    <?php echo View::make("admin._form", array(
                        "user" => $user,
                        "profile" => $profile,
                    )); ?>

                </div>
            </div>

        </div>

    </div>
</div>