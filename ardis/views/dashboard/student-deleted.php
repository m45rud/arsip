<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data Siswa Terhapus</h2>
<div class="table-responsive">
    <table id="student-deleted" class="display table table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">NISN</th>
                <th width="25%">Nama</th>
                <th width="9%">Tanggal Lahir</th>
                <th width="9%">Jenis Kelamin</th>
                <th width="9%">Kelas</th>
                <th width="9%">Program Keahlian</th>
                <th width="15%">Dihapus Pada</th>
                <th width="9%">Tindakan</th>
            </tr>
        </thead>
    </table>
    <script>
        function confirmDialog() {
            return confirm("Apakah Anda yakin akan merestore data ini?")
        }
    </script>
</div>
