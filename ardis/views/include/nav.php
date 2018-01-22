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
            <a class="navbar-brand" href="<?=site_url('dashboard')?>"><img class="brand-logo" src="<?=site_url('assets/img/logo.png')?>" alt="">ARDIS</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?=site_url('dashboard')?>">Beranda</a></li>
                <li><a href="<?=site_url('student')?>">Data Siswa</a></li>
                <li><a href="<?=site_url('report')?>">Laporan</a></li>
                <?php if ($this->session->userdata['u_level'] == "Administrator")  { ?>
                    <li><a href="<?=site_url('major')?>">Data Prokli</a></li>
                    <li><a href="<?=site_url('student/archived')?>">Arsip Siswa</a></li>
                <?php } ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Terhapus <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=site_url('student/deleted')?>">Data Siswa</a></li>
                        <?php if ($this->session->userdata['u_level'] == "Administrator")  { ?>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?=site_url('major/deleted')?>">Data Prokli</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if ($this->session->userdata['u_level'] == "Administrator")  { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pengaturan <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=site_url('user')?>">Manajemen User</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?=$this->session->userdata['u_fname']?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=site_url('user/profile')?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Ubah Password</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?=site_url('logout')?>"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
