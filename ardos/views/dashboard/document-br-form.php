<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->uri->segment(2) == 'borrow') { ?>
    <h2>Pinjam Dokumen&nbsp; <a class="btn btn-info btn-sm" href="<?=site_url('document')?>"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"> Kembali</a></h2>
    <hr>
    <?php if (!empty($bi) || !empty($bs)) { ?>
        <p>Pilih dokumen yang akan dipinjam.</p>
    <?php } else { ?>
        <h4>Tidak ada dokumen yang dapat dipinjam.</h4>
    <?php } ?>
    <?php if (!empty($bi)) { ?>
        <a class="btn btn-success btn mb" onclick="return ijazah()" href="<?=site_url('document/borrow_ijazah/'.$document['d_id'])?>">Ijazah</a>
    <?php } ?>
    <?php if (!empty($bs)) { ?>
        <a class="btn btn-warning btn mb" onclick="return skhun()" href="<?=site_url('document/borrow_skhun/'.$document['d_id'])?>">SKHUN</a>
    <?php } ?>
    <?php if (!empty($bi) && !empty($bs)) { ?>
        <a class="btn btn-danger btn mb" onclick="return ball()" href="<?=site_url('document/borrow_all/'.$document['d_id'])?>">Ijazah &amp; SKHUN</a>
    <?php } ?>

    <script>
        function ijazah() {
            return confirm("Apakah Anda yakin akan meminjam Ijazah?")
        }

        function skhun() {
            return confirm("Apakah Anda yakin akan meminjam SKHUN?")
        }

        function ball() {
            return confirm("Apakah Anda yakin akan meminjam Ijazah dan SKHUN?")
        }
    </script>
<?php } else { ?>

    <h2>Kembalikan Dokumen &nbsp; <a class="btn btn-info btn-sm" href="<?=site_url('document')?>"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"> Kembali</a></h2>
    <hr>
    <?php if (!empty($ri) || !empty($rs)) { ?>
        <p>Pilih dokumen yang akan dikembalikan.</p>
    <?php } else { ?>
        <h4>Tidak ada dokumen yang dapat dikembalikan.</h4>
    <?php } ?>
    <?php if (!empty($ri)) { ?>
        <a class="btn btn-success btn mb" onclick="return ijazah()" href="<?=site_url('document/return_ijazah/'.$document['d_id'])?>">Ijazah</a>
    <?php } ?>
    <?php if (!empty($rs)) { ?>
        <a class="btn btn-warning btn mb" onclick="return skhun()" href="<?=site_url('document/return_skhun/'.$document['d_id'])?>">SKHUN</a>
    <?php } ?>
    <?php if (!empty($ri) && !empty($rs)) { ?>
        <a class="btn btn-danger btn mb" onclick="return ball()" href="<?=site_url('document/return_all/'.$document['d_id'])?>">Ijazah &amp; SKHUN</a>
    <?php } ?>

    <script>
        function ijazah() {
            return confirm("Apakah Anda yakin akan mengembalikan Ijazah?")
        }

        function skhun() {
            return confirm("Apakah Anda yakin akan mengembalikan SKHUN?")
        }

        function ball() {
            return confirm("Apakah Anda yakin akan mengembalikan Ijazah dan SKHUN?")
        }
    </script>
<?php } ?>
