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
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Asset Url</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($product as $row) {
                    ?>
                    <tr>
                        <td>
                            <?= $row->id; ?>
                        </td>
                        <td>
                            <?= $row->name_product; ?>
                        </td>
                        <td>
                            <?= $row->description_product; ?>
                        </td>
                        <td>
                            <?= $row->picture_product; ?>
                        </td>
                        <td>
                            <?= $row->asset_url; ?>
                        </td>
                        <td>
                            <?= $row->category; ?>
                        </td>
                        <td>
                            <?php if ($row->status == 0)
                                echo 'Development';
                            else
                                echo 'Production';
                            ?>
                        </td>
                        <td class="text-nowrap text-center">
                            <div class="d-flex justify-content-end">
                                <a title="Edit" href="#" class="btn btn-info btn-sm ms-1 edit-product"
                                    data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $row->id; ?>"
                                    data-name_product="<?= $row->name_product; ?>" data-category="<?= $row->category; ?>"
                                    data-description_product="<?= $row->description_product; ?>"
                                    data-picture_product="<?= $row->picture_product; ?>"
                                    data-asset_url="<?= $row->asset_url; ?>" data-status="<?= $row->status; ?>"
                                    data-picture_product="<?= $row->picture_product; ?>">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm ms-1 delete-product" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="<?= $row->id; ?>"
                                    data-name_product="<?= $row->name_product; ?>">Delete</a>
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
<form action="/product/store" method="post" enctype="multipart/form-data" id="productForm">
    <div class="modal fade text-left" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Data Product
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <div class="modal-body" style="overflow-y: auto;">
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" />
                        <label for="id_market">Nama Toko</label>
                        <select class="form-control" name="id_market" id="id_market" required>
                            <?php foreach ($market as $names) { ?>
                                <option value="<?= $names->id; ?>">
                                    <?= $names->name_market; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" />
                        <label for="name">Nama Produk</label>
                        <input id="name_product" type="text" name="name_product" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Produk</label>
                        <textarea name="description_product" id="description_product" class="form-control" rows="4"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="asset_url">Asset URL </label>
                        <input id="asset_url" name="asset_url" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori </label>
                        <!-- <input id="category" name="category" type="text" class="form-control" required /> -->
                        <select name="category" id="category" class="form-control" multiple="multiple">
                            <option value="0">0</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status </label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="0">Development</option>
                            <option value="1">Production</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="picture_product">Photo </label>
                        <div class="border preview-container" id="multipleImagePreview"></div>
                        <input type="file" class="form-control" id="multipleImageInput" name="picture_product[]"
                            accept="image/*" required multiple>
                    </div>
                    <div class="form-group" id="floorplanContainer">
                        <label for="picture_product">Denah </label>
                        <select name="floorplan" id="floorplan" class="form-control" multiple="multiple">
                        </select>
                    </div>
                    <div class="form-group" id="dynamicImageInputs"></div>
                    <br>
                    <button type="button" class="btn btn-light" id="add">Tambah Varian</button>
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

<form action="/product/update" method="post" enctype="multipart/form-data" id="editproductForm">
    <div class="modal fade text-left" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Edit Data Produk
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body" style="overflow-y: auto;">
                    <div class="form-group">
                        <input type="hidden" name="product_id" id="product_id" class="form-control" />
                        <label for="name_product">Nama Product</label>
                        <input id="name_product" type="text" name="name_product" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi </label>
                        <textarea name="description_product" id="description_product" class="form-control" rows="4"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="asset_url">Asset URL </label>
                        <input id="asset_url" name="asset_url" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori </label>
                        <input id="category" name="category" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="status">Status </label>
                        <select class="form-control editStatus" name="status" id="status" required>
                            <!-- <option value=""></option> -->
                        </select>
                        <!-- <input id="status" name="status" type="text" class="form-control" required /> -->
                    </div>
                    <div class="form-group">
                        <div class="border" id="imageold"></div>
                        <label for="picture_product">Photo </label>
                        <div class="border preview-container" id="multipleImagePreviewEdit"></div>
                        <input type="file" class="form-control" id="multipleImageEdit" name="picture_product[]"
                            accept="image/*" value="" multiple>
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
                <h4 class="modal-title" id="myModalLabel33">Delete Data Product</h4>
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
                <a class="btn btn-primary" href="/product/varian">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Varian</span>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="assets/extensions/jquery/jquery.js"></script>
<script src="assets/extensions/tom-select/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect("#floorplan", {
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        },
        persist: false,
        createOnBlur: true,
        create: true,
        valueField: 'url',
        labelField: 'name',
        searchField: 'name',
        load: function (query, callback) {
            var idMarket = $('#id_market').val();

            // Mengambil data floorplan dari server berdasarkan id_market yang dipilih
            $.ajax({
                url: 'http://localhost:8080/marketFloor/' + idMarket,
                dataType: 'json',
                success: function (data) {
                    // Menambahkan opsi-opsi dari data floorplan yang diterima dari server
                    var options = data.Result.map(function (floorplan) {
                        return {
                            label: floorplan.name_floor,
                            value: floorplan.id
                        };
                    });

                    callback(options);
                },
                error: function () {
                    callback();
                }
            });
        },
        render: {
            option: function (item, escape) {
                return `<div class="py-2 d-flex">
                <div class="mb-1">
                    <span class="h5">
                        ${escape(item.label)}
                    </span>
                </div>
                <div class="ms-auto">${escape(item.value)}</div>
            </div>`;
            }
        },
    });

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
                <div id="varian${dynamicInputCounter}" class="upload_single_box">
                    <br>
                    <div class="container border">
                        <div class="form-group">
                            <label class="mt-2" for="name_varian_${dynamicInputCounter}">Nama Varian</label>                
                            <input id="name_varian_${dynamicInputCounter}" name="name_varian[]" type="text" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="${dynamicInputId}">Foto Varian</label><br>
                            <div class="border preview-container" id="dynamicImagePreview-${dynamicInputCounter}"></div>
                            <input type="file" class="form-control dynamic-image-input" id="${dynamicInputId}" name="picture_varian[]" accept="image/*" required />
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
            $(`#varian${button_id}`).remove();
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
            $('.edit-product').click(function () {
                // Get data from the button attributes
                var id = $(this).data('id');
                var name_product = $(this).data('name_product');
                var asset_url = $(this).data('asset_url');
                var category = $(this).data('category');
                var status = $(this).data('status');
                var description_product = $(this).data('description_product');
                var picture_product = $(this).data('picture_product');

                // Populate modal fields with the data
                $('#editproductForm #product_id').val(id);
                $('#editproductForm #name_product').val(name_product);
                $('#editproductForm #asset_url').val(asset_url);
                $('#editproductForm #category').val(category);
                $('#editproductForm #status').val(status);
                $('#editproductForm #description_product').val(description_product);

                var names = ['Development', 'Production'];
                var j = [0, 1];
                for (let index = 0; index < names.length; index++) {
                    if (j[index] != status) {
                        console.log(status);
                        $('#editproductForm #status').append(
                            '<option value="' + j[index] + '">' + names[index] + ' </option>'
                        );
                    } else {
                        $('#editproductForm #status').append(
                            '<option value="' + j[index] + '" selected>' + names[index] + ' </option>'
                        );
                    }
                }

                const existingImagePreview = $('#editImagePreview');
                existingImagePreview.html('');

                var imageFilenames = picture_product.split(',');
                // Loop through filenames and display image previews
                for (var i = 0; i < imageFilenames.length; i++) {
                    // Append image preview
                    $('#multipleImagePreviewEdit').append(
                        '<div class=""preview-item"><div class="img-container"><img src="./img/' + imageFilenames[i] + '" alt="' + imageFilenames[i] + '" ></div></div>'
                    );
                }
                $('#imageold').append(
                    '<input type="hidden" class="imgold"  name="imgold" value="' + picture_product + '" >'
                );


                // Show the modal
                $('#editproductForm').modal('show');
            });
        });

        $('#editModal').on('hidden.bs.modal', function (e) {
            $('#editproductForm')[0].reset();
            $('#multipleImagePreviewEdit').html('');
            $('#multipleImageEdit').html('');
            $('.modal-backdrop').remove();
            $('.imgold').remove();

        });

        $('.delete-product').on('click', function () {
            var productId = $(this).data('id');
            var productName = $(this).data('name_product');

            // Set the action attribute of the form dynamically
            $('#deleteForm').attr('action', '/product/delete/' + productId);

            // Update the confirmation message with the product name
            $('#deleteConfirmationMessage').html('Are you sure you want to force delete "' + productName + '"?');

            // Show the delete confirmation modal
            $('#deleteModal').modal('show');
        });

        var idMarket = $('#id_market').val();
        // Mengambil data floorplan dari server berdasarkan id_market yang dipilih
        $.ajax({
            url: 'http://localhost:8080/marketFloor/' + idMarket,
            dataType: 'json',
            success: function (data) {
                // Menambahkan opsi-opsi dari data floorplan yang diterima dari server
                $.each(data.Result, function (index, floorplan) {
                    $('#floorplan').append('<option value="' + floorplan.id + '">' + floorplan.name_floor + '</option>');
                });
            }
        });



    });
</script>

<?= $this->endSection(); ?>