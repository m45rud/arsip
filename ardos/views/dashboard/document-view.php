<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ($this->uri->segment(2) == 'view') { ?>
    <div class="row print">
        <div class="col-sm-5" id="data">
            <table class="table siswa">
                <h3>Biodata Siswa</h3><hr class="hp">
                <tbody>
                    <tr>
                        <td width="150px">NISN</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_nisn']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Nama</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_name']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Tanggal Lahir</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_dob']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Jenis Kelamin</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_gender']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Kelas</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_grade']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Program Keahlian</td>
                        <td width="5px">:</td>
                        <td><?=$document['m_name']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Tahun Masuk</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_yi']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Tahun Keluar</td>
                        <td width="5px">:</td>
                        <td><?=(!empty($document['s_yo'])) ? $document['s_yo'] : "&minus;";?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-5">
            <table class="table siswa">
                <h3 class="hp">Lokasi Dokumen</h3><hr class="hp">
                <tbody>
                    <tr>
                        <td width="150px">Lemari</td>
                        <td width="5px">:</td>
                        <td><?=$document['d_cname']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Bendel</td>
                        <td width="5px">:</td>
                        <td><?=$document['d_fname']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Map</td>
                        <td width="5px">:</td>
                        <td><?=$document['d_map']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Kode Map</td>
                        <td width="5px">:</td>
                        <td>
                          <span class="btn btn-danger btn-sm" id="blm"><strong><?=$document['d_kode_map']?></strong></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-2">
            <a class="btn btn-success pull-right mb hp" href="<?=site_url('document')?>"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Kembali</a>
            <a class="btn btn-info pull-right mb hp" href="#" onclick="window.print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>
        </div>
    </div>
    <div class="tc">
        <h3><?=$attachment?></h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="">No</th>
                    <th width="">Nama Dokumen</th>
                    <th width="">Status</th>
                    <th width="">Tanggal Pengumpulan</th>
                    <th width="">Petugas</th>
                    <th width="">Tanggal Pinjam</th>
                    <th width="">Petugas</th>
                    <th width="">Tanggal Kembali</th>
                    <th width="">Petugas</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Ijazah</td>
                <td><?=$document['d_ijazah']?></td>
                <td><?=(!empty($document['d_ijazah_added_at']) && $document['d_ijazah'] == "Ada") ? $document['d_ijazah_added_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['d_ijazah_added_at']) && $document['d_ijazah'] == "Ada") ? $document['d_ijazah_added_by'] : "&minus;"; ?></td>
                <td><?=(!empty($document['d_ijazah_borrowed_at'])) ? $document['d_ijazah_borrowed_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['d_ijazah_borrowed_at'])) ? $document['d_ijazah_borrowed_by'] : "&minus;"; ?></td>
                <td><?=(!empty($document['d_ijazah_returned_at'])) ? $document['d_ijazah_returned_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['d_ijazah_returned_at'])) ? $document['d_ijazah_returned_by'] : "&minus;"; ?></td>
              </tr>
              <tr>
                <td>2</td>
                <td>SKHUN</td>
                <td><?=$document['d_skhun']?></td>
                <td><?=(!empty($document['d_skhun_added_at']) && $document['d_skhun'] == "Ada") ? $document['d_skhun_added_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['d_skhun_added_at']) && $document['d_skhun'] == "Ada") ? $document['d_skhun_added_by'] : "&minus;"; ?></td>
                <td><?=(!empty($document['d_skhun_borrowed_at'])) ? $document['d_skhun_borrowed_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['d_skhun_borrowed_at'])) ? $document['d_skhun_borrowed_by'] : "&minus;"; ?></td>
                <td><?=(!empty($document['d_skhun_returned_at'])) ? $document['d_skhun_returned_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['d_skhun_returned_at'])) ? $document['d_skhun_returned_by'] : "&minus;"; ?></td>
              </tr>
              <tr>
                <td>3</td>
                <td>Kartu Keluarga</td>
                <td><?=$document['d_kk']?></td>
                <td><?=($document['d_kk'] == "Ada") ? $document['d_kk_added_at'] : "&minus;"; ?></td>
                <td><?=($document['d_kk'] == "Ada") ? $document['d_kk_added_by'] : "&minus;"; ?></td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
              </tr>
              <tr>
                <td>4</td>
                <td>KTP Ayah</td>
                <td><?=$document['d_ktpa']?></td>
                <td><?=($document['d_ktpa'] == "Ada") ? $document['d_ktpa_added_at'] : "&minus;"; ?></td>
                <td><?=($document['d_ktpa'] == "Ada") ? $document['d_ktpa_added_by'] : "&minus;"; ?></td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
              </tr>
              <tr>
                <td>5</td>
                <td>KTP Ibu</td>
                <td><?=$document['d_ktpi']?></td>
                <td><?=($document['d_ktpi'] == "Ada") ? $document['d_ktpi_added_at'] : "&minus;"; ?></td>
                <td><?=($document['d_ktpi'] == "Ada") ? $document['d_ktpi_added_by'] : "&minus;"; ?></td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
              </tr>
              <tr>
                <td>6</td>
                <td>KIP / KPS</td>
                <td><?=$document['d_kips']?></td>
                <td><?=($document['d_kips'] == "Ada") ? $document['d_kips_added_at'] : "&minus;"; ?></td>
                <td><?=($document['d_kips'] == "Ada") ? $document['d_kips_added_by'] : "&minus;"; ?></td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
              </tr>
              <tr>
                <td>7</td>
                <td>SKTM</td>
                <td><?=$document['d_sktm']?></td>
                <td><?=($document['d_sktm'] == "Ada") ? $document['d_sktm_added_at'] : "&minus;"; ?></td>
                <td><?=($document['d_sktm'] == "Ada") ? $document['d_sktm_added_by'] : "&minus;"; ?></td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
              </tr>
            </tbody>
        </table>
    </div>
<?php } else if ($this->uri->segment(2) == 'detail') { ?>
    <div class="row print">
        <div class="col-sm-5" id="data">
            <table class="table siswa">
                <h3>Biodata Siswa</h3><hr class="hp">
                <tbody>
                    <tr>
                        <td width="150px">NISN</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_nisn']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Nama</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_name']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Tanggal Lahir</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_dob']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Jenis Kelamin</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_gender']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Kelas</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_grade']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Program Keahlian</td>
                        <td width="5px">:</td>
                        <td><?=$document['m_name']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Tahun Masuk</td>
                        <td width="5px">:</td>
                        <td><?=$document['s_yi']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Tahun Keluar</td>
                        <td width="5px">:</td>
                        <td><?=(!empty($document['s_yo'])) ? $document['s_yo'] : "&minus;";?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-5">
            <table class="table siswa">
                <h3 class="hp">Lokasi Dokumen</h3><hr class="hp">
                <tbody>
                    <tr>
                        <td width="150px">Lemari</td>
                        <td width="5px">:</td>
                        <td><?=$document['ad_cname']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Bendel</td>
                        <td width="5px">:</td>
                        <td><?=$document['ad_fname']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Map</td>
                        <td width="5px">:</td>
                        <td><?=$document['ad_map']?></td>
                    </tr>
                    <tr>
                        <td width="150px">Kode Map</td>
                        <td width="5px">:</td>
                        <td>
                          <span class="btn btn-danger btn-sm" id="blm"><strong><?=$document['ad_kode_map']?></strong></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-2">
            <a class="btn btn-success pull-right mb hp" href="<?=site_url('document/archived')?>"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Kembali</a>
            <a class="btn btn-info pull-right mb hp" href="#" onclick="window.print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>
        </div>
    </div>
    <div class="tc">
        <h3><?=$attachment?></h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="">No</th>
                    <th width="">Nama Dokumen</th>
                    <th width="">Status</th>
                    <th width="">Tanggal Pengumpulan</th>
                    <th width="">Petugas</th>
                    <th width="">Tanggal Pinjam</th>
                    <th width="">Petugas</th>
                    <th width="">Tanggal Kembali</th>
                    <th width="">Petugas</th>
                    <th width="">Tanggal Pengambilan</th>
                    <th width="">Petugas</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Ijazah</td>
                <td><?=$document['ad_ijazah']?></td>
                <td><?=(!empty($document['ad_ijazah_added_at']) && $document['ad_ijazah'] == "Ada") ? $document['ad_ijazah_added_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_ijazah_added_at']) && $document['ad_ijazah'] == "Ada") ? $document['ad_ijazah_added_by'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_ijazah_borrowed_at'])) ? $document['ad_ijazah_borrowed_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_ijazah_borrowed_at'])) ? $document['ad_ijazah_borrowed_by'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_ijazah_returned_at'])) ? $document['ad_ijazah_returned_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_ijazah_returned_at'])) ? $document['ad_ijazah_returned_by'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_by'] : "&minus;"; ?></td>
              </tr>
              <tr>
                <td>2</td>
                <td>SKHUN</td>
                <td><?=$document['ad_skhun']?></td>
                <td><?=(!empty($document['ad_skhun_added_at']) && $document['ad_skhun'] == "Ada") ? $document['ad_skhun_added_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_skhun_added_at']) && $document['ad_skhun'] == "Ada") ? $document['ad_skhun_added_by'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_skhun_borrowed_at'])) ? $document['ad_skhun_borrowed_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_skhun_borrowed_atame'])) ? $document['ad_skhun_borrowed_by'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_skhun_returned_at'])) ? $document['ad_skhun_returned_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_skhun_returned_at'])) ? $document['ad_skhun_returned_by'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_by'] : "&minus;"; ?></td>
              </tr>
              <tr>
                <td>3</td>
                <td>Kartu Keluarga</td>
                <td><?=$document['ad_kk']?></td>
                <td><?=($document['ad_kk'] == "Ada") ? $document['ad_kk_added_at'] : "&minus;"; ?></td>
                <td><?=($document['ad_kk'] == "Ada") ? $document['ad_kk_added_by'] : "&minus;"; ?></td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_by'] : "&minus;"; ?></td>
              </tr>
              <tr>
                <td>4</td>
                <td>KTP Ayah</td>
                <td><?=$document['ad_ktpa']?></td>
                <td><?=($document['ad_ktpa'] == "Ada") ? $document['ad_ktpa_added_at'] : "&minus;"; ?></td>
                <td><?=($document['ad_ktpa'] == "Ada") ? $document['ad_ktpa_added_by'] : "&minus;"; ?></td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_by'] : "&minus;"; ?></td>
              </tr>
              <tr>
                <td>5</td>
                <td>KTP Ibu</td>
                <td><?=$document['ad_ktpi']?></td>
                <td><?=($document['ad_ktpi'] == "Ada") ? $document['ad_ktpi_added_at'] : "&minus;"; ?></td>
                <td><?=($document['ad_ktpi'] == "Ada") ? $document['ad_ktpi_added_by'] : "&minus;"; ?></td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_by'] : "&minus;"; ?></td>
              </tr>
              <tr>
                <td>6</td>
                <td>KIP / KPS</td>
                <td><?=$document['ad_kips']?></td>
                <td><?=($document['ad_kips'] == "Ada") ? $document['ad_kips_added_at'] : "&minus;"; ?></td>
                <td><?=($document['ad_kips'] == "Ada") ? $document['ad_kips_added_by'] : "&minus;"; ?></td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_by'] : "&minus;"; ?></td>
              </tr>
              <tr>
                <td>7</td>
                <td>SKTM</td>
                <td><?=$document['ad_sktm']?></td>
                <td><?=($document['ad_sktm'] == "Ada") ? $document['ad_sktm_added_at'] : "&minus;"; ?></td>
                <td><?=($document['ad_sktm'] == "Ada") ? $document['ad_sktm_added_by'] : "&minus;"; ?></td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td>&minus;</td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_at'] : "&minus;"; ?></td>
                <td><?=(!empty($document['ad_taken_at'])) ? $document['ad_taken_by'] : "&minus;"; ?></td>
              </tr>
            </tbody>
        </table>
    </div>
<?php } ?>
