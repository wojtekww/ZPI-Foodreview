
<div class="d-flex bd-highlight p-2">
  <div class="mr-auto p-2 bd-highlight"><h5 class="d-inline-block mt-3"><?php echo $user->userlogin;?></h5></div>
  <form id="<?php echo $user->userid?>" action="../../../modules/update_priv.php" method="post" enctype="multipart/form-data">
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="<?php echo $user->userlogin;?>User" name="uprawnienia" value = "0" <?php if($user->usertype == 0) echo 'checked';?>>
        <label class="custom-control-label" for="<?php echo $user->userlogin;?>User">Zwykły użytkownik</label>
    </div>
    <input id = "userid" name="userid" type="hidden" value="<?php echo $user->userid; ?>">
    <input id = "userlogin" name="userlogin" type="hidden" value="<?php echo $user->userlogin; ?>">
<!-- Default checked -->
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="<?php echo $user->userlogin;?>Restaurator" name="uprawnienia" value ="1" <?php if($user->usertype == 1) echo 'checked';?>>
        <label class="custom-control-label" for="<?php echo $user->userlogin;?>Restaurator">Restaurator</label>
    </div>

    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="<?php echo $user->userlogin;?>Admin" name="uprawnienia" value ="2" <?php if($user->usertype == 2) echo 'checked';?>>
        <label class="custom-control-label" for="<?php echo $user->userlogin;?>Admin">Administrator</label>
    </div>
  <div class="p-2 bd-highlight custom-control-inline"><button class="btn btn-warning float-right d-inline-block mr-3" type="submit" name="edit" value="1">Edytuj</button> </div>
</div>
</form>
<hr>