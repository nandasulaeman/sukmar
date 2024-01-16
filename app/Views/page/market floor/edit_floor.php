<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Edit Data Denah</h4>
    </div>
    <div class="card-body">
        <form class="form" method="post" action="<?= base_url('markets_floor/update') ?>" enctype="multipart/form-data">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="row">
                <div class="form-group">
                    <input type="hidden" name="floor_id" value="<?= $floor_plan->id; ?>">
                    <label for="id_market">Nama Market</label>
                    <select class="form-control" name="id_market" id="id_market">
                        <?php
                        foreach ($market as $rows): ?>
                            <option value="<?= $rows->id; ?>" <?= ($floor_plan->id_market == $rows->id) ? 'selected' : ''; ?>>
                                <?= $rows->name_market; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name_floor">Nama Denah</label>
                    <input id="name_floor" name="name_floor" type="text" class="form-control"
                        value="<?= $floor_plan->name_floor; ?>" required />
                </div>
                <div class="form-group">
                    <input type="hidden" name="imgold" value="<?= $floor_plan->picture_floor; ?>" />
                    <label for="photo">Photo </label>
                    <div class="border preview-container" id="multipleImagePreview">
                        <div class="preview-item">
                            <div class="img-container">
                                <img src="<?= base_url('./img/' . $floor_plan->picture_floor) ?>"
                                    alt="<?= $floor_plan->picture_floor ?>">

                            </div>
                        </div>
                    </div>
                    <input type="file" class="form-control" id="multipleImageInput" name="picture_floor"
                        accept="image/*">
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