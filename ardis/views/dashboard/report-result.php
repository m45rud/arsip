<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty($result)) {

if ($major == "MM") {
	$m_name = "Multimedia";
} else if ($major == "TKR") {
	$m_name = "Teknik Kendaraan Ringan";
} else {
	$m_name = "Teknik Komputer dan Jaringan";
}

$output = '';
$outputdata = '';
$outputtail ='';
$output .= '

<div class="pull-right">
	<button class="btn btn-info hp" onclick="window.print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</button>
</div>
<table class="table siswa">
	<tr>
		<td width="220px"><span class="gt">Kelas</span></td>
		<td width="20px"><span class="gt">:</span></td>
		<td><span class="gt">'.$grade.'</span></td>
	</tr>
	<tr>
		<td width="220px"><span class="gt">Program Keahlian</span></td>
		<td width="20px"><span class="gt">:</span></td>
		<td><span class="gt">'.$m_name.'</span></td>
	</tr>
	<tr>
		<td width="220px"><span class="gt">Status Kelengkapan Data</span></td>
		<td width="20px"><span class="gt">:</span></td>
		<td><span class="gt">'.$status.'</span></td>
	</tr>
	<tr>
		<td width="220px"><span class="gt">Jumlah Siswa</span></td>
		<td width="20px"><span class="gt">:</span></td>
		<td><span class="gt">'.count($result).'</span></td>
	</tr>
</table>
<div class="left-text">
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th width="200px">NISN</th>
					<th width="300px">Nama</th>
					<th width="60px">KK</th>
					<th width="60px">KTP Ayah</th>
					<th width="60px">KTP Ibu</th>
					<th width="60px">KIP / KPS</th>
					<th width="60px">SKTM</th>
					<th width="60px">Ijazah</th>
					<th width="60px">SKHUN</th>
				</tr>
		   </thead>
		   <tbody>';

foreach ($result as $row) {

	if (!empty($row->s_kk)) {
		$kk = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
	} else {
		$kk = "&minus;";
	}

	if (!empty($row->s_ktpa)) {
		$ktpa = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
	} else {
		$ktpa = "&minus;";
	}

	if (!empty($row->s_ktpi)) {
		$ktpi = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
	} else {
		$ktpi = "&minus;";
	}

	if (!empty($row->s_kips)) {
		$kips = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
	} else {
		$kips = "&minus;";
	}

	if (!empty($row->s_sktm)) {
		$sktm = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
	} else {
		$sktm = "&minus;";
	}

	if (!empty($row->s_ijazah)) {
		$ijazah = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
	} else {
		$ijazah = "&minus;";
	}

	if (!empty($row->s_skhun)) {
		$skhun = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
	} else {
		$skhun = "&minus;";
	}

	$outputdata .= '
	<tr>
		<td>'.$row->s_nisn.'</td>
		<td>'.$row->s_name.'</td>
		<td>'.$kk.'</td>
		<td>'.$ktpa.'</td>
		<td>'.$ktpi.'</td>
		<td>'.$kips.'</td>
		<td>'.$sktm.'</td>
		<td>'.$ijazah.'</td>
		<td>'.$skhun.'</td>
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
  	echo '<div class="err_notif"><h3 class="text-danger"><span><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Tidak ditemukan data</span></div>';
}
