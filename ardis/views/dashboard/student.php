<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data Siswa <a class="btn btn-success btn-sm add" href="<?=site_url('student/add')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a><a class="btn btn-success btn-sm add" href="<?=site_url('student/import')?>">Import Data</a></h2>
<div class="table-responsive">
    <table id="student" class="display table table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">NISN</th>
                <th width="25%">Nama</th>
                <th width="10%">Tanggal Lahir</th>
                <th width="10%">Jenis Kelamin</th>
                <th width="5%">Kelas</th>
                <th width="10%">Program Keahlian</th>
                <th width="10%">Kelengkapan Data</th>
                <th width="10%">Tindakan</th>
            </tr>
        </thead>
    </table>
    <script>
        function confirmDialog() {
            return confirm("Apakah Anda yakin akan menghapus data ini?")
        }

        function confirmDialogStatus() {
            <?php if ($this->session->userdata['u_level'] == "Administrator") { ?>
                return confirm("Apakah Anda yakin akan mengubah status data ini menjadi tidak aktif?")
            <?php } else { ?>
                window.alert("Hanya Administrator yang boleh mengubah status data!")
            <?php } ?>
        }
    </script>
</div>
