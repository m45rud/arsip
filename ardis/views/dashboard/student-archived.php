<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Arsip Data Siswa</h2>
<p>Data siswa yang tidak aktif/sudah keluar.</p>
<div class="table-responsive">
    <table id="student-archived" class="display table table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="14%">NISN</th>
                <th width="21%">Nama</th>
                <th width="10%">Jenis Kelamin</th>
                <th width="7%">Kelas</th>
                <th width="7%">Program Keahlian</th>
                <th width="7%">Tahun Masuk</th>
                <th width="7%">Tahun Keluar</th>
                <th width="7%">Status</th>
                <th width="32%">Tindakan</th>
            </tr>
        </thead>
    </table>
    <script>
        function confirmDialog() {
            return confirm("Apakah Anda yakin akan mengubah status data ini menjadi aktif?")
        }
    </script>
</div>
