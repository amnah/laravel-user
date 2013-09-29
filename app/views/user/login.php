
<?php
/**
 * @var bool $errorLogin
 * @var string $errorBanReason
 * @var bool $errorActivation
 */
?>


<?php echo View::make("user._menu"); ?>

<div class="container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">

            <div class="panel panel-primary">
                <div class="panel-heading">Login</div>
                <div class="panel-body">

                    <?php echo View::make("user._formLogin", array(
                        "errorLogin" => $errorLogin,
                        "errorBanReason" => $errorBanReason,
                        "errorActivation" => $errorActivation,
                    )); ?>

                </div>
            </div>

        </div>

    </div>
</div>