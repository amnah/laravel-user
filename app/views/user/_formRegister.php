
<?php
/**
 * @var User $user
 * @var Profile $profile
 */
?>

<?php echo Form::open(array(
//    "url"=>"user/register",
    "id"=>"form-register",
    "role"=>"form"));
?>

<div class="form-group">
    <?php $inputName = "User[email]"; ?>
    <?php echo Form::label($inputName, "Email *"); ?>
    <?php echo Form::text($inputName, $user->email, array("id"=>$inputName, "class"=>"form-control", "placeholder"=>"your@email.com")); ?>
    <div class="form-error"><?php echo $user->validationErrors->first("email"); ?></div>
</div>
<div class="form-group">
    <?php $inputName = "User[username]"; ?>
    <?php echo Form::label($inputName, "Username *"); ?>
    <?php echo Form::text($inputName, $user->username, array("id"=>$inputName, "class"=>"form-control", "placeholder"=>"username")); ?>
    <div class="form-error"><?php echo $user->validationErrors->first("username"); ?></div>
</div>
<div class="form-group">
    <?php $inputName = "User[password]"; ?>
    <?php echo Form::label($inputName, "Password *"); ?>
    <input name="<?php echo $inputName; ?>" type="password" value="<?php echo $user->password; ?>" id="<?php echo $inputName; ?>" class="form-control" placeholder="password" >
    <div class="form-error"><?php echo $user->validationErrors->first("password"); ?></div>
</div>

<?php /*

// UNCOMMENT IF YOU WANT PROFILE FIELDS IN THIS FORM. CONTROLLER LOGIC ALREADY HANDLES IT

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
*/ ?>

<div class="text-center">
    <p><button type="submit" class="btn btn-submit">Submit</button></p>
    <p><br/><?php echo HTML::link("user/login", "login"); ?> </p>
</div>

<?php echo Form::close(); ?>