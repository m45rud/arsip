<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Rekap Kelengkapan Data Siswa</h2>
<hr>
<?=form_open('report', 'class="form-inline hp" id="report"')?>
    <div class="form-group">
        <select name="s_grade" class="form-control" id="s_grade">
          <option>Pilih Kelas</option>
          <option value="X">X</option>
          <option value="XI">XI</option>
          <option value="XII">XII</option>
        </select>
        <?=form_error('s_grade')?>

        <select name="m_initial" class="form-control" id="m_id">
            <option>Pilih Program Keahlian</option>
            <?php foreach ($majors as $data) { ?>
                <option value="<?=$data->m_id?>"><?=$data->m_name?></option>
            <?php } ?>
        </select>

        <select name="s_status" class="form-control" id="s_status">
            <option>Pilih Status Kelengkapan Data</option>
            <option value="Belum Ada Data">Belum Ada Data</option>
            <option value="Kurang">Kurang</option>
            <option value="Lengkap">Lengkap</option>
        </select>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary hp" name="tampilkan" id="tampilkan"><span id="tampil">Tampilkan</span></button>
        </div>
    </div>
<?=form_close()?>
<div id="result"></div>
