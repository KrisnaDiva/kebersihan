<div class="modal modal-lg fade" id="editLayananModal" tabindex="-1" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../proses/update_layanan.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input required type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-username" class="form-label">Username</label>
                        <input required type="text" class="form-control" id="edit-username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="edit-nama_jasa" class="form-label">Nama Jasa</label>
                        <input required type="text" class="form-control" id="edit-nama_jasa" name="nama_jasa">
                    </div>
                    <div class="mb-3">
                        <label for="edit-foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="edit-foto" name="foto">
                    </div>
                    <div class="mb-3">
                        <label for="edit-harga" class="form-label">Harga</label>
                        <input required type="number" class="form-control" id="edit-harga" name="harga">
                    </div>
                    <div class="mb-3">
                        <label for="edit-kecamatan" class="form-label">Kecamatan</label>
                        <input type="text" class="form-control" name="kecamatan" id="edit-kecamatan" value="Medan Polonia"
                               readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit-kelurahan" class="form-label">Kelurahan</label>
                        <select class="form-control" name="kelurahan" id="edit-kelurahan">
                            <option value="">Pilih Kelurahan</option>
                            <option value="Anggrung">Anggrung</option>
                            <option value="Madras Hulu">Madras Hulu</option>
                            <option value="Polonia">Polonia</option>
                            <option value="Sari Rejo">Sari Rejo</option>
                            <option value="Suka Damai">Suka Damai</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="edit-alamat">
                    </div>

                    <div class="mb-3">
                        <label for="edit-no_hp" class="form-label">No HP</label>
                        <input required type="text" class="form-control" id="edit-no_hp" name="no_hp">
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input required type="text" class="form-control" id="edit-email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="edit-facebook" class="form-label">Facebook</label>
                        <input required type="text" class="form-control" id="edit-facebook" name="facebook">
                    </div>
                    <div class="mb-3">
                        <label for="edit-instagram" class="form-label">Instagram</label>
                        <input required type="text" class="form-control" id="edit-instagram" name="instagram">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.querySelector('#editLayananModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var username = button.getAttribute('data-username');
        var nama_jasa = button.getAttribute('data-nama_jasa');
        var foto = button.getAttribute('data-foto');
        var alamat = button.getAttribute('data-alamat');
        var kelurahan = button.getAttribute('data-kelurahan');
        var kecamatan = button.getAttribute('data-kecamatan');
        var harga = button.getAttribute('data-harga');
        var no_hp = button.getAttribute('data-no_hp');
        var email = button.getAttribute('data-email');
        var facebook = button.getAttribute('data-facebook');
        var instagram = button.getAttribute('data-instagram');
        var modal = this;
        modal.querySelector('#edit-id').value = id;
        modal.querySelector('#edit-username').value = username;
        modal.querySelector('#edit-nama_jasa').value = nama_jasa;
        modal.querySelector('#edit-foto').value = '';
        modal.querySelector('#edit-harga').value = harga;
        modal.querySelector('#edit-kecamatan').value = kecamatan;
        modal.querySelector('#edit-kelurahan').value = kelurahan;
        modal.querySelector('#edit-alamat').value = alamat;
        modal.querySelector('#edit-no_hp').value = no_hp;
        modal.querySelector('#edit-email').value = email;
        modal.querySelector('#edit-facebook').value = facebook;
        modal.querySelector('#edit-instagram').value = instagram;
    });
</script>