<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../proses/update_user.php" method="post">
                <div class="modal-body">
                    <input required type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-username" class="form-label">Username</label>
                        <input required type="text" class="form-control" id="edit-username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="edit-nama" class="form-label">Nama</label>
                        <input required type="text" class="form-control" id="edit-nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="edit-alamat" class="form-label">Alamat</label>
                        <input required type="text" class="form-control" id="edit-alamat" name="alamat">
                    </div>
                    <div class="mb-3">
                        <label for="edit-no_hp" class="form-label">No HP</label>
                        <input required type="text" class="form-control" id="edit-no_hp" name="no_hp">
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input required type="text" class="form-control" id="edit-email" name="email">
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
    document.querySelector('#editUserModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var username = button.getAttribute('data-username');
        var nama = button.getAttribute('data-nama');
        var alamat = button.getAttribute('data-alamat');
        var no_hp = button.getAttribute('data-no_hp');
        var email = button.getAttribute('data-email');
        var modal = this;
        modal.querySelector('#edit-id').value = id;
        modal.querySelector('#edit-username').value = username;
        modal.querySelector('#edit-nama').value = nama;
        modal.querySelector('#edit-alamat').value = alamat;
        modal.querySelector('#edit-no_hp').value = no_hp;
        modal.querySelector('#edit-email').value = email;
    });
</script>