<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Data Program Keahlian <a class="btn btn-success btn-sm add" href="<?=site_url('major/add')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a></h2>
<div class="table-responsive">
    <table id="major" class="display table table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="27%">Nama Program Keahlian</th>
                <th width="20%">Inisial Program Keahlian</th>
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
