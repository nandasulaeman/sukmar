<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tambah Data Varian Produk</h4>
    </div>
    <div class="card-body">
        <form class="form" method="post" action="<?= base_url('products_varian/store') ?>"
            enctype="multipart/form-data">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="row">
                <div class="form-group">
                    <label for="id_product">Nama Product</label>
                    <select class="form-control" name="id_product" id="id_product">
                        <?php foreach ($product as $row) { ?>
                            <option value="<?= $row->id; ?>">
                                <?= $row->name_product; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name_varian">Nama Varian</label>
                    <input id="name_varian" name="name_varian" type="text" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="asset_url">Asset Url</label>
                    <input id="asset_url" name="asset_url" type="text" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="photo">Photo </label>
                    <div class="border preview-container" id="multipleImagePreviewEdit"></div>
                    <input type="file" class="form-control" id="multipleImageEdit" name="picture_varian"
                        accept="image/*" required>
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
    new TomSelect("#id_product", {
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    $(document).ready(function () {
        const multipleImageEdit = $('#multipleImageEdit');

        multipleImageEdit.on('change', function () {
            handleMultipleImageInputChange(multipleImageEdit, $('#multipleImagePreviewEdit'));
        });

        function handleMultipleImageInputChange(input, previewContainer) {
            previewContainer.html('');

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