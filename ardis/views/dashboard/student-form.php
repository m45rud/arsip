<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2><?=$form_title?></h2>
<hr>
<?=form_open_multipart($action, 'class="form-horizontal"')?>
<h3>Data Siswa</h3>
<hr>
    <div class="form-group">
        <label class="col-sm-2 control-label">NISN</label>
        <div class="col-sm-4">
            <input type="number" name="s_nisn" class="form-control" value="<?=isset($student['s_nisn']) ? $student['s_nisn'] : set_value('s_nisn')?>" placeholder="NISN" required>
            <small class="text-danger"><?=form_error('s_nisn')?></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Nama</label>
        <div class="col-sm-6">
            <input type="text" name="s_name" class="form-control" value="<?=isset($student['s_name']) ? $student['s_name'] : set_value('s_name')?>" placeholder="Nama" required>
            <small class="text-danger"><?=form_error('s_name')?></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Tanggal Lahir</label>
        <div class="col-sm-3">
            <input type="date" name="s_dob" class="form-control" value="<?=isset($student['s_dob']) ? $student['s_dob'] : set_value('s_dob')?>" placeholder="Tanggal Lahir" required>
            <small class="text-danger"><?=form_error('s_dob')?></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Jenis Kelamin</label>
        <div class="col-sm-3">
            <select name="s_gender" class="form-control" required>
                <option value="<?=isset($student['s_gender']) ? $student['s_gender'] : set_value('s_gender')?>"><?=isset($student['s_gender']) ? $student['s_gender'] : set_value('s_gender')?></option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <small class="text-danger"><?=form_error('s_gender')?></small>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Kelas</label>
        <div class="col-sm-2">
            <select required name="s_grade" class="form-control">
                <option value="<?=isset($student['s_grade']) ? $student['s_grade'] : set_value('s_grade')?>"><?=isset($student['s_grade']) ? $student['s_grade'] : set_value('s_grade')?></option>
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
            </select>
            <small class="text-danger"><?=form_error('s_grade')?></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Program Keahlian</label>
        <div class="col-sm-3">
            <select name="s_mid" class="form-control" required>
                <option value="<?=isset($student['s_mid']) ? $student['s_mid'] : set_value('s_mid')?>"><?=isset($student['s_mid']) ? $student['s_mid'] : set_value('s_mid')?></option>
                <?php foreach (array_reverse($majors) as $row) {     ?>
                    <option value="<?=$row['m_id']?>"><?=$row['m_name']?></option>
                <?php } ?>
            </select>
            <small class="text-danger"><?=form_error('s_mid')?></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Tahun Masuk</label>
        <div class="col-sm-2">
            <select name="s_yi" class="form-control" required>
                <option value="<?=isset($student['s_yi']) ? $student['s_yi'] : set_value('s_yi')?>"><?=isset($student['s_yi']) ? $student['s_yi'] : set_value('s_yi')?></option>
                <?php for ($i = date('Y') - 2; $i <= date('Y') + 2; $i++) { ?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?php } ?>
            </select>
            <small class="text-danger"><?=form_error('s_yi')?></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto</label>
        <div class="col-sm-10">
            <?php if ($this->uri->segment(2) == 'edit') { ?>
                <?php if (file_exists('./uploads/foto/' . $student['s_foto'])) { ?>
                    <a href="<?=site_url('uploads/foto/' . $student['s_foto'])?>" target="_blank" ><?=$student['s_foto']?></a>
                <?php } ?>
                <input type="file" name="s_foto">
                <small class="help-block">Format gambar yang diperbolehkan *.png, *.jpg dan ukuran maksimal 1 MB.</small>
                <small class="text-danger"><?=!empty($err_foto) ? $err_foto : "";?></small>
            <?php } else { ?>
                <input type="file" name="s_foto">
                <small class="help-block">Format gambar yang diperbolehkan *.png, *.jpg dan ukuran maksimal 1 MB.</small>
                <small class="text-danger"><?=!empty($err_foto) ? $err_foto : "";?></small>
            <?php } ?>
        </div>
    </div>
    <hr>
    <h3>Lampiran</h3>
    <p class="help-block">Format gambar yang diperbolehkan *.png, *.jpg dan ukuran maksimal 2 MB.</p>
    <hr>
    <div class="form-group">
        <label class="col-sm-2 control-label">Kartu Keluarga</label>
        <div class="col-sm-10">
            <?php if ($this->uri->segment(2) == 'edit') { ?>
                <?php if (file_exists('./uploads/kk/' . $student['s_kk'])) { ?>
                    <a href="<?=site_url('uploads/kk/' . $student['s_kk'])?>" target="_blank" ><?=$student['s_kk']?></a>
                <?php } ?>
                <input type="file" name="s_kk">
                <small class="text-danger"><?=!empty($err_kk) ? $err_kk : "";?></small>
            <?php } else { ?>
                <input type="file" name="s_kk">
                <small class="text-danger"><?=!empty($err_kk) ? $err_kk : "";?></small>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">KTP Ayah</label>
        <div class="col-sm-10">
            <?php if ($this->uri->segment(2) == 'edit') { ?>
                <?php if (file_exists('./uploads/ktpa/' . $student['s_ktpa'])) { ?>
                    <a href="<?=site_url('uploads/ktpa/' . $student['s_ktpa'])?>" target="_blank" ><?=$student['s_ktpa']?></a>
                <?php } ?>
                <input type="file" name="s_ktpa">
                <small class="text-danger"><?=!empty($err_ktpa) ? $err_ktpa : "";?></small>
            <?php } else { ?>
                <input type="file" name="s_ktpa">
                <small class="text-danger"><?=!empty($err_ktpa) ? $err_ktpa : "";?></small>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">KTP Ibu</label>
        <div class="col-sm-10">
            <?php if ($this->uri->segment(2) == 'edit') { ?>
                <?php if (file_exists('./uploads/ktpi/' . $student['s_ktpi'])) { ?>
                    <a href="<?=site_url('uploads/ktpi/' . $student['s_ktpi'])?>" target="_blank" ><?=$student['s_ktpi']?></a>
                <?php } ?>
                <input type="file" name="s_ktpi">
                <small class="text-danger"><?=!empty($err_ktpi) ? $err_ktpi : "";?></small>
            <?php } else { ?>
                <input type="file" name="s_ktpi">
                <small class="text-danger"><?=!empty($err_ktpi) ? $err_ktpi : "";?></small>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">KIP / KPS</label>
        <div class="col-sm-10">
            <?php if ($this->uri->segment(2) == 'edit') { ?>
                <?php if (file_exists('./uploads/kips/' . $student['s_kips'])) { ?>
                    <a href="<?=site_url('uploads/kips/' . $student['s_kips'])?>" target="_blank" ><?=$student['s_kips']?></a>
                <?php } ?>
                <input type="file" name="s_kips">
                <small class="text-danger"><?=!empty($err_kips) ? $err_kips : "";?></small>
            <?php } else { ?>
                <input type="file" name="s_kips">
                <small class="text-danger"><?=!empty($err_kips) ? $err_kips : "";?></small>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">SK Tidak Mampu</label>
        <div class="col-sm-10">
            <?php if ($this->uri->segment(2) == 'edit') { ?>
                <?php if (file_exists('./uploads/sktm/' . $student['s_sktm'])) { ?>
                    <a href="<?=site_url('uploads/sktm/' . $student['s_sktm'])?>" target="_blank" ><?=$student['s_sktm']?></a>
                <?php } ?>
                <input type="file" name="s_sktm">
                <small class="text-danger"><?=!empty($err_sktm) ? $err_sktm : "";?></small>
            <?php } else { ?>
                <input type="file" name="s_sktm">
                <small class="text-danger"><?=!empty($err_sktm) ? $err_sktm : "";?></small>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Ijazah</label>
        <div class="col-sm-10">
            <?php if ($this->uri->segment(2) == 'edit') { ?>
                <?php if (file_exists('./uploads/ijazah/' . $student['s_ijazah'])) { ?>
                    <a href="<?=site_url('uploads/ijazah/' . $student['s_ijazah'])?>" target="_blank" ><?=$student['s_ijazah']?></a>
                <?php } ?>
                <input type="file" name="s_ijazah">
                <small class="text-danger"><?=!empty($err_ijazah) ? $err_ijazah : "";?></small>
            <?php } else { ?>
                <input type="file" name="s_ijazah">
                <small class="text-danger"><?=!empty($err_ijazah) ? $err_ijazah : "";?></small>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">SKHUN</label>
        <div class="col-sm-10">
            <?php if ($this->uri->segment(2) == 'edit') { ?>
                <?php if (file_exists('./uploads/skhun/' . $student['s_skhun'])) { ?>
                    <a href="<?=site_url('uploads/skhun/' . $student['s_skhun'])?>" target="_blank" ><?=$student['s_skhun']?></a>
                <?php } ?>
                <input type="file" name="s_skhun">
                <small class="text-danger"><?=!empty($err_skhun) ? $err_skhun : "";?></small>
            <?php } else { ?>
                <input type="file" name="s_skhun">
                <small class="text-danger"><?=!empty($err_skhun) ? $err_skhun : "";?></small>
            <?php } ?>
        </div>
    </div>
    <hr>
    <h3>Status Kelengkapan Data</h3>
    <p class="help-block">Pilih status kelengkapan data berdasarkan lampiran.</p>
    <hr>
    <div class="form-group">
        <label class="col-sm-2 control-label">Status Data</label>
        <div class="col-sm-3">
            <select id="s_status" name="s_status" class="form-control" required>
                <option></option>
                <option value="Belum Ada Data">Belum Ada Data</option>
                <option value="Kurang">Kurang</option>
                <option value="Lengkap">Lengkap</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <small class="help-block hint">Tombol simpan akan muncul setelah Anda memilih status kelengkapan data.</small>
            <br>
            <button type="submit" name="submit" class="btn btn-success hide" id="submit">Simpan</button>&nbsp;
            <a class="btn btn-default" href="<?=site_url('student')?>">Kembali</a>
        </div>
    </div>
<?=form_close()?>
