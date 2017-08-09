<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?=site_url('assets/img/logo.png')?>">
        <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1">
        <title><?=$title?></title>
        <?=link_tag('assets/css/bootstrap.css?ver=3.3.7')?>
        <?=link_tag('assets/css/style.css?ver=1.0.0')?>
    </head>
    <body onload="window.print()">
        <div class="container isi">
            <div class="row print">
                <div class="col-sm-3" id="foto">
                    <?php if (!empty($student['s_foto'])) { ?>
                        <img class="foto" src="<?=site_url('uploads/foto/'.$student['s_foto'])?>" alt="Foto">
                    <?php } else { ?>
                        <img class="foto" src="<?=site_url('assets/img/avatar.png')?>" alt="Foto">
                    <?php } ?>
                </div>
                <div class="col-sm-9" id="data">
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
                                <td width="150px">Status Siswa</td>
                                <td width="5px">:</td>
                                <td><?=$student['s_is_active']?></td>
                            </tr>
                            <tr>
                                <td width="150px">Kelengkapan Data</td>
                                <td width="5px">:</td>
                                <td>
                                    <?php if ($student['s_status'] == "Lengkap") { ?>
                                        Lengkap
                                    <?php } else if ($student['s_status'] == "Kurang") { ?>
                                        <span class="pku kurang">Kurang</span>
                                    <?php } else { ?>
                                        <span class="pbe belum">Belum Ada Data</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                            <th width="14.285%">Fc IJAZAH</th>
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
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
