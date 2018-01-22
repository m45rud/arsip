<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data Lemari Terhapus</h2>
<div class="table-responsive">
    <table id="cabinet-deleted" class="display table table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Lemari</th>
                <th width="25%">Dihapus Oleh</th>
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
