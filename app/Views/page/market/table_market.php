<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Datatable Pasar</h5>
            <a href="<?= base_url('markets/create') ?>" class="btn btn-primary">
                Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pasar</th>
                    <th>Alamat</th>
                    <th>Deskripsi</th>
                    <th>Longitude</th>
                    <th>Latitude</th>
                    <th>Picture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($market as $row) {
                    ?>
                    <tr>
                        <td>
                            <?= $row->id; ?>
                        </td>
                        <td>
                            <?= $row->name_market; ?>
                        </td>
                        <td>
                            <a href="http://maps.google.com/maps?q=<?= $row->latitude; ?>,<?= $row->longitude; ?>"
                                target="_blank">
                                <?= $row->address; ?>
                            </a>

                        </td>
                        <td>
                            <?php
                            $description = $row->description_market;
                            $wordLimit = 20;
                            $words = str_word_count($description, 2);
                            $limitedDescription = implode(' ', array_slice($words, 0, $wordLimit));
                            echo $limitedDescription . ' ...';
                            ?>
                        </td>
                        <td>
                            <?= $row->longitude; ?>
                        </td>
                        <td>
                            <?= $row->latitude; ?>
                        </td>
                        <td>
                            <?php
                            $base_url = base_url('img/'); // Sesuaikan dengan struktur direktori Anda
                            $picture_names = explode(',', $row->picture_market);
                            $i = 1;
                            foreach ($picture_names as $pic) {
                                // Menambahkan ekstensi gambar, misalnya .jpg
                                $picture_url = $base_url . $pic;
                                ?>
                                <a href="<?= $picture_url ?>" target="_blank">Gambar Pasar
                                    <?= $i ?>,
                                </a>
                                <?php
                                $i++;
                            }
                            ?>
                        </td>
                        <td class="text-nowrap text-center">
                            <div class="d-flex justify-content-end">
                                <a title="Edit" class="btn btn-info btn-sm ms-1 edit-market"
                                    href="<?= base_url('markets/edit/' . $row->id) ?>">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm ms-1 delete-market" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="<?= $row->id; ?>"
                                    data-name_market="<?= $row->name_market; ?>">Delete</a>
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
                <h4 class="modal-title" id="myModalLabel33">Delete Data Pasar</h4>
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
                <a class="btn btn-primary" href="/markets_floor">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Denah Pasar</span>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/extensions/jquery/jquery.js') ?>"></script>
<script src="<?= site_url('./assets/extensions/sweetalert2/sweetalert2.all.min.js') ?>"></script>

<script>
    $(document).ready(function () {
        $('.delete-market').on('click', function () {
            var marketId = $(this).data('id');
            var marketName = $(this).data('name_market');
            var deleteUrl = '<?= base_url("markets/delete/") ?>' + marketId;

            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteConfirmationMessage').html('Are you sure you want to force delete "' + marketName + '"?');
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