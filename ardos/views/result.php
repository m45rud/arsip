<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($result)) {

	$output = '';
	$outputdata = '';
	$outputtail = '';
	$output .= '
			<div class="left-text">
				<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="10%">NISN</th>
							<th width="28%">Nama</th>
							<th width="8%">Kelas</th>
							<th width="8%">Program Keahlian</th>
							<th width="3%">Lemari</th>
							<th width="3%">Bendel</th>
							<th width="3%">Map</th>
							<th width="8%">Kode Map</th>
							<th width="10%">Tindakan</th>
						</tr>
				   </thead>
				   <tbody>';

				echo '<h4 class="left-text">'.count($result).' Data ditemukan untuk kata kunci "<u>'.$keyword.'</u>"</h4>';

				foreach ($result as $row) {

					$outputdata .= '
						<tr>
							<td>'.$row->s_nisn.'</td>
							<td>'.$row->s_name.'</td>
							<td>'.$row->s_grade.'</td>
							<td>'.$row->s_mid.'</td>
							<td>'.$row->d_cname.'</td>
							<td>'.$row->d_fname.'</td>
							<td>'.$row->d_map.'</td>
							<td><span class="btn btn-danger btn-xs">'.$row->d_kode_map.'</span></td>
							<td>
								<a href="'.site_url('home/view/'.$row->d_id).'"" class="btn btn-info btn-sm mb" target="_blank">Lihat Detail</a>
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
