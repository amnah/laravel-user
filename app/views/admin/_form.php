
<?php
/**
 * @var User $user
 * @var Profile $profile
 */
?>

<?php echo Form::open(array(
//    "url"=>"user/register",
    "id"=>"form-create",
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
    <input name="<?php echo $inputName; ?>" type="password" value="<?php echo Input::get("User.password"); ?>" id="<?php echo $inputName; ?>" class="form-control" placeholder="password" >
    <div class="form-error"><?php echo $user->validationErrors->first("password"); ?></div>
</div>
<div class="form-group">
    <?php $inputName = "User[role_id]"; ?>
    <?php echo Form::label($inputName, "User role *"); ?>
    <?php echo Form::select($inputName, array(2=>"User",1=>"Admin"), $user->role_id, array("id"=>$inputName, "class"=>"form-control")); ?>
    <div class="form-error"><?php echo $user->validationErrors->first("role_id"); ?></div>
</div>
<div class="form-group">
    <?php $inputName = "User[status]"; ?>
    <?php echo Form::label($inputName, "Status *"); ?>
    <?php echo Form::select($inputName, array(0=>"Inactive",1=>"Active"), $user->status, array("id"=>$inputName, "class"=>"form-control")); ?>
    <div class="form-error"><?php echo $user->validationErrors->first("status"); ?></div>
</div>
<div class="form-group">
    <?php $inputName = "User[banned_at]"; ?>
    <?php echo Form::label($inputName, "Banned at"); ?>
    <?php echo Form::text($inputName, $user->banned_at, array("id"=>$inputName, "class"=>"form-control", "placeholder"=>"2013-12-31")); ?>
    <div class="form-error"><?php echo $user->validationErrors->first("banned_at"); ?></div>
</div>
<div class="form-group">
    <?php $inputName = "User[ban_reason]"; ?>
    <?php echo Form::label($inputName, "Ban reason"); ?>
    <?php echo Form::text($inputName, $user->ban_reason, array("id"=>$inputName, "class"=>"form-control", "placeholder"=>"why ban?")); ?>
    <div class="form-error"><?php echo $user->validationErrors->first("ban_reason"); ?></div>
</div>

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
    <p><br/><?php echo HTML::link("user/login", "login"); ?> </p>
</div>

<?php echo Form::close(); ?>