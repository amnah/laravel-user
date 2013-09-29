
<?php
/**
 * @var bool $errorEmail
 */
?>


<?php echo Form::open(array(
//    "url"=>"user/forgot",
    "id"=>"form-forgot",
    "role"=>"form"));
?>

<div class="form-group">
    <?php $inputName = "email"; ?>
    <label for="<?php echo $inputName; ?>">Email</label>
    <?php echo Form::text($inputName, Input::get($inputName), array("id"=>$inputName, "class"=>"form-control", "placeholder"=>"your@email.com")); ?>
</div>

<?php if ($errorEmail): ?>
    <div class="form-error">Email not found</div>
<?php endif; ?>

<div class="text-center">
    <p><button type="submit" class="btn btn-submit">Submit</button></p>
    <p><br/><?php echo HTML::link("user/login", "login"); ?></p>
</div>

<?php echo Form::close(); ?>