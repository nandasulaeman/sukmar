<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Datatable Varian Produk</h5>
            <a href="<?= base_url('products_varian/create') ?>" class="btn btn-primary">
                Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Nama Varian</th>
                    <th>Asset Url</th>
                    <th>Picture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($varian as $row) {
                    ?>
                    <tr>
                        <td>
                            <?= $row->id; ?>
                        </td>
                        <td>
                            <?= $row->name_product; ?>
                        </td>
                        <td>
                            <?= $row->name_varian; ?>
                        </td>
                        <td>
                            <?= $row->asset_url; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('img/' . $row->picture_varian) ?>">Gambar Varian Produk</a>
                        </td>
                        <td class="text-nowrap text-center">
                            <div class="d-flex justify-content-end">
                                <a title="Edit" class="btn btn-info btn-sm ms-1"
                                    href="<?= base_url('products_varian/edit/' . $row->id) ?>">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm ms-1 delete-varian" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="<?= $row->id; ?>"
                                    data-name_varian="<?= $row->name_varian; ?>">Delete</a>
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
                <h4 class="modal-title" id="myModalLabel33">Delete Data Varian Produk</h4>
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
                <a class="btn btn-primary" href="/products">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Produk</span>
                </a>
                <a class="btn btn-primary" href="/products_floor">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Denah Produk</span>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/extensions/jquery/jquery.js') ?>"></script>
<script src="<?= site_url('./assets/extensions/sweetalert2/sweetalert2.all.min.js') ?>"></script>

<script>
    $(document).ready(function () {
        $('.delete-varian').on('click', function () {
            var varianId = $(this).data('id');
            var varianName = $(this).data('name_varian');
            var deleteUrl = '<?= base_url("products_varian/delete/") ?>' + varianId;

            // Ganti '#deleteForm' dengan ID formulir penghapusan yang sesuai
            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteConfirmationMessage').html('Are you sure you want to force delete "' + varianName + '"?');
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