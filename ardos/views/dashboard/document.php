<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data Dokumen Siswa
    <?php if(empty($map)) { ?>
        <a class="btn btn-success btn-sm add" href="<?=site_url('document/add')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a>
    <?php } ?>
</h2>
<div class="table-responsive">
    <table id="document" class="display table table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">NISN</th>
                <th width="22%">Nama</th>
                <th width="8%">Kelas</th>
                <th width="8%">Program Keahlian</th>
                <th width="5%">Lemari</th>
                <th width="5%">Bendel</th>
                <th width="5%">Map</th>
                <th width="8%">Kode Map</th>
                <th width="18%">Tindakan</th>
            </tr>
        </thead>
    </table>
    <script>
        function confirmDialog() {
            return confirm("Apakah Anda yakin akan menghapus data ini?")
        }

        function confirmDialogTake() {
            return confirm("Setelah data diambil, status siswa akan menjadi tidak aktif, data dokumen akan diarsipkan dan map akan dikosongkan. Anda yakin ingin melanjutkan?")
        }
    </script>
</div>
