<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2><?=$form_title?></h2>
<hr>
<?=form_open($action, 'class="form-horizontal"')?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Nama Lemari</label>
        <div class="col-sm-5">
            <input type="text" name="c_name" class="form-control" value="<?=(set_value('c_name')) ? set_value('c_name') : $cabinet['c_name']?>" placeholder="Nama Lemari" maxlength="20" required>
            <small class="text-danger"><?=form_error('c_name')?></small>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-success">Simpan</button>&nbsp;
            <a class="btn btn-default" href="<?=site_url('cabinet')?>">Kembali</a>
        </div>
    </div>
<?=form_close()?>
