<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Rekap Pinjaman &nbsp; <a class="btn btn-success btn-sm hp" href="#" onclick="print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a></h2>
<hr>
<div>
    <ul class="nav nav-tabs hp" role="tablist">
        <li role="presentation"><a href="#ijazah" aria-controls="messages" role="tab" data-toggle="tab">IJazah</a></li>
        <li role="presentation"><a href="#skhun" aria-controls="settings" role="tab" data-toggle="tab">SKHUN</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="ijazah">
            <h3>Rekap Ijazah</h3>
            <?php if (!empty($bri)) { ?>
            <table class="table table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Program Keahlian</th>
                            <th>Tanggal</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; foreach ($bri as $i) { $no++ ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$i['s_nisn']?></td>
                                <td><?=$i['s_name']?></td>
                                <td><?=$i['s_grade']?></td>
                                <td><?=$i['s_mid']?></td>
                                <td><?=$i['d_ijazah_borrowed_at']?></td>
                                <td><?=$i['d_ijazah_borrowed_by']?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                Jumlah: <?=count($bri)?>
            <?php } else { ?>
                <br>
                <h4>Tidak ada data!</h4>
            <?php } ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="skhun">
            <h3>Rekap SKHUN</h3>
            <?php if (!empty($brs)) { ?>
                <table class="table table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Program Keahlian</th>
                            <th>Tanggal</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; foreach ($brs as $i) { $no++ ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$i['s_nisn']?></td>
                                <td><?=$i['s_name']?></td>
                                <td><?=$i['s_grade']?></td>
                                <td><?=$i['s_mid']?></td>
                                <td><?=$i['d_skhun_borrowed_at']?></td>
                                <td><?=$i['d_skhun_borrowed_by']?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                Jumlah: <?=count($brs)?>
            <?php } else { ?>
                <br>
                <h4>Tidak ada data!</h4>
            <?php } ?>
        </div>
    </div>
</div>
