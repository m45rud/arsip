<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h1>Selamat Datang <small><?=$this->session->userdata['u_fname']?></small></h1>
<br>
<div class="row">
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-body green">
                <h1 class="ttl"><?=$totalmap?></h1>
            </div>
            <div class="panel-footer green"><h4>Jumlah Map</h4></div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-body yellow">
                <h1 class="ttl"><?=$map?></h1>
            </div>
            <div class="panel-footer yellow"><h4>Map Kosong</h4></div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-body red">
                <h1 class="ttl"><?=$bi?></h1>
            </div>
            <div class="panel-footer red"><h4>Ijazah Dipinjam</h4></div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-body blue">
                <h1 class="ttl"><?=$bs?></h1>
            </div>
            <div class="panel-footer blue"><h4>SKHUN Dipinjam</h4></div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-body green">
                <h1 class="ttl"><?=$mwi?></h1>
            </div>
            <div class="panel-footer green"><h4>Map Tanpa Ijazah</h4></div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-body yellow">
                <h1 class="ttl"><?=$mws?></h1>
            </div>
            <div class="panel-footer yellow"><h4>Map Tanpa SKHUN</h4></div>
        </div>
    </div>
</div>
