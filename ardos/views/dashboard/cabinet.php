<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data Lemari <a class="btn btn-success btn-sm add" href="<?=site_url('cabinet/add')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a></h2>
<div class="table-responsive">
    <table id="cabinet" class="display table table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Lemari</th>
                <th width="27%">Dibuat Oleh</th>
                <th width="18%">Dibuat Pada</th>
                <th width="18%">Diperbarui Pada</th>
                <th width="12%">Tindakan</th>
            </tr>
        </thead>
    </table>
    <script>
        function confirmDialog() {
            return confirm("Apakah Anda yakin akan menghapus data ini?")
        }
    </script>
</div>
