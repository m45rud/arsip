<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2><?=$form_title?></h2>
<hr>
<?=form_open($action, 'class="form-horizontal"')?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Nama Bendel</label>
        <div class="col-sm-5">
            <input type="text" name="f_name" class="form-control" value="<?=(set_value('f_name')) ? set_value('f_name') : $folder['f_name']?>" placeholder="Nama Bendel" maxlength="20" required>
            <small class="text-danger"><?=form_error('f_name')?></small>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-success">Simpan</button>&nbsp;
            <a class="btn btn-default" href="<?=site_url('folder')?>">Kembali</a>
        </div>
    </div>
<?=form_close()?>
