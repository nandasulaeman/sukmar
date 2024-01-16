<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Datatable Denah Produk</h5>
            <a href="<?= base_url('products_floor/create') ?>" class="btn btn-primary">
                Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Product</th>
                    <th>Nama Denah</th>
                    <th>Picture Denah</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($floorproduct as $row) {
                    ?>
                    <tr>
                        <td>
                            <?= $row->id; ?>
                        </td>
                        <td>
                            <?= $row->name_product; ?>
                        </td>
                        <td>
                            <?= $row->name_floor; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('img/' . $row->picture_floor) ?>">Gambar Denah</a>
                        </td>
                        <td class="text-nowrap text-center">
                            <div class="d-flex justify-content-end">
                                <a title="Edit" class="btn btn-info btn-sm ms-1"
                                    href="<?= base_url('products_floor/edit/' . $row->id) ?>">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm ms-1 delete-floor" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="<?= $row->id; ?>"
                                    data-name_floor="<?= $row->name_floor; ?>">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade text-left" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Delete Data Denah</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p id="deleteConfirmationMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <form id="deleteForm" method="post">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger ms-1">Delete</button>
                </form>
                <a class="btn btn-primary" href="/products/">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Produk</span>
                </a>
                <a class="btn btn-primary" href="/products_varian">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Varian Produk</span>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/extensions/jquery/jquery.js') ?>"></script>
<script src="<?= site_url('./assets/extensions/sweetalert2/sweetalert2.all.min.js') ?>"></script>

<script>
    $(document).ready(function () {
        $('.delete-floor').on('click', function () {
            var floorId = $(this).data('id');
            var floorName = $(this).data('name_floor');
            var deleteUrl = '<?= base_url("products_floor/delete/") ?>' + floorId;

            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteConfirmationMessage').html('Are you sure you want to force delete "' + floorName + '"?');
            $('#deleteModal').modal('show');
        });
    });

    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '<?= session()->getFlashdata('success') ?>',
        });
    <?php endif; ?>
</script>

<?= $this->endSection(); ?>