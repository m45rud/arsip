<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="wrapper">
    <div class="header">
        <div class="logo">
            <img src="<?=site_url('assets/img/logo.png')?>" alt="Logo">
        </div>
        <h1>Arsip Dokumen Siswa</h1>
        <h3>SMK Muhammadiyah 3 Nganjuk</h3>
        <p>Cari lokasi arsip dokumen siswa yang sudah melengkapi data administrasi sekolah.</p>
    </div>
    <div class="center">
        <?=form_open($action, 'class="form-inline"')?>
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon md"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></div>
                    <input type="text" class="form-control md search" id="search" placeholder="NISN / Nama" autocomplete="off" required>
                </div>
            </div>
            <div id="hint">
                <p class="help-block">Masukkan NISN / nama maka hasil akan otomatis ditampilkan disini.<br>
            </div>
        <?=form_close()?>
    </div>
</div>
