<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
    if ($this->session->flashdata('alert')) {
        echo $this->session->flashdata('alert');
} ?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=site_url('dashboard')?>"><img class="brand-logo" src="<?=site_url('assets/img/logo.png')?>" alt="ardos">ARDOS</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?=site_url('dashboard')?>">Beranda</a></li>
                <li><a href="<?=site_url('document')?>">Data Dokumen</a></li>
                <li><a href="<?=site_url('cabinet')?>">Data Lemari</a></li>
                <li><a href="<?=site_url('folder')?>">Data Bendel</a></li>
                <li><a href="<?=site_url('document/emptied')?>">Map Kosong</a></li>
                <li><a href="<?=site_url('borrow')?>">Data Pinjam</a></li>
                <li><a href="<?=site_url('document/archived')?>">Arsip Dokumen</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Terhapus <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=site_url('cabinet/deleted')?>">Data Lemari</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?=site_url('folder/deleted')?>">Data Bendel</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?=site_url('document/deleted')?>">Data Dokumen</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?=$this->session->userdata['u_fname']?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=site_url('logout')?>"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
