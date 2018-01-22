<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h1>Selamat Datang <small><?=$this->session->userdata['u_fname']?></small></h1>
<h3>Berikut adalah statistik data siswa Siswa &nbsp;<a class="btn btn-success btn-sm" href="<?=site_url('report')?>">Lihat Rekap Data Siswa</a>
</h3>
<br>
<div class="row">
    <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Status Kelengkapan Data Siswa Total</h3>
            </div>
            <div class="panel-body row">
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-body red">
                            <h1 class="ttl"><?=$persenb?>%</h1>
                            <h3><?=$totalb?> Siswa</h3>
                        </div>
                        <div class="panel-footer red">Belum Ada Data</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-body yellow">
                            <h1 class="ttl"><?=$persenk?>%</h1>
                            <h3><?=$totalk?> Siswa</h3>
                        </div>
                        <div class="panel-footer yellow">Kurang</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-body green">
                            <h1 class="ttl"><?=$persenl?>%</h1>
                            <h3><?=$totall?> Siswa</h3>
                        </div>
                        <div class="panel-footer green">Lengkap</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Jumlah Siswa Aktif</h3>
            </div>
            <div class="panel-body blue">
                <h1 class="total"><?=$total?></h1>
                <h2>Siswa</h2>
            </div>
        </div>
    </div>
</div>
