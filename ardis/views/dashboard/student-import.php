<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2><?=$form_title?></h2>
<hr>
<?=form_open_multipart($action, 'class="form-horizontal"')?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Impor Data Siswa</label>
        <div class="col-sm-4">
            <input type="file" name="scsv" accept=".csv" required>
            <small class="text-danger"><?=form_error('scsv')?></small>
            <small class="help-block">Pilih file berformat *.csv dengan ukuran maksimal 2 MB.</small>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success" name="import">Simpan</button>&nbsp;
            <a class="btn btn-default" href="<?=site_url('student')?>">Kembali</a>
        </div>
    </div>
<?=form_close()?>
