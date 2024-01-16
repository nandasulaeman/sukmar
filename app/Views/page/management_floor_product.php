<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Datatable Denah</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Market</th>
                    <th>Picture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($floor_plan as $row) {
                    ?>
                    <tr>
                        <td>
                            <?= $row->id; ?>
                        </td>
                        <td>
                            <?= $row->name_floor; ?>
                        </td>
                        <td>
                            <?= $row->name_market; ?>
                        </td>
                        <td>
                            <?= $row->picture_floor; ?>
                        </td>
                        <td class="text-nowrap text-center">
                            <div class="d-flex justify-content-end">
                                <a title="Edit" href="#" class="btn btn-info btn-sm ms-1 edit-floor" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="<?= $row->id; ?>"
                                    data-name_floor="<?= $row->name_floor; ?>" data-name_market="<?= $row->name_market; ?>"
                                    data-id_market="<?= $row->id_market; ?>"
                                    data-picture_floor="<?= $row->picture_floor; ?>">Edit</a>
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


<form action="/market/floor/store" method="post" enctype="multipart/form-data" id="addForm">
    <div class="modal fade text-left" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Data Denah
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <div class="modal-body" style="overflow-y: auto;">
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" />
                        <label for="name">Nama </label>
                        <input id="name_floor" type="text" name="name_floor" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="address">Nama Toko </label>
                        <select class="choices form-select" name="id_market">
                            <?php
                            foreach ($market as $row) {
                                ?>
                                <option value="<?= $row->id; ?>">
                                    <?= $row->name_market; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo </label>
                        <div class="border preview-container" id="multipleImagePreview"></div>
                        <input type="file" class="form-control" id="multipleImageInput" name="picture_floor"
                            accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Submit</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="market/floor/update" method="post" enctype="multipart/form-data" id="editForm">
    <div class="modal fade text-left" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Edit Data Denah
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body" style="overflow-y: auto;">
                    <div class="form-group">
                        <input type="hidden" name="floor_id" id="floor_id" class="form-control" />
                        <label for="name">Nama </label>
                        <input id="name_floor" type="text" name="name_floor" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="address">Nama Toko </label>
                        <select class="form-select selectOpt" name="id_market" id="id_market">
                        </select>
                    </div>
                    <div class="form-group">
                        <div id="imageold"></div>
                        <label for="photo">Photo </label>
                        <div class="border preview-container" id="multipleImagePreviewEdit"></div>
                        <input type="file" class="form-control" id="multipleImageEdit" name="picture_floor"
                            accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Submit</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade text-left" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Delete Data Market</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Delete confirmation message -->
                <p id="deleteConfirmationMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <!-- Form for deleting data -->
                <form id="deleteForm" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger ms-1">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="assets/extensions/jquery/jquery.js"></script>

<script>
    $(document).ready(function () {
        const multipleImageInput = $('#multipleImageInput');
        const dynamicInputContainer = $('#dynamicImageInputs');

        const multipleImageEdit = $('#multipleImageEdit');

        multipleImageEdit.on('change', function () {
            handleMultipleImageInputChange(multipleImageEdit, $('#multipleImagePreviewEdit'));
        });

        multipleImageInput.on('change', function () {
            handleMultipleImageInputChange(multipleImageInput, $('#multipleImagePreview'));
        });

        function handleMultipleImageInputChange(input, previewContainer) {
            previewContainer.html('');

            if (input[0].files.length > 3) {
                alert('Maksimal 3 file diperbolehkan untuk gambar ganda.');
                // Reset the input field
                input.val('');
                return;
            }

            previewImages(input[0], previewContainer);
        }

        function previewImages(input, preview) {
            const files = input.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const previewItem = $('<div class="preview-item"></div>');

                    const imgContainer = $('<div class="img-container"></div>');

                    const img = $('<img src="' + e.target.result + '">');

                    imgContainer.append(img);

                    previewItem.append(imgContainer);

                    preview.append(previewItem);
                };

                reader.readAsDataURL(file);
            }
        }

        $(document).ready(function () {

            $('.edit-floor').click(function () {
                // Get data from the button attributes
                var id = $(this).data('id');
                var name_floor = $(this).data('name_floor');
                var name_market = $(this).data('name_market');
                var picture_floor = $(this).data('picture_floor');
                var id_market = $(this).data('id_market');

                // Populate modal fields with the data
                $('#editForm #floor_id').val(id);
                $('#editForm #name_market').val(name_market);
                $('#editForm #name_floor').val(name_floor);
                $('#editForm #id_market').val(id_market);

                var ids = [];
                var names = [];

                <?php foreach ($market as $row): ?>
                    // Assuming $row->id and $row->name_market are the fields for id and name_market
                    ids.push(<?= $row->id; ?>);
                    names.push('<?= addslashes($row->name_market); ?>');
                <?php endforeach; ?>


                for (let index = 0; index < ids.length; index++) {

                    if (ids[index] != id_market) {
                        $('#editForm #id_market').append(
                            '<option value="' + ids[index] + '">' + names[index] + ' </option>'
                        );
                    }
                    else {
                        $('#editForm #id_market').append(
                            '<option value="' + ids[index] + '" selected>' + names[index] + ' </option>'
                        );
                    }
                }

                const existingImagePreview = $('#editImagePreview');
                existingImagePreview.html('');
                $('#multipleImagePreviewEdit').append(
                    '<div class=""preview-item"><div class="img-container"><img src="./img/' + picture_floor + '" alt="' + picture_floor + '" ></div></div>'
                );

                $('#imageold').append(
                    '<input type="hidden" class="imgold"  name="imgold" value="' + picture_floor + '" >'
                );


                // Show the modal
                $('#editForm').modal('show');
            });
        });

        $('#editModal').on('hidden.bs.modal', function (e) {
            $('#editForm')[0].reset();
            $('#multipleImagePreviewEdit').html('');
            $('#multipleImageEdit').html('');
            $('.modal-backdrop').remove();
            $('.imgold').remove();
        });

        $('.delete-floor').on('click', function () {
            var floor_id = $(this).data('id');
            var name_floor = $(this).data('name_floor');

            // Set the action attribute of the form dynamically
            $('#deleteForm').attr('action', '/market/floor/delete/' + floor_id);

            // Update the confirmation message with the market name
            $('#deleteConfirmationMessage').html('Are you sure you want to force delete "' + name_floor + '"?');

            // Show the delete confirmation modal
            $('#deleteModal').modal('show');
        });
    });
</script>
<?= $this->endSection(); ?>