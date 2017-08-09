<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row print">
    <div class="col-sm-3" id="foto">
        <?php if (!empty($student['s_foto'])) { ?>
            <img class="foto" src="<?=site_url('uploads/foto/'.$student['s_foto'])?>" alt="Foto">
        <?php } else { ?>
            <img class="foto" src="<?=site_url('assets/img/avatar.png')?>" alt="Foto">
        <?php } ?>
    </div>
    <div class="col-sm-7" id="data">
        <table class="table siswa">
            <tbody>
                <tr>
                    <td width="150px">NISN</td>
                    <td width="5px">:</td>
                    <td><?=$student['s_nisn']?></td>
                </tr>
                <tr>
                    <td width="150px">Nama</td>
                    <td width="5px">:</td>
                    <td><?=$student['s_name']?></td>
                </tr>
                <tr>
                    <td width="150px">Tanggal Lahir</td>
                    <td width="5px">:</td>
                    <td><?=$student['s_dob']?></td>
                </tr>
                <tr>
                    <td width="150px">Jenis Kelamin</td>
                    <td width="5px">:</td>
                    <td><?=$student['s_gender']?></td>
                </tr>
                <tr>
                    <td width="150px">Kelas</td>
                    <td width="5px">:</td>
                    <td><?=$student['s_grade']?></td>
                </tr>
                <tr>
                    <td width="150px">Program Keahlian</td>
                    <td width="5px">:</td>
                    <td><?=$student['m_name']?></td>
                </tr>

                <?php if ($student['s_is_active'] == "Aktif") { ?>
                    <tr>
                        <td width="150px">Tahun Masuk</td>
                        <td width="5px">:</td>
                        <td><?=$student['s_yi']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Tahun Keluar</td>
                        <td width="5px">:</td>
                        <td>&minus;</td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td width="150px">Tahun Masuk</td>
                        <td width="5px">:</td>
                        <td><?=$student['s_yi']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Tahun Keluar</td>
                        <td width="5px">:</td>
                        <td><?=$student['s_yo']?></td>
                    </tr>
                <?php } ?>

                <tr>
                    <td width="150px">Status</td>
                    <td width="5px">:</td>
                    <td><?=$student['s_is_active']?></td>
                </tr>
                <tr>
                    <td width="150px">Kelengkapan Data</td>
                    <td width="5px">:</td>
                    <td>
                        <?php if ($student['s_status'] == "Lengkap") { ?>
                            <span class="btn btn-success btn-sm">Lengkap</span>
                        <?php } else if ($student['s_status'] == "Kurang") { ?>
                            <span class="btn btn-warning btn-sm kurang">Kurang</span>
                        <?php } else { ?>
                            <span class="btn btn-danger btn-sm belum">Belum Ada Data</span>
                        <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-2">
        <a class="btn btn-success pull-right mb hp" href="<?=site_url()?>"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Kembali</a>
        <a class="btn btn-info pull-right mb hp" href="#" onclick="window.print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>
    </div>
</div>
<div class="tc">
    <h3><?=$attachment?></h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="14.285%">Fc Kartu Keluarga</th>
                <th width="14.285%">Fc KTP Ayah</th>
                <th width="14.285%">Fc KTP Ibu</th>
                <th width="14.285%">Fc KIP / KPS</th>
                <th width="14.285%">Fc SKTM</th>
                <th width="14.285%">Fc Ijazah</th>
                <th width="14.285%">Fc SKHUN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?=(!empty($student['s_kk'])) ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : "&minus;";?></td>
                <td><?=(!empty($student['s_ktpa'])) ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : "&minus;";?></td>
                <td><?=(!empty($student['s_ktpi'])) ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : "&minus;";?></td>
                <td><?=(!empty($student['s_kips'])) ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : "&minus;";?></td>
                <td><?=(!empty($student['s_sktm'])) ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : "&minus;";?></td>
                <td><?=(!empty($student['s_ijazah'])) ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : "&minus;";?></td>
                <td><?=(!empty($student['s_skhun'])) ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : "&minus;";?></td>
            </tr>
            <tr class="hp">
                <td>
                    <?php if (!empty($student['s_kk'])) { ?>
                        <a class="btn btn-default btn-xs hp" href="<?=site_url('uploads/kk/'.$student['s_kk'])?>" target="_blank">Lihat</a>
                    <?php } ?>
                </td>
                <td>
                    <?php if (!empty($student['s_ktpa'])) { ?>
                        <a class="btn btn-default btn-xs hp" href="<?=site_url('uploads/ktpa/'.$student['s_ktpa'])?>" target="_blank">Lihat</a>
                    <?php } ?>
                </td>
                <td>
                    <?php if (!empty($student['s_ktpi'])) { ?>
                        <a class="btn btn-default btn-xs hp" href="<?=site_url('uploads/ktpi/'.$student['s_ktpi'])?>" target="_blank">Lihat</a>
                    <?php } ?>
                </td>
                <td>
                    <?php if (!empty($student['s_kips'])) { ?>
                        <a class="btn btn-default btn-xs hp" href="<?=site_url('uploads/kips/'.$student['s_kips'])?>" target="_blank">Lihat</a>
                    <?php } ?>
                </td>
                <td>
                    <?php if (!empty($student['s_sktm'])) { ?>
                        <a class="btn btn-default btn-xs hp" href="<?=site_url('uploads/sktm/'.$student['s_sktm'])?>" target="_blank">Lihat</a>
                    <?php } ?>
                </td>
                <td>
                    <?php if (!empty($student['s_ijazah'])) { ?>
                        <a class="btn btn-default btn-xs hp" href="<?=site_url('uploads/ijazah/'.$student['s_ijazah'])?>" target="_blank">Lihat</a>
                    <?php } ?>
                </td>
                <td>
                    <?php if (!empty($student['s_skhun'])) { ?>
                        <a class="btn btn-default btn-xs hp" href="<?=site_url('uploads/skhun/'.$student['s_skhun'])?>" target="_blank">Lihat</a>
                    <?php } ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
