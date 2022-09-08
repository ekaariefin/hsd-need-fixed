$(function() {
    $("#coaching_table").DataTable({
        
        "dom": '<"row"<"col"lB><"col"f>>rt<"row"<"col"i><"col"p>>',

        
        "scrollX": true,
        "info": true,
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [ 11, 12, 13 ] 
        }],

        "language": {
            "info": "Menampilkan _START_-_END_ dari _TOTAL_ data",
            'paginate': {
                'previous': 'Sebelumnya',
                'next': 'Selanjutnya'
            },
            "lengthMenu":     "Tampilkan _MENU_ data",
        },

        // "responsive": false,
        // "lengthChange": false,
        // "autoWidth": false,
        "buttons": [

            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] /// COLUMN INDEX HERE TO EXPORT 
                    // columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] /// COLUMN INDEX HERE TO EXPORT 
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] /// COLUMN INDEX HERE TO EXPORT 
                    // columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] /// COLUMN INDEX HERE TO EXPORT 
                }
            },

            // {
            //     extend: 'copy',
            //     exportOptions: {
            //         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] /// COLUMN INDEX HERE TO EXPORT 
            //     }
            // },
           
            // {
            //     extend: 'pdf',
            //     exportOptions: {
            //         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] /// COLUMN INDEX HERE TO EXPORT 
            //     }
            // },
            // {
            //     extend: 'print',
            //     exportOptions: {
            //         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] /// COLUMN INDEX HERE TO EXPORT 
            //     }
            // },
            "colvis"
        ]
    }).buttons().container().appendTo('#coaching_table_wrapper .col-md-6:eq(0)');


    // for table click
    $(".custom-clickable-row").on('click', function(e) {
        var url = $(this).data('href');

        window.location = url;
    });

    var dt = $('#coaching_table').DataTable();
    //hide the first column
    // dt.column(0).visible(false);
    // dt.column(1).visible(false);
    dt.column(2).visible(false);
    dt.column(3).visible(false);
    dt.column(4).visible(false);
    dt.column(5).visible(false);
    // dt.column(6).visible(false);
    dt.column(7).visible(false);
    dt.column(8).visible(false);
    dt.column(9).visible(false);
    dt.column(10).visible(false);
    dt.column(11).visible(false);
    dt.column(12).visible(false);
    dt.column(13).visible(false);


});

  


var sasaranClass = 10;



function addFormSasaran() {
    if (countSasaran < limit) {
        var id = "form-sasaran-bisnis-" +  sasaranClass;
        var add = "<tr class='" + id + "'>";
        add += `
                <td>
                    <div class="form-group ">
                        <textarea class="form-control " rows="2" name="sasaran_bisnis[sarbis][]" placeholder="Masukkan sasaran bisnis atau kecakapan kerja karyawan anda"></textarea>
                    </div>
                </td>
                <td class="align-middle">

                <div class="d-flex">

                    <div class="form-group flex-fill">
                        <textarea class="form-control " rows="2" name="sasaran_bisnis[realisasi][]" placeholder="Masukkan capaian atau progress sasaran bisnis/kecakapan kerja karyawan"></textarea>
                    </div>
                    <div>
                        <button type='button' onclick="deleteForm('.`+id+`');" class='btn btn-tool'>
                            <i class='fas fa-times' style="color:red;"></i>
                        </button>
                    </div>
                </div>
                </td>
            </tr> `;

        $(".sasaran-bisnis").append(add);

        sasaranClass++;
        countSasaran++;
        // console.log("tambah: " + countSasaran);
    } else {
        // alert('Hanya bisa menambahkan maksimal 8 baris');
        Swal.fire({
            title: 'Gagal menambahkan baris',
            text: 'Hanya bisa menambahkan maksimal 8 baris baru',
            icon: 'error',
         
            confirmButtonText: `Kembali`,
            focusConfirm: false,
            showConfirmButton: false,

            // icon: 'success',
            confirmButtonText: 'Kembali',
            target: '#content'
        })
    }
}

var budayaClass = 10;
      

function addFormBudaya() {
    if (countBudaya < limit) {
        var id = "form-perilaku-kerja-" + budayaClass ;
        var add = "<tr class='" + id + "'>";
        add += `
                <td>
                    <div class="d-flex">
                        <div class="form-group flex-fill">
                            <textarea id="coaching-form" class="form-control" rows="2" name="perilaku_kerja[]" placeholder="Masukan perilaku kerja karyawan anda"></textarea>
                        </div>

                            <div>
                                <button type='button' onclick="deleteForm('.`+id+`', 0);" class='btn btn-tool'>
                                    <i class='fas fa-times' style="color: red;"></i>
                                </button>
                            </div>
                    </div>
                </td>
            </tr>
        `
        $(".perilaku-kerja").append(add);
        budayaClass++;
        countBudaya++;
        // console.log("tambah: " + countBudaya);
    } else {
        // alert('Hanya bisa menambahkan maksimal 8 baris');
        Swal.fire({
            title: 'Gagal menambahkan baris',
            text: 'Hanya bisa menambahkan maksimal 8 baris baru',
            icon: 'error',
         
            confirmButtonText: `Kembali`,
            focusConfirm: false,
            showConfirmButton: false,

            // icon: 'success',
            confirmButtonText: 'Kembali',
            target: '#content'
        })
    }

}

function deleteForm(id, type = 1) {
    $(id).remove();

    if (type==1) {
        countSasaran--;
        // console.log("kurang: "+countSasaran);
    } else{
        countBudaya--;
        // console.log(countBudaya);
    }
}

