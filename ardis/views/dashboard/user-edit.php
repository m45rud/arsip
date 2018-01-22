<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Edit User <?=$user['u_fname']?></h2>
<hr>
<?=($user['u_id'] == 'xB3gG') ? redirect('user') : "";?>
<?=form_open('user/edit', 'class="form-horizontal"');
echo form_hidden('u_id', $user['u_id'])?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Username</label>
        <div class="col-sm-4">
            <input disabled type="text" name="u_name" class="form-control" value="<?=$user['u_name']?>" placeholder="Username" minlength="5" maxlength="20" required>
            <small class="text-danger"><?=form_error('u_name')?></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Password</label>
        <div class="col-sm-4">
            <input disabled type="password" name="u_pass" class="form-control" value="<?=$user['u_pass']?>" placeholder="Password" minlength="5" required>
            <small class="text-danger"><?=form_error('u_pass')?></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Nama Lengkap</label>
        <div class="col-sm-5">
            <input disabled type="nama" name="u_fname" class="form-control" value="<?=$user['u_fname']?>" placeholder="Nama Lengkap" minlength="3" maxlength="50" required>
            <small class="text-danger"><?=form_error('u_fname')?></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Level</label>
        <div class="col-sm-3">
            <select <?php if ($user['u_id'] == $this->session->userdata['u_id']) { echo "disabled"; } ?> class="form-control" name="u_level">
                <option value="<?=$user['u_level']?>"><?=$user['u_level']?></option>
                <option value="Administrator">Administrator</option>
                <option value="User Biasa">User Biasa</option>
            </select>
            <small class="text-danger"><?=form_error('u_level')?></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Status</label>
        <div class="col-sm-3">
            <select <?php if ($user['u_id'] == $this->session->userdata['u_id']) { echo "disabled"; } ?> class="form-control" name="u_is_active">
                <option value="<?=$user['u_is_active']?>"><?=$user['u_is_active']?></option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
            <small class="text-danger"><?=form_error('u_is_active')?></small>
        </div>
    </div>
    <div class="form-group">
        <?php if ($user['u_id'] != $this->session->userdata['u_id']) { ?>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit" class="btn btn-success">Simpan</button>&nbsp;
                <a class="btn btn-default" href="<?=site_url('user')?>">Kembali</a>
            </div>
        <?php } else { ?>
            <div class="col-sm-offset-2 col-sm-10">
                <p class="help-block">Anda tidak diperbolehkan mengubah level dan status akun Anda.</p>
                <a class="btn btn-default" href="<?=site_url('user')?>">Kembali</a>
            </div>
        <?php } ?>
    </div>
<?=form_close()?>
