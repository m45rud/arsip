<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data Dokumen Siswa Terhapus</h2>
<div class="table-responsive">
    <table id="document-deleted" class="display table table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">NISN</th>
                <th width="18%">Nama</th>
                <th width="5%">Kelas</th>
                <th width="5%">Program Keahlian</th>
                <th width="5%">Kode Map</th>
                <th width="12%">Dihapus Oleh</th>
                <th width="12%">Dihapus Pada</th>
                <th width="10%">Tindakan</th>
            </tr>
        </thead>
    </table>
    <script>
        function confirmDialog() {
            return confirm("Apakah Anda yakin akan menghapus data ini?")
        }
    </script>
</div>
