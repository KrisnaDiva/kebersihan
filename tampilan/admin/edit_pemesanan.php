<div class="modal modal-lg fade" id="editPemesananModal" tabindex="-1" aria-labelledby="editModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Pemesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../proses/update_pemesanan.php" method="post">
                <div class="modal-body">
                    <input required type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-nama_jasa" class="form-label">Nama Jasa</label>
                        <input required type="text" class="form-control" id="edit-nama_jasa" name="nama_jasa" readonly>
                    </div>
                <div class="mb-3">
                    <label for="edit-nama" class="form-label">Pembeli</label>
                    <input required type="text" class="form-control" id="edit-nama" name="nama" readonly>
                </div>
                <div class="mb-3">
                    <label for="edit-catatan" class="form-label">Catatan</label>
                    <input required type="text" class="form-control" id="edit-catatan" name="catatan">
                </div>
                <div class="mb-3">
                    <label for="edit-status" class="form-label">Status</label>
                    <select class="form-control" name="status" id="edit-status">
                        <option value="">Pilih Status</option>
                        <option value="pending">pending</option>
                        <option value="diterima">diterima</option>
                        <option value="ditolak">Selesai</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    document.querySelector('#editPemesananModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nama_jasa = button.getAttribute('data-nama_jasa');
        var nama = button.getAttribute('data-nama');
        var catatan = button.getAttribute('data-catatan');
        var status = button.getAttribute('data-status');
        var modal = this;
        modal.querySelector('#edit-id').value = id;
        modal.querySelector('#edit-nama_jasa').value = nama_jasa;
        modal.querySelector('#edit-nama').value = nama;
        modal.querySelector('#edit-catatan').value = catatan;
        modal.querySelector('#edit-status').value = status;
    });
</script>