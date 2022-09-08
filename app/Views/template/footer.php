<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?= date('Y'); ?> PT Bank BCA Syariah </strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- ./wrapper -->





<!-- jQuery -->
<script src="<?= base_url('/public/') ?>/plugins/jquery/jquery.min.js"></script>

<script src="<?= base_url('/public/') ?>/plugins/summernote/summernote-bs4.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url('/public/') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?= base_url('/public/') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Select2 -->
<script src="<?= base_url('/public/') ?>/plugins/select2/js/select2.full.min.js"></script>

<!-- jQuery UI -->
<script src="<?= base_url('/public/') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- InputMask -->
<script src="<?= base_url('/public/') ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('/public/') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>

<!-- date-range-picker -->
<script src="<?= base_url('/public/') ?>/plugins/daterangepicker/daterangepicker.js"></script>

<!-- combodate -->
<!-- <script src="<?= base_url('/public/') ?>/plugins/combodate/src/combodate.js"></script> -->


<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('/public/') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url('/public/') ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url('/public/') ?>/dist/js/adminlte.min.js"></script>

<!-- this is my script -->
<script>
    <?= (isset($limit_sarbis)) ? "var countSasaran = $limit_sarbis" : "var countSasaran = 3"; ?>

    <?= (isset($limit_perilaku_kerja)) ? "var countBudaya = $limit_perilaku_kerja" : "var countBudaya = 2"; ?>

    var limit = 8;
</script>
<script src="<?= base_url('/public/') ?>/dist/js/script.js"></script>


<!-- sweetalert2 cdn -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    function selectDate(params, id = 1, type = 'buka') {

        var monthIndex = $('#' + params).val();
        setDays(monthIndex, id, type);
    }
    // make sure the number of days correspond with the selected month
    function setDays(monthIndex, id, type) {
        var optionCount = $('#tanggal_' + type + '_' + id + ' option').length;
        var daysCount = daysInMonth[monthIndex - 1];

        if (optionCount < daysCount) {
            for (var i = optionCount; i < daysCount; i++) {
                $('#tanggal_' + type + '_' + id)
                    .append($("<option></option>")
                        .attr("value", i + 1)
                        .text(i + 1));
            }
        } else {
            for (var i = daysCount; i < optionCount; i++) {
                var optionItem = '#tanggal_' + type + '_' + id + ' option[value=' + (i + 1) + ']';
                $(optionItem).remove();
            }
        }
    }

    function editConfigCoaching(params, type = 'open') {
        switch (type) {
            case 'close':
                setDate();
                $('#tanggal_buka_' + params).prop("disabled", 1);
                $('#bulan_buka_' + params).prop("disabled", 1);
                $('#tanggal_tutup_' + params).prop("disabled", 1);
                $('#bulan_tutup_' + params).prop("disabled", 1);
                $('#edit-btn-' + params).prop("hidden", 0);
                $('#save-btn-' + params).prop("hidden", 1);
                break;

            default:
                $('#tanggal_buka_' + params).prop("disabled", false);
                $('#bulan_buka_' + params).prop("disabled", false);
                $('#tanggal_tutup_' + params).prop("disabled", false);
                $('#bulan_tutup_' + params).prop("disabled", false);
                $('#edit-btn-' + params).prop("hidden", true);
                $('#save-btn-' + params).prop("hidden", false);
                break;
        }
    }

    $('#commit').on('keyup change', function() {
        if ($(this).val() == "saya telah membaca seluruh hasil coaching ini") {
            $(":submit").removeAttr("disabled");
        } else {
            $(":submit").attr("disabled", true);
        }
    });


    <?php if (session()->role == "2") : ?>

        function downloadCoaching() {
            Swal.fire({
                title: 'Pilih Rentang Tanggal',
                text: 'Konfigurasi telah diperbarui',
                html: `
                <form action="<?= base_url('testlogic/export-coaching/process') ?>" method="post">
                    <div class="form-group">
                        <input type="date" name="startdate" id="startdate" value="<?= date('Y-m-d'); ?>" required> -
                        <input type="date" name="enddate" id="enddate" value="<?= date('Y-m-d', strtotime('tomorrow')); ?>" required>
                    </div>

                    <button id="submitButton" type="submit" class="btn btn-primary">Unduh</button>
                </form>
           
                `,
                confirmButtonText: `<button type="submit">Nonaktikan</button></form>`,
                focusConfirm: false,
                showConfirmButton: false,

                // icon: 'success',
                confirmButtonText: 'Kembali',
                target: '#content'
            })
        }



        function savePeriodeSetting(params) {
            var openForm = $("#bulan_buka_" + params).val() + '-' + $("#tanggal_buka_" + params).val();
            var closeForm = $("#bulan_tutup_" + params).val() + '-' + $("#tanggal_tutup_" + params).val();

            $.post("<?= base_url('config/coaching/save_periode'); ?>", {
                start_coaching: String(openForm),
                end_coaching: String(closeForm),
                id: parseInt(params)
            }, function(data, status) {
                if (status == 'success') {
                    if (data == "1") {

                        buka_1 = new Date(date.getFullYear(), $("#bulan_buka_1").val() - 1, $("#tanggal_buka_1").val());
                        buka_2 = new Date(date.getFullYear(), $("#bulan_buka_2").val() - 1, $("#tanggal_buka_2").val());
                        tutup_1 = new Date(date.getFullYear(), $("#bulan_tutup_1").val() - 1, $("#tanggal_tutup_1").val());
                        tutup_2 = new Date(date.getFullYear(), $("#bulan_tutup_2").val() - 1, $("#tanggal_tutup_2").val());

                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Konfigurasi telah diperbarui',
                            icon: 'success',
                            confirmButtonText: 'Kembali',
                            target: '#content'
                        })
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal mengubah konfigurasi',
                            icon: 'error',
                            confirmButtonText: 'Kembali',
                            target: '#content'
                        })
                    }

                    editConfigCoaching(params, 'close');
                }
            });
        }
    <?php endif; ?>
</script>

<script>
    function fillForm() {
        var nip = $('#fname').val();
        $.post("<?= base_url('/search') ?>", {
                nip: String(nip),
            },
            function(data, status) {
                if (status === 'success') {
                    parseData = JSON.parse(data);
                    $('#name').val(parseData[0].nama); // display the selected text
                    $('#nip').val(parseData[0].nip); // save selected id to input
                    $('#gol').val(parseData[0].gol); // save selected id to input
                    $('#departemen').val(parseData[0].departemen);
                    $('#jabatan').val(parseData[0].jabatan); // save selected id to input
                    $('#unit').val(parseData[0].unit);
                }
            });

        if (nip == "0") {
            $(":submit").attr("disabled", true);
        } else {
            $(":submit").removeAttr("disabled");
        }
    }
    $(document).ready(function() {

        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })


        $(function() {
            $('#default_table').DataTable({

                "dom": '<"row"<"col"l><"col"f>>t<"row"<"col"i><"col"p>>',
                // "paging": true,
                // "searching": true,
                // "ordering": true,
                "info": false,
                "aaSorting": [],
                "responsive": false,
                "processing": true,
                "scrollX": false,
                "language": {
                    // "info": "Menampilkan _START_-_END_ dari _TOTAL_ data",
                    'paginate': {
                        'previous': '<i class="fas fa-angle-left"></i>',
                        'next': '<i class="fas fa-angle-right"></i>'
                    },
                    'sSearch': 'Cari',
                    'loadingRecords': '&nbsp;',
                    "processing": "<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                       </span>&emsp;Processing ...",
                    "zeroRecords": "Data tidak ditemukan",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "emptyTable": "Data tidak tersedia"
                },


            });

        })

        $(function() {
            $('#table_all_appraisal').DataTable({

                "dom": '<"row"<"col"l><"col"f>>t<"row"<"col"i><"col"p>>',
                // "paging": true,
                // "searching": true,
                // "ordering": true,
                "info": false,
                "aaSorting": [],
                "scrollX": true,
                "language": {
                    // "info": "Menampilkan _START_-_END_ dari _TOTAL_ data",
                    'paginate': {
                        'previous': '<i class="fas fa-angle-left"></i>',
                        'next': '<i class="fas fa-angle-right"></i>'
                    },
                    'Search': 'Cari',
                    'loadingRecords': '&nbsp;',
                    "processing": "<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                       </span>&emsp;Processing ...",
                    "zeroRecords": "Data tidak ditemukan",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "emptyTable": "Data tidak tersedia"
                },


            });

        })

        $(function() {
            $('#employee_coaching_table').DataTable({

                "dom": '<"row"<"col"l><"col"f>>t<"row"<"col"i><"col mt-3"p>>',
                // "paging": true,
                // "searching": true,
                // "ordering": true,
                "info": false,
                "aaSorting": [],
                "responsive": true,
                "processing": true,
                "autoWidth": false,
                "scrollX": true,
                "language": {
                    // "info": "Menampilkan _START_-_END_ dari _TOTAL_ data",
                    'paginate': {
                        'previous': '<i class="fas fa-angle-left"></i>',
                        'next': '<i class="fas fa-angle-right"></i>'
                    },
                    'sSearch': 'Cari',
                    'loadingRecords': '&nbsp;',
                    "processing": "<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                       </span>&emsp;Processing ...",
                    "zeroRecords": "Data tidak ditemukan",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "emptyTable": "Data tidak tersedia"
                },


            });

        })


        $(function() {
            $('#table_riwayat_coaching').DataTable({
                "dom": '<"row"<"col"l><"col"f>>t<"row"<"col"i><"col"p>>',

                "aaSorting": [],
                "scrollX": true,
                "autoWidth": false,
                "language": {
                    "info": "Menampilkan _START_-_END_ dari _TOTAL_ data",
                    'paginate': {
                        'previous': '<i class="fas fa-angle-left"></i>',
                        'next': '<i class="fas fa-angle-right"></i>'
                    },
                    "sSearch": "Cari:",
                    "zeroRecords": "Nothing found - sorry",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "emptyTable": "Data tidak tersedia"
                },


            });

        })

        <?php if ((int)session()->role === 2 || (int)session()->role === 1) : ?>

            $(function() {
                $('#table_riwayat_coaching_non_datatable').DataTable({
                    "dom": 't',
                    "ordering": false,
                    "aaSorting": [],
                    "scrollX": true,
                    "responsive": false,
                    "autoWidth": false,
                    "language": {
                        "zeroRecords": "Data tidak tersedia",
                        "emptyTable": "Data tidak tersedia"
                    },
                });

            })

        <?php endif; ?>


        $(function() {
            $('#default_table1').DataTable({

                "dom": '<"row"<"col"lB><"col"f>>t<"row"<"col"i><"col"p>>',
                // "paging": true,
                // "searching": true,
                // "ordering": true,
                // "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "info": "Menampilkan _START_-_END_ dari _TOTAL_ data",
                    'paginate': {
                        'previous': '<i class="fas fa-angle-left"></i>',
                        'next': '<i class="fas fa-angle-right"></i>'
                    },
                    "zeroRecords": "Nothing found - sorry",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "emptyTable": "Data tidak tersedia"
                },

                "buttons": ['csv', 'excel']
            });


        })

        function generateDataModal(id) {
            $("#" + id).datetimepicker({
                viewMode: 'years',
                format: 'MM/YYYY'
            });
        }

        $(function() {
            bsCustomFileInput.init();
        });


        $(function() {
            // Initialize 
            $("#name").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "<?= base_url('/search/userlist') ?>",
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            search: request.term
                        },
                        success: function(data) {
                            console.log(data);
                            var d = $.map(data, function(nama) {
                                return {
                                    label: nama.nama,
                                    value: nama.nama,
                                    source: nama
                                }

                            })
                            // console.log(d);
                            response(d);
                        }
                    });
                },

                select: function(event, ui) {
                    // Set selection
                    $('#name').val(ui.item.source.nama); // display the selected text
                    $('#nip').val(ui.item.source.nip); // save selected id to input
                    $('#gol').val(ui.item.source.gol); // save selected id to input
                    $('#jabatan').val(ui.item.source.jabatan); // save selected id to input
                    $('#unit').val(ui.item.source.unit); // save selected id to input
                    $('#employee_email').val(ui.item.source.email); // save selected id to input
                    return false;
                }
            });

        });

        $(function() {
            // Summernote
            $('#summernote').summernote()
        });
    });
</script>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="center" style="display: flex; justify-content: center;">
                    <img src="<?= base_url('/public/dist/img/authentication.jpg') ?>" height="200">
                </div>
                <div class="center" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">
                    <p style="font-size: 16px; display: flex; justify-content: center;">
                        Apakah anda yakin untuk logout?
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('/logout') ?>" type="button" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>




</body>

</html>