<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2><?=$form_title?></h2>
<hr>
<?=form_open($action, 'class="form-horizontal"')?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Nama Prokli</label>
        <div class="col-sm-6">
            <input type="text" name="m_name" class="form-control" value="<?=(set_value('m_name')) ? set_value('m_name') : $major['m_name']?>" placeholder="Nama Program Keahlian" minlength="5" maxlength="50" required>
            <small class="text-danger"><?=form_error('m_name')?></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Inisial Prokli</label>
        <div class="col-sm-3">
            <input type="text" name="m_id" class="form-control" value="<?=(set_value('m_id')) ? set_value('m_id') : $major['m_id']?>" placeholder="Inisial Program Keahlian" maxlength="5" required>
            <small class="text-danger"><?=form_error('m_id')?></small>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-success">Simpan</button>&nbsp;
            <a class="btn btn-default" href="<?=site_url('major')?>">Kembali</a>
        </div>
    </div>
<?=form_close()?>
