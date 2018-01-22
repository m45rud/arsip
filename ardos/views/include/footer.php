<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<footer class="footer">
    <div class="container">
        <p>&copy; <a href="https://smkmuh3nganjuk.sch.id" target="_blank">SMK Muhammadiyah 3 Nganjuk</a> &minus; Dikembangkan oleh <a href="https://masrud.com" target="_blank" title="0852 3290 4156">M. Rudianto</a></p>
    </div>
</footer>
<script src="<?=base_url('assets/js/jquery.min.js?ver=3.2.0')?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js?ver=3.3.7')?>"></script>
<script src="<?=base_url('assets/js/jquery.dataTables.min.js?ver=1.10.13')?>"></script>
<script src="<?=base_url('assets/js/dataTables.bootstrap.min.js?ver=1.10.13')?>"></script>
<script src="<?=base_url('assets/js/jquery.autocomplete.js?ver=1.2.4')?>"></script>

<script type="text/javascript">
    $(document).ready(function() {

        // Notification alert
        $("#notif").delay(350).slideDown('slow');
        $("#notif").alert().delay(3000).slideUp('slow');

        // Live search
        $("#search").keyup(function() {
            var str = $("#search").val();
            if (str == "") {
                $("#hint" ).html("<p class='help-block'>Masukkan NISN / nama dan hasil akan otomatis ditampilkan disini.</p>");
            } else {
                $.get("<?=site_url()?>home/result?keyword="+str, function(data) {
                    $("#hint").html(data);
                });
            }
        });

        // Find student
        $('#find').autocomplete({
            serviceUrl: '<?=site_url()?>document/find',
            noCache: true,
            dataType: 'json',
            onSelect: function (suggestion) {
                $('#find').val("");
                $('#d_sid').val(''+suggestion.s_id);
                $('#s_name').val(''+suggestion.s_name);
                $('#s_nisn').val(''+suggestion.s_nisn);
                $('#s_grade').val(''+suggestion.s_grade);
                $('#m_name').val(''+suggestion.m_name);

                var str = $("#d_sid").val();
                $.get("<?=site_url()?>document/check?keyword="+str, function(data) {
                    if (data == 1) {
                        $('#submit').removeClass('hide');
                        $('#alr').addClass('hide');
                        $('.he').removeClass('has-error');
                    } else {
                        $('#submit').addClass('hide');
                        $('#alr').removeClass('hide');
                        $('.he').addClass('has-error');
                    }
                });
            }
        });

        // Kode map
        $('select#d_cname, select#d_fname, select#d_map').change(function() {
            var c = $("#d_cname").val();
            var f = $("#d_fname").val();
            var d = $("#d_map").val();
            $('.d_lokasi').val(c+"."+f+"."+d);

            var str = $("#d_kode_map").val();
            $.get("<?=site_url()?>document/result?keyword="+str, function(data) {
                if (data == 1) {
                    $('#submit').removeClass('hide');
                    $('#warn').addClass('hide');
                    $('.d_map, .d_lokasi').removeClass('has-error');
                } else {
                    $('#submit').addClass('hide');
                    $('#warn').removeClass('hide');
                    $('.d_map, .d_lokasi').addClass('has-error');
                }
            });
        });

        // Show hide password
        $('#pass').on('click', function() {
            if ($('#password').attr('pass-shown') == 'false') {
                $('#password').removeAttr('type');
                $('#password').attr('type', 'text');
                $('#password').removeAttr('pass-shown');
                $('#password').attr('pass-shown', 'true');
                $('#pass').html('<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>');
            } else {
                $('#password').removeAttr('type');
                $('#password').attr('type', 'password');
                $('#password').removeAttr('pass-shown');
                $('#password').attr('pass-shown', 'false');
                $('#pass').html('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>');
            }
        });

        // Ajax login
        $("#btn-login").click(function() {
            var formAction = $("#login").attr('action');
            var dataLogin = {
                u_name: $("#username").val(),
                u_pass: $("#password").val(),
                csrf_token: $.cookie('csrf_cookie')
            };

            $.ajax({
                type: "POST",
                url: formAction,
                data: dataLogin,
                beforeSend: function() {
                    $('#status').html('Sedang memproses.....');
                    $('.btn-block').addClass('disabled');
                },
                success: function(data) {
                    if (data == 1) {
                        $("#success").slideDown('slow');
                        $("#success").alert().delay(6000).slideUp('slow');
                        setTimeout(function() {
                            window.location = '<?=site_url('dashboard')?>';
                        }, 2000);
                    } else {
                        $('#status').html('Login');
                        $('.btn-block').removeClass('disabled');
                        $("#failed").slideDown('slow');
                        $("#failed").alert().delay(3000).slideUp('slow');
                        return false;
                    }
                }
            });
            return false;
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        // View data document
        var document = $('#document').DataTable({
            "processing": true,
            "language": {
                "processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('document/get_data')?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "s_nisn"},
                {"data": "s_name"},
                {"data": "s_grade"},
                {"data": "s_mid"},
                {"data": "d_cname"},
                {"data": "d_fname"},
                {"data": "d_map"},
                {"data": "d_kode_map"},
                {"data": "tindakan"}
            ],
            "order": [[1, 'asc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data cabinet
        var cabinet = $('#cabinet').DataTable({
            "processing": true,
            "language": {
                "processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('cabinet/get_data')?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "c_name"},
                {"data": "u_fname"},
                {"data": "c_created_at"},
                {"data": "c_updated_at"},
                {"data": "tindakan"}
            ],
            "order": [[1, 'asc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data folder
        var cabinet = $('#folder').DataTable({
            "processing": true,
            "language": {
                "processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('folder/get_data')?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "f_name"},
                {"data": "u_fname"},
                {"data": "f_created_at"},
                {"data": "f_updated_at"},
                {"data": "tindakan"}
            ],
            "order": [[1, 'asc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data document_deleted
        var document_deleted = $('#document-deleted').DataTable({
            "processing": true,
            "language": {
                "processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('document/get_deleted')?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "s_nisn"},
                {"data": "s_name"},
                {"data": "s_grade"},
                {"data": "s_mid"},
                {"data": "d_kode_map"},
                {"data": "d_deleted_by"},
                {"data": "d_deleted_at"},
                {"data": "tindakan"}
            ],
            "order": [[1, 'asc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data document_deleted
        var document_empty = $('#document-empty').DataTable({
            "processing": true,
            "language": {
                "processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('document/get_empty')?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "d_cname"},
                {"data": "d_fname"},
                {"data": "d_map"},
                {"data": "d_kode_map"},
                {"data": "d_created_by"},
                {"data": "d_created_at"},
                {"data": "tindakan"}
            ],
            "order": [[1, 'asc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data document_archived
        var document_archived = $('#document-archived').DataTable({
            "processing": true,
            "language": {
                "processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('document/get_archived')?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "s_nisn"},
                {"data": "s_name"},
                {"data": "s_grade"},
                {"data": "s_mid"},
                {"data": "ad_kode_map"},
                {"data": "ad_updated_at"},
                {"data": "ad_taken_by"},
                {"data": "tindakan"}
            ],
            "order": [[1, 'asc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data cabinet_deleted
        var cabinet_deleted = $('#cabinet-deleted').DataTable({
            "processing": true,
            "language": {
                "processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('cabinet/get_deleted')?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "c_name"},
                {"data": "u_fname"},
                {"data": "c_created_at"},
                {"data": "c_deleted_at"},
                {"data": "tindakan"}
            ],
            "order": [[1, 'asc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data cabinet_deleted
        var cabinet_deleted = $('#folder-deleted').DataTable({
            "processing": true,
            "language": {
                "processing": "<span class='glyphicon glyphicon-refresh' aria-hidden='true'></span> Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('folder/get_deleted')?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "f_name"},
                {"data": "u_fname"},
                {"data": "f_created_at"},
                {"data": "f_deleted_at"},
                {"data": "tindakan"}
            ],
            "order": [[1, 'asc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>
