
<?php
/**
 * @var \Illuminate\Database\Eloquent\Collection $users
 */
?>


<?php echo View::make("user._menu"); ?>

<div class="container">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3">

            <?php if ($deleteUser = Session::get("delete-success")): ?>

                <div class="alert alert-success">
                    <p>User deleted [ <strong><?php echo $deleteUser->email; ?> / <?php echo $deleteUser->username; ?></strong> ]</p>
                </div>

            <?php elseif ($restoreUser = Session::get("restore-success")): ?>

                <div class="alert alert-success">
                    <p>User restored [ <strong><?php echo $restoreUser->email; ?> / <?php echo $restoreUser->username; ?></strong> ]</p>
                </div>

            <?php endif; ?>

            <div class="panel panel-primary">
                <div class="panel-heading">List</div>
                <div class="panel-body">
                    <table border="1">

                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->username; ?></td>
                                <td><?php echo $user->status ? "Active" : "Inactive"; ?></td>
                                <td><?php echo $user->created_at; ?></td>
                                <td><?php echo HTML::link("admin/edit/{$user->id}", "edit"); ?></td>
                                <td>

                                    <?php if ($user->deleted_at): ?>
                                        <?php echo Form::open(array("url"=>"admin/restore")); ?>
                                        <?php echo Form::hidden("userId", $user->id); ?>
                                        <button type="submit" class="btn btn-submit">restore</button>
                                        <?php echo Form::close(); ?>
                                    <?php else: ?>
                                        <?php echo Form::open(array("url"=>"admin/delete")); ?>
                                        <?php echo Form::hidden("userId", $user->id); ?>
                                        <button type="submit" class="btn btn-submit">soft delete</button>
                                        <?php echo Form::close(); ?>
                                    <?php endif; ?>


                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                </div>
            </div>

        </div>

    </div>
</div>