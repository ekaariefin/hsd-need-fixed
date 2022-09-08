<button type="button" id="BtnDelete" class="btn btn-danger" style="display: flex;justify-content: right;margin-left:10px;color:white" > <b><i class="fas fa-trash-alt" style="margin-right: 5px;"></i>Hapus</b></a>
<script>
  $(document).ready(function(){
    $('#BtnDelete').click(function(){
            Swal.fire({
            icon: 'warning',
            title: 'Konfirmasi',
            text: 'Apakah anda yakin ingin menghapus data ini?',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    text: 'Data Berhasil Dihapus',
                    title: 'Berhasil!',
                    confirmButtonText: 'Lanjutkan'
                }).then(function() {
                    window.location.href = "<?= base_url('karyawan/delete'); ?>/<?= $info['fnip']; ?>";
                })
            }});
    });
  });
</script>