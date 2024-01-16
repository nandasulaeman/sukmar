<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Data Pasar</h4>
    </div>
    <div class="card-body">
        <form class="form" method="post" action="<?= base_url('markets/update') ?>" enctype="multipart/form-data">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="row">
                <div class="form-group">
                    <input type="hidden" name="market_id" value="<?= $market->id; ?>" />
                    <label for="name_market">Nama Pasar</label>
                    <input type="text" id="name_market" name="name_market" class="form-control"
                        value="<?= $market->name_market; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description_market">Deskripsi</label>
                    <textarea name="description_market" id="description_market" class="form-control" rows="4"
                        value="<?= $market->description_market; ?>"
                        required><?= $market->description_market; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input id="address" name="address" type="text" class="form-control" value="<?= $market->address; ?>"
                        required />
                </div>
                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input id="longitude" name="longitude" type="text" class="form-control"
                        value="<?= $market->longitude; ?>" required />
                </div>
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input id="latitude" name="latitude" type="text" class="form-control"
                        value="<?= $market->latitude; ?>" required />
                </div>
                <div class="form-group">
                    <input type="hidden" name="imgold" value="<?= $market->picture_market; ?>" />
                    <label for="picture_market">Photo </label>
                    <div class="border preview-container" id="multipleImagePreview">
                        <?php
                        $img = explode(',', $market->picture_market);
                        foreach ($img as $image) { ?>
                            <div class="preview-item">
                                <div class="img-container">
                                    <img src="<?= base_url('./img/' . $image) ?>" alt="<?= $image ?>">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <input type="file" class="form-control" id="multipleImageInput" name="picture_market[]"
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