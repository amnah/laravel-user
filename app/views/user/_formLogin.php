
<?php
/**
 * @var bool $errorLogin
 * @var string $errorBanReason
 * @var bool $errorActivation
 */
?>


<?php echo Form::open(array(
//    "url"=>"user/login",
    "id"=>"form-login",
    "role"=>"form"));
?>

<div class="form-group">
    <?php $inputName = "email"; ?>
    <?php echo Form::label($inputName, "Email"); ?>
    <?php echo Form::text($inputName, Input::get($inputName), array("id"=>$inputName, "class"=>"form-control", "placeholder"=>"your@email.com")); ?>
</div>
<div class="form-group">
    <?php $inputName = "password"; ?>
    <?php echo Form::label($inputName, "Password"); ?>
    <input name="<?php echo $inputName; ?>" type="password" value="<?php echo Input::get($inputName); ?>" id="<?php echo $inputName; ?>" class="form-control" placeholder="password" >
</div>

<div class="form-error">
    <?php if ($errorLogin): ?>
        Invalid login
    <?php elseif ($errorBanReason): ?>
        User has been banned for: <?php echo $errorBanReason; ?>
    <?php elseif ($errorActivation): ?>
        Please activate your account via email
    <?php endif; ?>
</div>

<div class="checkbox">
    <label>
        <?php echo Form::checkbox("rememberMe", 1, $_POST ? Input::get("rememberMe") : true); ?> Remember me
    </label>
</div>

<div class="text-center">
    <p><button type="submit" class="btn btn-submit">Submit</button></p>
    <p><br/><?php echo HTML::link("user/register", "register"); ?> | <?php echo HTML::link("user/forgot", "forgot?"); ?></p>
</div>

<?php echo Form::close(); ?>