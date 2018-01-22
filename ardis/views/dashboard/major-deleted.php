<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data Program Keahlian Terhapus</h2>
<div class="table-responsive">
    <table id="major-deleted" class="display table table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama Kelas</th>
                <th width="15%">Inisial Kelas</th>
                <th width="19%">Dibuat Pada</th>
                <th width="19%">Dihapus Pada</th>
                <th width="12%">Tindakan</th>
            </tr>
        </thead>
    </table>
    <script>
        function confirmDialog() {
            return confirm("Apakah Anda yakin akan merestore data ini?")
        }
    </script>
</div>
