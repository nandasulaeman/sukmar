<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Simple Datatable</h5>
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
                    <th>Address</th>
                    <th>Description</th>
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
                            <?= $row->address; ?>
                        </td>
                        <td>
                            <?= $row->description_market; ?>
                        </td>
                        <td>
                            <?= $row->longitude; ?>
                        </td>
                        <td>
                            <?= $row->latitude; ?>
                        </td>
                        <td>
                            <?= $row->picture_market; ?>
                        </td>
                        <td class="text-nowrap text-center">
                            <div class="d-flex justify-content-end">
                                <a title="Edit" href="#" class="btn btn-info btn-sm ms-1 edit-market" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="<?= $row->id; ?>"
                                    data-name_market="<?= $row->name_market; ?>" data-address="<?= $row->address; ?>"
                                    data-longitude="<?= $row->longitude; ?>" data-latitude="<?= $row->latitude; ?>"
                                    data-description_market="<?= $row->description_market; ?>"
                                    data-picture_market="<?= $row->picture_market; ?>">Edit</a>
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
<form action="/market/store" method="post" enctype="multipart/form-data" id="marketForm">
    <div class="modal fade text-left" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Data Toko
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <div class="modal-body" style="overflow-y: auto;">
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" />
                        <label for="name">Nama </label>
                        <input id="name_market" type="text" name="name_market" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi </label>
                        <textarea name="description_market" id="description_market" class="form-control" rows="4"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">Address </label>
                        <input id="address" name="address" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude </label>
                        <input id="longitude" name="longitude" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude </label>
                        <input id="latitude" name="latitude" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo </label>
                        <div class="border preview-container" id="multipleImagePreview"></div>
                        <input type="file" class="form-control" id="multipleImageInput" name="picture_market[]"
                            accept="image/*" required multiple>
                    </div>
                    <div id="dynamicImageInputs"></div>
                    <br>
                    <button type="button" class="btn btn-light" id="add">Tambah Denah</button>
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

<form action="/market/update" method="post" enctype="multipart/form-data" id="editMarketForm">
    <div class="modal fade text-left" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Edit Data Market
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body" style="overflow-y: auto;">
                    <div class="form-group">
                        <input type="hidden" name="market_id" id="market_id" class="form-control" />
                        <label for="name">Nama </label>
                        <input id="name_market" type="text" name="name_market" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi </label>
                        <textarea name="description_market" id="description_market" class="form-control" rows="4"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">Address </label>
                        <input id="address" name="address" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude </label>
                        <input id="longitude" name="longitude" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude </label>
                        <input id="latitude" name="latitude" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <div class="border" id="imageold"></div>
                        <label for="photo">Photo </label>
                        <div class="border preview-container" id="multipleImagePreviewEdit"></div>
                        <input type="file" class="form-control" id="multipleImageEdit" name="picture_market[]"
                            accept="image/*" value="" required multiple>
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
                <a class="btn btn-primary" href="/market/floor">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Floor Market</span>
                </a>
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

        let dynamicInputCounter = 0;

        $('#add').click(function () {
            dynamicInputCounter++;
            const dynamicInputId = `dynamicImageInputs-${dynamicInputCounter}`;
            const denahHtml = `
                <div id="denah${dynamicInputCounter}" class="upload_single_box">
                    <br>
                    <div class="container border">
                        <div class="form-group">
                            <label class="mt-2" for="name_floor_${dynamicInputCounter}">Nama Denah</label>                
                            <input id="name_floor_${dynamicInputCounter}" name="name_floor[]" type="text" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="${dynamicInputId}">Foto Denah</label><br>
                            <div class="border preview-container" id="dynamicImagePreview-${dynamicInputCounter}"></div>
                            <input type="file" class="form-control dynamic-image-input" id="${dynamicInputId}" name="picture_floor[]" accept="image/*" required />
                        </div>
                        <button class="btn btn-danger btn-sm mb-2 btn-remove" id="${dynamicInputCounter}">Hapus</button> 
                    </div>
                </div>
            `;
            dynamicInputContainer.append(denahHtml);

            const dynamicInput = $(`.dynamic-image-input#${dynamicInputId}`);
            dynamicInput.on('change', function () {
                handleImageInputChange(dynamicInput, $(`#dynamicImagePreview-${dynamicInputCounter}`));
            });
        });

        $(document).on('click', '.btn-remove', function () {
            const button_id = $(this).attr("id");
            $(`#denah${button_id}`).remove();
        });

        function handleImageInputChange(input, previewContainer) {
            const files = input[0].files;

            previewContainer.html('');

            if (files.length > 1) {
                alert('Hanya satu file yang diperbolehkan untuk input gambar tunggal.');
                // Reset the input field
                input.val('');
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const previewItem = $('<div class="preview-item"></div>');

                    const imgContainer = $('<div class="img-container"></div>');

                    const img = $('<img src="' + e.target.result + '">');

                    imgContainer.append(img);
                    previewItem.append(imgContainer);

                    previewContainer.append(previewItem);
                };

                reader.readAsDataURL(file);
            }
        }
        $(document).ready(function () {
            $('.edit-market').click(function () {
                // Get data from the button attributes
                var id = $(this).data('id');
                var name_market = $(this).data('name_market');
                var address = $(this).data('address');
                var longitude = $(this).data('longitude');
                var latitude = $(this).data('latitude');
                var description_market = $(this).data('description_market');
                var picture_market = $(this).data('picture_market');


                // Populate modal fields with the data
                $('#editMarketForm #market_id').val(id);
                $('#editMarketForm #name_market').val(name_market);
                $('#editMarketForm #address').val(address);
                $('#editMarketForm #longitude').val(longitude);
                $('#editMarketForm #latitude').val(latitude);
                $('#editMarketForm #description_market').val(description_market);

                const existingImagePreview = $('#editImagePreview');
                existingImagePreview.html('');

                var imageFilenames = picture_market.split(',');
                // Loop through filenames and display image previews
                for (var i = 0; i < imageFilenames.length; i++) {
                    // Append image preview
                    $('#multipleImagePreviewEdit').append(
                        '<div class=""preview-item"><div class="img-container"><img src="./img/' + imageFilenames[i] + '" alt="' + imageFilenames[i] + '" ></div></div>'
                    );
                }
                $('#imageold').append(
                    '<input type="hidden" class="imgold"  name="imgold" value="' + picture_market + '" >'
                );


                // Show the modal
                $('#editMarketForm').modal('show');
            });
        });

        $('#editModal').on('hidden.bs.modal', function (e) {
            $('#editMarketForm')[0].reset();
            $('#multipleImagePreviewEdit').html('');
            $('#multipleImageEdit').html('');
            $('.modal-backdrop').remove();
            $('.imgold').remove();

        });

        $('.delete-market').on('click', function () {
            var marketId = $(this).data('id');
            var marketName = $(this).data('name_market');

            // Set the action attribute of the form dynamically
            $('#deleteForm').attr('action', '/market/delete/' + marketId);

            // Update the confirmation message with the market name
            $('#deleteConfirmationMessage').html('Are you sure you want to force delete "' + marketName + '"?');

            // Show the delete confirmation modal
            $('#deleteModal').modal('show');
        });
    });
</script>

<?= $this->endSection(); ?>