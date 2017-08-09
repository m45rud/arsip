<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data User <a class="btn btn-success btn-sm add" href="<?=site_url('user/add')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a></h2>
<div class="table-responsive">
    <table id="user" class="display table table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">Username</th>
                <th width="22%">Nama Lengkap</th>
                <th width="13%">Level</th>
                <th width="13%">Status</th>
                <th width="15%">Terakhir Login Pada</th>
                <th width="17%">Tindakan</th>
            </tr>
        </thead>
    </table>
    <script>
        function confirmDialog() {
            return confirm("Apakah Anda yakin akan mereset password user ini?")
        }
    </script>
</div>
