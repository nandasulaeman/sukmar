<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Data Produk</h4>
    </div>
    <div class="card-body">
        <form class="form" method="post" action="<?= base_url('products/update') ?>" enctype="multipart/form-data">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="row">
                <div class="form-group">
                    <input type="hidden" name="product_id" value="<?= $product->id; ?>">
                    <label for="id_market">Nama Pasar</label>
                    <select class="form-control" name="id_market" id="id_market" required>
                        <?php foreach ($market as $row) { ?>
                            <option value="<?= $row->id; ?>" <?= ($product->name_market == $row->name_market) ? 'selected' : ''; ?>>
                                <?= $row->name_market; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name_product">Nama Produk</label>
                    <input id="name_product" name="name_product" type="text" class="form-control"
                        value="<?= $product->name_product; ?>" required />
                </div>
                <div class="form-group">
                    <label for="description_product">Deskripsi</label>
                    <textarea name="description_product" id="description_product" class="form-control" rows="4"
                        required><?= $product->description_product; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="first-name-column">Kategori</label>
                    <select class="form-control" name="category[]" id="category" multiple required>
                        <?php
                        $cat = explode(',', $product->category);
                        foreach ($category as $row) { ?>
                            <option value="<?= $row; ?>" <?= (in_array($row, $cat)) ? 'selected' : ''; ?>>
                                <?= $row; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status </label>
                    <select class="form-control" name="status" id="status" required>
                        <option value="0" <?= ($product->status == 0) ? 'selected' : ''; ?>>Development</option>
                        <option value="1" <?= ($product->status == 1) ? 'selected' : ''; ?>>Production</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="imgold" value="<?= $product->picture_product; ?>" />
                    <label for="photo">Photo </label>
                    <div class="border preview-container" id="multipleImagePreview">
                        <?php
                        $img = explode(',', $product->picture_product);
                        foreach ($img as $image) { ?>
                            <div class="preview-item">
                                <div class="img-container">
                                    <img src="<?= base_url('./img/' . $image) ?>" alt="<?= $image ?>">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <input type="file" class="form-control" id="multipleImageInput" name="picture_product[]"
                        accept="image/*" multiple>
                </div>
                <div class="col-12 d-flex justify-content-end">
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
    });
</script>
<?= $this->endSection(); ?>