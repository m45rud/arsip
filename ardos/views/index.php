<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--

Name        : Aplikasi Arsip Dokumen Siswa
Version     : v1.0.0
Description : Aplikasi untuk mengarsipkan data dokumen siswa secara digital.
Date        : 2017
Developer   : M. Rudianto
Phone/WA    : 0852-3290-4156
Email       : rudi@masrud.com
Website     : https://masrud.com

-->
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
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=site_url()?>">SMK Muhammadiyah 3 Nganjuk</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="np"><a class="btn btn-primary" data-toggle="modal" href="#modal-login">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <?php $this->load->view($content)?>
            <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="login">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Login Administrator</h4>
                        </div>
                        <div class="modal-body">
                            <?=form_open('login', 'id="login"')?>
                                <div id='success' class='alert alert-success' role='alert'>
                                    <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                                    <strong>Login berhasil!</strong>
                                    <br>Jika Anda tidak dialihkan secara otomatis, silakan resfresh browser Anda.
                                </div>
                                <div id='failed' class='alert alert-error' role='alert'>
                                    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                                    <strong>Login gagal!</strong>
                                    <br>Username / password salah
                                </div>
                                <div class="form-group">
                                    <input type="text" name="u_name" class="form-control md" id="username" value="<?=set_value('u_name')?>" placeholder="Username" minlength="5" maxlength="20">
                                </div>
                                <div class="form-group input-group">
                                    <input type="password" name="u_pass" class="form-control md"  id="password" value="<?=set_value('u_pass')?>" placeholder="Password" minlength="5" pass-shown="false">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default md sh" id="pass" type="button"><span id="show_pass"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></span></button>
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block md" id="btn-login"><span id="status">Login</span></button>
                            <?=form_close()?>
                            <div class="back">
                                <a class="btn btn-link" href="#forgot" data-toggle="modal">Lupa password?</a>
                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Tutup</button>
                                <div class="collapse" id="forgot">
                                    <div class="well">
                                        Silakan hubungi administrator untuk me-reset password Anda.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('include/footer.php') ?>
    </body>
</html>
