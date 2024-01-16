<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tambah Data Product</h4>
    </div>
    <div class="card-body">
        <form class="form" method="post" action="<?= base_url('products/store') ?>" enctype="multipart/form-data">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="row">
                <div class="form-group">
                    <label for="id_market">Nama Pasar</label>
                    <select class="form-control" name="id_market" id="id_market" required>
                        <?php foreach ($market as $row) { ?>
                            <option value="<?= $row->id; ?>">
                                <?= $row->name_market; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name_product">Nama Produk</label>
                    <input id="name_product" name="name_product" type="text" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="description_product">Deskripsi</label>
                    <textarea name="description_product" id="description_product" class="form-control" rows="4"
                        required></textarea>
                </div>
                <div class="form-group">
                    <label for="first-name-column">Kategori</label>
                    <select class="form-control" name="category[]" id="category" multiple required>
                        <?php foreach ($category as $row) { ?>
                            <option value="<?= $row; ?>">
                                <?= $row; ?>
                            </option>
                        <?php } ?>
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
                    <label for="first-name-column">Tambah Denah</label>
                    <select class="form-control" name="name_floor[]" id="name_floor" multiple required>
                        <?php foreach ($floorplan as $row) { ?>
                            <option value="<?= $row->id; ?>">
                                <?= $row->name_floor; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="photo">Photo </label>
                    <div class="border preview-container" id="multipleImagePreview"></div>
                    <input type="file" class="form-control" id="multipleImageInput" name="picture_product[]"
                        accept="image/*" required multiple>
                </div>
                <div id="dynamicImageInputs"></div>
                <div class="form-group">
                    <br>
                    <button type="button" class="btn btn-light" id="add">Tambah Varian</button>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="<?= base_url('assets/extensions/jquery/jquery.js') ?>"></script>
<script src="<?= base_url('assets/extensions/tom-select/js/tom-select.complete.min.js') ?>"></script>

<script>
    new TomSelect("#category", {
        persist: false,
        createOnBlur: true,
        create: true,
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        },
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    new TomSelect("#id_market", {
        sortField: {
            field: "text",
            direction: "asc"
        },
        persist: false,
    });
    new TomSelect("#name_floor", {
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        },
        sortField: {
            field: "text",
            direction: "asc"
        }
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
                alert('Maksimal 3 file !');
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
            const dynamicInputPrev = `dynamicImagePreview-${dynamicInputCounter}`;
            const varianHtml = `
                <div id="varian${dynamicInputCounter}" class="upload_single_box">
                    <br>
                    <div class="container border">
                        <div class="form-group">
                            <label class="mt-2" for="name_varian_${dynamicInputCounter}">Nama Varian</label>                
                            <input id="name_varian_${dynamicInputCounter}" name="name_varian[]" type="text" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label class="mt-2" for="asset_url_${dynamicInputCounter}">Asset Url</label>                
                            <input id="asset_url_${dynamicInputCounter}" name="asset_url[]" type="text" class="form-control" required />
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
            dynamicInputContainer.append(varianHtml);

            const dynamicInput = $(`.dynamic-image-input#${dynamicInputId}`);
            dynamicInput.on('change', function () {
                handleImageInputChange(dynamicInput, $(`.preview-container#${dynamicInputPrev}`));
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
    });
</script>
<?= $this->endSection(); ?>