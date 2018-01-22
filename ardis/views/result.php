<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($result)) {

	$output = '';
	$outputdata = '';
	$outputtail = '';
	$output .= '<div class="left-text">
				<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="10%">NISN</th>
							<th width="23%">Nama</th>
							<th width="10%">Tanggal Lahir</th>
							<th width="10%">Jenis Kelamin</th>
							<th width="7%">Kelas</th>
							<th width="7%">Program Keahlian</th>
							<th width="10%">Kelengkapan Data</th>
							<th width="7%">Status Siswa</th>
							<th width="16%">Tindakan</th>
						</tr>
				   </thead>
				   <tbody>';

				echo '<h4 class="left-text">'.count($result).' Data ditemukan untuk kata kunci "<u>'.$keyword.'</u>"</h4>';

				foreach ($result as $row) {

					if ($row->s_status == "Lengkap") {
						$s_status = '<span class="btn btn-success btn-xs">Lengkap</span>';
					} else if ($row->s_status == "Kurang") {
						$s_status = '<span class="btn btn-warning btn-xs">Kurang</span>';
					} else {
						$s_status = '<span class="btn btn-danger btn-xs">Belum Ada Data</span>';
					}

					if ($row->s_is_active == "Aktif") {
						$s_is_active = '<span class="btn btn-success btn-xs">Aktif</span>';
					} else {
						$s_is_active = '<span class="btn btn-default btn-xs">Tidak Aktif</span>';
					}

					$outputdata .= '
						<tr>
							<td>'.$row->s_nisn.'</td>
							<td>'.$row->s_name.'</td>
							<td>'.$row->s_dob.'</td>
							<td>'.$row->s_gender.'</td>
							<td>'.$row->s_grade.'</td>
							<td>'.$row->m_id.'</td>
							<td>'.$s_status.'</td>
							<td>'.$s_is_active.'</td>
							<td>
								<a href="'.site_url('home/view/'.$row->s_id).'"" class="btn btn-info btn-sm mb" target="_blank">Lihat Detail</a>
								<a href="'.site_url('home/print_data/'.$row->s_id).'" class="btn btn-danger btn-sm mb" target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</a>
							</td>
						</tr>';
			 	}

				$outputtail .= '
		 		</tbody>
			</table>
		</div>
	</div> ';

 	echo $output;
	echo $outputdata;
	echo $outputtail;
} else {
  	echo '<div class="err_notif"><h3 class="text-danger"><span><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Tidak ada data yang ditemukan untuk kata kunci "<u>'.$keyword.'</u>"</span></div>';
}
