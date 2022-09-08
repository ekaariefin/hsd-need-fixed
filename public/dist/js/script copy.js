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

            // {
            //     extend: 'copy',
            //     exportOptions: {
            //         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] /// COLUMN INDEX HERE TO EXPORT 
            //     }
            // },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] /// COLUMN INDEX HERE TO EXPORT 
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] /// COLUMN INDEX HERE TO EXPORT 
                }
            },
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
    // dt.column(10).visible(false);
    // dt.column(11).visible(false);
    // dt.column(12).visible(false);
    // dt.column(13).visible(false);


});

  
var limit = 10;
var countSasaran = 5; 

function addFormSasaran(target) {
    if (countSasaran < limit)
    {
        var target2 = target+countSasaran;
        var id = "formSasaran"+countSasaran;      
        var add = "<tr class='"+id+"'>";
            add+=`
                    <td>
                        <div class='form-group '>
                            <textarea class='form-control ' rows='1 ' name='sasaran[]' placeholder='Enter ... '></textarea>
                        </div>
                    </td>
                    <td class="align-middle">
                        <!-- Date -->
                        <div class="form-group">

                            <div class="input-group date" id="`
            add+= target2;
            add+= `" data-target-input="nearest">
                                <input name="capaian_target[]" type="text" class="form-control datetimepicker-input" data-target="#`+target2+`" />
                                <div class="input-group-append" data-target="#`+target2+`" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <div>
                                    <button type='button' onclick="deleteForm('.`+id+`');" class='btn btn-tool'>
                                        <i class='fas fa-times'></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            `        
        $( ".sasaranbisnisform" ).append(add);

        generateDataModal(target2);
        
        countSasaran++;
    }
    else   
    {
        alert('Question limit reached');
    }
   
}




var countBudaya = 4;
function addFormBudaya(target) {
    if (countBudaya < limit)
    {
        var target2 = target+countBudaya;
        var id = "formBudaya"+countBudaya;    
        var add = "<tr class='"+id+"'>";
            add+=`
                    <td>
                        <div class='form-group '>
                            <textarea class='form-control ' rows='1 ' name='budaya_kerja[]' placeholder='Enter ... '></textarea>
                        </div>
                    </td>
                   
                </tr>
            `        
        $( ".budayaform" ).append(add);
        
        generateDataModal(target2);
        
        countBudaya++;
    }
    else   
    {
        alert('Question limit reached');
    }
   
}

function deleteForm(id) {
    $(id).remove();
    count--;
}

