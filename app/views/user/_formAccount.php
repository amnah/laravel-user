
<?php
/**
 * @var User $user
 * @var Profile $profile
 * @var bool $errorOldPassword
 */
?>


<?php echo Form::open(array(
//    "url"=>"user/account",
    "id"=>"form-account",
    "role"=>"form"));
?>

<div class="form-group">
    <?php $inputName = "User[oldPassword]"; ?>
    <?php echo Form::label($inputName, "Old password *"); ?>
    <input name="<?php echo $inputName; ?>" type="password" value="<?php echo Input::get("User.oldPassword"); ?>" id="<?php echo $inputName; ?>" class="form-control" placeholder="old password" >
    <?php if ($errorOldPassword): ?>
        <div class="form-error">Invalid password</div>
    <?php endif; ?>
</div>
<hr/>

<div class="form-group">
    <?php $inputName = "User[email]"; ?>
    <?php echo Form::label($inputName, "Email"); ?>
    <?php echo Form::text($inputName, $user->email, array("id"=>$inputName, "class"=>"form-control", "placeholder"=>"your@email.com")); ?>
    <div class="form-error"><?php echo $user->validationErrors->first("email"); ?></div>
</div>
<div class="form-group">
    <?php $inputName = "User[username]"; ?>
    <?php echo Form::label($inputName, "Username"); ?>
    <?php echo Form::text($inputName, $user->username, array("id"=>$inputName, "class"=>"form-control", "placeholder"=>"username")); ?>
    <div class="form-error"><?php echo $user->validationErrors->first("username"); ?></div>
</div>
<div class="form-group">
    <?php $inputName = "User[password]"; ?>
    <?php echo Form::label($inputName, "New password"); ?>
    <input name="<?php echo $inputName; ?>" type="password" value="<?php echo Input::get("User.password"); ?>" id="<?php echo $inputName; ?>" class="form-control" placeholder="leave blank to keep same" >
    <div class="form-error"><?php echo $user->validationErrors->first("password"); ?></div>
</div>
<div class="form-group">
    <?php $inputName = "User[password_confirmation]"; ?>
    <?php echo Form::label($inputName, "Confirm new password"); ?>
    <input name="<?php echo $inputName; ?>" type="password" value="<?php echo Input::get("User.password_confirmation"); ?>" id="<?php echo $inputName; ?>" class="form-control" placeholder="leave blank to keep same" >
    <div class="form-error"><?php echo $user->validationErrors->first("password_confirmation"); ?></div>
</div>
<hr/>

<div class="form-group">
    <?php $inputName = "Profile[first_name]"; ?>
    <?php echo Form::label($inputName, "First name"); ?>
    <?php echo Form::text($inputName, $profile->first_name, array("id"=>$inputName, "class"=>"form-control", "placeholder"=>"first name")); ?>
    <div class="form-error"><?php echo $profile->validationErrors->first("first_name"); ?></div>
</div>
<div class="form-group">
    <?php $inputName = "Profile[last_name]"; ?>
    <?php echo Form::label($inputName, "Last name"); ?>
    <?php echo Form::text($inputName, $profile->last_name, array("id"=>$inputName, "class"=>"form-control", "placeholder"=>"last name")); ?>
    <div class="form-error"><?php echo $profile->validationErrors->first("last_name"); ?></div>
</div>

<div class="text-center">
    <p><button type="submit" class="btn btn-submit">Submit</button></p>
</div>

<?php echo Form::close(); ?>