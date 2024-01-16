<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tambah Data Denah</h4>
    </div>
    <div class="card-body">
        <form class="form" method="post" action="<?= base_url('markets/floor/store') ?>" enctype="multipart/form-data">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="row">
                <div class="form-group">
                    <label for="id_market">Nama Pasar</label>
                    <select class="form-control" name="id_market" id="id_market">
                        <?php foreach ($market as $row) { ?>
                            <option value="<?= $row->id; ?>">
                                <?= $row->name_market; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name_floor">Nama Denah</label>
                    <input id="name_floor" name="name_floor" type="text" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="picture_floor">Photo </label>
                    <div class="border preview-container" id="multipleImagePreview"></div>
                    <input type="file" class="form-control" id="multipleImageInput" name="picture_floor"
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
    new TomSelect("#id_market", {
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
    $(document).ready(function () {
        const multipleImageInput = $('#multipleImageInput');

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