<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2><?=$form_title?> <?=$s_name?> &nbsp; <a class="btn btn-info btn-sm" href="<?=site_url('document')?>"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"> Kembali</a>
</h2>

<hr>
<?=form_open($action, 'class="form-horizontal"')?>

<div class="row">
    <div class="col-sm-7">
        <h3>Data Siswa</h3>
        <hr>
        <?php if ($this->uri->segment(2) != 'edit') { ?>
            <div class="form-group">
                <label class="col-sm-4 control-label">Cari Siswa</label>
                <div class="col-sm-8">
                    <input type="text" id="find" name="find" class="form-control" value="" placeholder="Nama / NISN">
                </div>
            </div>
        <?php } else if ($this->uri->segment(2) == 'usemap') { ?>
            <div class="form-group">
                <label class="col-sm-4 control-label">Cari Siswa</label>
                <div class="col-sm-8">
                    <input type="text" id="find" name="find" class="form-control" value="" placeholder="Nama / NISN">
                </div>
            </div>
        <?php } ?>
        <div class="form-group">
            <label class="col-sm-4 control-label"></label>
            <div class="col-sm-4">
                <input type="hidden" id="d_sid" name="d_sid" class="form-control" value="<?=(set_value('d_sid')) ? set_value('d_sid') : $document['d_sid']?>" required>
                <small class="text-danger"><?=form_error('d_sid')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">NISN</label>
            <div class="col-sm-4 he">
                <input disabled readonly type="number" id="s_nisn" name="s_nisn" class="form-control" value="<?=(set_value('s_nisn')) ? set_value('s_nisn') : $document['s_nisn']?>" placeholder="NISN" maxlength="20" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Nama</label>
            <div class="col-sm-5 he">
                <input disabled readonly type="text" id="s_name" name="s_name" class="form-control" value="<?=(set_value('s_name')) ? set_value('s_name') : $document['s_name']?>" placeholder="Nama" maxlength="50" required>
                <p id="alr" class="text-danger hide">Data map siswa ini sudah pernah ditambahkan!</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kelas</label>
            <div class="col-sm-2 he">
                <input disabled readonly type="text" id="s_grade" name="s_grade" class="form-control" value="<?=(set_value('s_grade')) ? set_value('s_grade') : $document['s_grade']?>" placeholder="Kelas" maxlength="20" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Program Keahlian</label>
            <div class="col-sm-4 he">
                <input disabled readonly type="text" id="m_name" name="m_name" class="form-control" value="<?=(set_value('m_name')) ? set_value('m_name') : $document['m_name']?>" placeholder="Program Keahlian" maxlength="20" required>
            </div>
        </div>
    </div>

    <div class="col-sm-5">
        <h3>Lokasi Dokumen</h3>
        <hr>
        <?php if (!empty($lastmap['d_kode_map'])) { ?>
            <?php if ($this->uri->segment(2) == 'add') { ?>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        Kode map terakhir kali dibuat <span class="btn btn-danger btn-sm"><?=$lastmap['d_kode_map']?></span>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
        <div class="form-group">
            <label class="col-sm-4 control-label">Lemari</label>
            <div class="col-sm-6">
                <?php if ($this->uri->segment(2) == 'edit' || $this->uri->segment(2) == 'usemap') { ?>
                    <input readonly type="text" id="d_cname" name="d_cname" class="form-control sl" value="<?=(set_value('d_cname')) ? set_value('d_cname') : $document['d_cname']?>" required>
                <?php } else { ?>
                    <select id="d_cname" name="d_cname" class="form-control sl" required>
                        <option></option>
                        <?php foreach ($cabinet->result_array() as $c) { ?>
                            <option value="<?=$c['c_name']?>"><?=$c['c_name']?></option>
                        <?php } ?>
                    </select>
                <?php } ?>
                <small class="text-danger"><?=form_error('d_cname')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Bendel</label>
            <div class="col-sm-6">
                <?php if ($this->uri->segment(2) == 'edit' || $this->uri->segment(2) == 'usemap') { ?>
                    <input readonly type="text" id="d_fname" name="d_fname" class="form-control sl" value="<?=(set_value('d_fname')) ? set_value('d_fname') : $document['d_fname']?>" required>
                <?php } else { ?>
                    <select id="d_fname" name="d_fname" class="form-control sl" required>
                        <option></option>
                        <?php foreach (array_reverse($folder->result_array()) as $f) { ?>
                            <option value="<?=$f['f_name']?>"><?=$f['f_name']?></option>
                        <?php } ?>
                    </select>
                <?php } ?>
                <small class="text-danger"><?=form_error('d_fname')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Map</label>
            <div class="col-sm-6 d_map">
                <?php if ($this->uri->segment(2) == 'edit' || $this->uri->segment(2) == 'usemap') { ?>
                    <input readonly type="text" id="d_map" name="d_map" class="form-control sl" value="<?=$document['d_map']?>" maxlength="20" required>
                <?php } else { ?>
                    <select id="d_map" name="d_map" class="form-control sl" required>
                        <option></option>
                        <?php for($i = 1; $i <= 20; $i++) { ?>
                            <option value="<?=$i?>"><?=$i?></option>
                        <?php } ?>
                    </select>
                <?php } ?>
                <small class="text-danger"><?=form_error('d_map')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kode Map</label>
            <div class="col-sm-6 d_lokasi">
                <input readonly type="text" id="d_kode_map" name="d_kode_map" class="form-control d_lokasi" value="<?=(set_value('d_kode_map')) ? set_value('d_kode_map') : $document['d_kode_map']?>" maxlength="20" required>
                <small class="text-danger"><?=form_error('d_kode_map')?></small>
                <p id="warn" class="text-danger hide">Kode map sudah digunakan!</p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
                <?php if ($this->uri->segment(2) == 'edit') { ?>
                    <button type="submit" name="submit" class="btn btn-success">Simpan</button>&nbsp;
                <?php } else { ?>
                    <button type="submit" name="submit" class="btn btn-success hide" id="submit">Simpan</button>&nbsp;
                <?php } ?>
                <a class="btn btn-default" href="<?=site_url('document')?>">Kembali</a>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-sm-6">
        <h3>Data Dokumen</h3>
        <hr>
        <div class="form-group">
            <label class="col-sm-4 control-label">Ijazah</label>
            <div class="col-sm-5">
                <select name="d_ijazah" class="form-control" required>
                    <option value="<?=(set_value('d_ijazah')) ? set_value('d_ijazah') : $document['d_ijazah']?>"><?=(set_value('d_ijazah')) ? set_value('d_ijazah') : $document['d_ijazah']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_ijazah')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">SKHUN</label>
            <div class="col-sm-5">
                <select name="d_skhun" class="form-control" required>
                    <option value="<?=(set_value('d_skhun')) ? set_value('d_skhun') : $document['d_skhun']?>"><?=(set_value('d_skhun')) ? set_value('d_skhun') : $document['d_skhun']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_skhun')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kartu Keluarga</label>
            <div class="col-sm-5">
                <select name="d_kk" class="form-control" required>
                    <option value="<?=(set_value('d_kk')) ? set_value('d_kk') : $document['d_kk']?>"><?=(set_value('d_kk')) ? set_value('d_kk') : $document['d_kk']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_kk')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">KTP Ayah</label>
            <div class="col-sm-5">
                <select name="d_ktpa" class="form-control" required>
                    <option value="<?=(set_value('d_ktpa')) ? set_value('d_ktpa') : $document['d_ktpa']?>"><?=(set_value('d_ktpa')) ? set_value('d_ktpa') : $document['d_ktpa']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_ktpa')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">KTP Ibu</label>
            <div class="col-sm-5">
                <select name="d_ktpi" class="form-control" required>
                    <option value="<?=(set_value('d_ktpi')) ? set_value('d_ktpi') : $document['d_ktpi']?>"><?=(set_value('d_ktpi')) ? set_value('d_ktpi') : $document['d_ktpi']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_ktpi')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">KIP / KPS</label>
            <div class="col-sm-5">
                <select name="d_kips" class="form-control" required>
                    <option value="<?=(set_value('d_kips')) ? set_value('d_kips') : $document['d_kips']?>"><?=(set_value('d_kips')) ? set_value('d_kips') : $document['d_kips']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_kips')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">SKTM</label>
            <div class="col-sm-5">
                <select name="d_sktm" class="form-control" required>
                    <option value="<?=(set_value('d_sktm')) ? set_value('d_sktm') : $document['d_sktm']?>"><?=(set_value('d_sktm')) ? set_value('d_sktm') : $document['d_sktm']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_sktm')?></small>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <h3>Data Dokumen</h3>
        <hr>
        <div class="form-group">
            <label class="col-sm-4 control-label">Ijazah</label>
            <div class="col-sm-5">
                <select name="d_ijazah" class="form-control" required>
                    <option value="<?=(set_value('d_ijazah')) ? set_value('d_ijazah') : $document['d_ijazah']?>"><?=(set_value('d_ijazah')) ? set_value('d_ijazah') : $document['d_ijazah']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_ijazah')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">SKHUN</label>
            <div class="col-sm-5">
                <select name="d_skhun" class="form-control" required>
                    <option value="<?=(set_value('d_skhun')) ? set_value('d_skhun') : $document['d_skhun']?>"><?=(set_value('d_skhun')) ? set_value('d_skhun') : $document['d_skhun']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_skhun')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Kartu Keluarga</label>
            <div class="col-sm-5">
                <select name="d_kk" class="form-control" required>
                    <option value="<?=(set_value('d_kk')) ? set_value('d_kk') : $document['d_kk']?>"><?=(set_value('d_kk')) ? set_value('d_kk') : $document['d_kk']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_kk')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">KTP Ayah</label>
            <div class="col-sm-5">
                <select name="d_ktpa" class="form-control" required>
                    <option value="<?=(set_value('d_ktpa')) ? set_value('d_ktpa') : $document['d_ktpa']?>"><?=(set_value('d_ktpa')) ? set_value('d_ktpa') : $document['d_ktpa']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_ktpa')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">KTP Ibu</label>
            <div class="col-sm-5">
                <select name="d_ktpi" class="form-control" required>
                    <option value="<?=(set_value('d_ktpi')) ? set_value('d_ktpi') : $document['d_ktpi']?>"><?=(set_value('d_ktpi')) ? set_value('d_ktpi') : $document['d_ktpi']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_ktpi')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">KIP / KPS</label>
            <div class="col-sm-5">
                <select name="d_kips" class="form-control" required>
                    <option value="<?=(set_value('d_kips')) ? set_value('d_kips') : $document['d_kips']?>"><?=(set_value('d_kips')) ? set_value('d_kips') : $document['d_kips']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_kips')?></small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">SKTM</label>
            <div class="col-sm-5">
                <select name="d_sktm" class="form-control" required>
                    <option value="<?=(set_value('d_sktm')) ? set_value('d_sktm') : $document['d_sktm']?>"><?=(set_value('d_sktm')) ? set_value('d_sktm') : $document['d_sktm']?></option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                </select>
                <small class="text-danger"><?=form_error('d_sktm')?></small>
            </div>
        </div>
    </div>
</div>
<?=form_close()?>
