
<?php
/**
 * @var string $token
 * @var User $user
 * @var bool $errorEmail
 */
?>


<?php echo Form::open(array(
//    "url"=>"user/reset/$token",
    "id"=>"form-reset",
    "role"=>"form"));
?>

<div class="form-group">
    <?php $inputName = "email"; ?>
    <label for="<?php echo $inputName; ?>">Confirm Email</label>
    <?php echo Form::text($inputName, Input::get($inputName), array("id"=>$inputName, "class"=>"form-control", "placeholder"=>"your@email.com")); ?>
    <?php if ($errorEmail): ?>
        <div class="form-error">Incorrect email address</div>
    <?php endif; ?>
</div>

<div class="form-group">
    <?php $inputName = "password"; ?>
    <label for="<?php echo $inputName; ?>">Password</label>
    <input name="<?php echo $inputName; ?>" type="password" value="<?php echo Input::get($inputName); ?>" id="<?php echo $inputName; ?>" class="form-control" placeholder="password" >
    <div class="form-error"><?php echo $user->validationErrors->first("password"); ?></div>
</div>

<div class="form-group">
    <?php $inputName = "password_confirmation"; ?>
    <label for="<?php echo $inputName; ?>">Confirm password</label>
    <input name="<?php echo $inputName; ?>" type="password" value="<?php echo Input::get($inputName); ?>" id="<?php echo $inputName; ?>" class="form-control" placeholder="confirm password" >
    <div class="form-error"><?php echo $user->validationErrors->first("password_confirmation"); ?></div>
</div>

<div class="text-center">
    <p><button type="submit" class="btn btn-submit">Submit</button></p>
    <p><br/><?php echo HTML::link("user/login", "login"); ?></p>
</div>

<?php echo Form::close(); ?>