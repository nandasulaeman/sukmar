<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tambah Data Pasar</h4>
    </div>
    <div class="card-body">
        <form class="form" method="post" action="<?= base_url('markets/store') ?>" enctype="multipart/form-data">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="row">
                <div class="form-group">
                    <label for="name_market">Nama</label>
                    <input type="text" id="name_market" name="name_market" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description_market">Deskripsi</label>
                    <textarea name="description_market" id="description_market" class="form-control" rows="4"
                        required></textarea>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input id="address" name="address" type="text" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input id="longitude" name="longitude" type="text" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input id="latitude" name="latitude" type="text" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="picture_market">Photo </label>
                    <div class="border preview-container" id="multipleImagePreview"></div>
                    <input type="file" class="form-control" id="multipleImageInput" name="picture_market[]"
                        accept="image/*" required multiple>
                </div>
                <div id="dynamicImageInputs"></div>
                <div class="form-group">
                    <br>
                    <button type="button" class="btn btn-light" id="add">Tambah Denah</button>
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

        let dynamicInputCounter = 0;

        $('#add').click(function () {
            dynamicInputCounter++;
            const dynamicInputId = `dynamicImageInputs-${dynamicInputCounter}`;
            const dynamicInputPrev = `dynamicImagePreview-${dynamicInputCounter}`;
            const denahHtml = `
                <div id="denah${dynamicInputCounter}" class="upload_single_box">
                    <br>
                    <div class="container border">
                        <div class="form-group">
                            <label class="mt-2" for="name_floor_${dynamicInputCounter}">Nama Denah</label>                
                            <input id="name_floor_${dynamicInputCounter}" name="name_floor[]" type="text" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="dynamicImageInputs-${dynamicInputCounter}">Foto Denah</label><br>
                            <div class="border preview-container" id="dynamicImagePreview-${dynamicInputCounter}"></div>
                            <input type="file" class="form-control dynamic-image-input" id="dynamicImageInputs-${dynamicInputCounter}" name="picture_floor[]" accept="image/*" required />
                        </div>
                        <button class="btn btn-danger btn-sm mb-2 btn-remove" id="${dynamicInputCounter}">Hapus</button> 
                    </div>
                </div>
            `;
            dynamicInputContainer.append(denahHtml);

            const dynamicInput = $(`.dynamic-image-input#${dynamicInputId}`);
            dynamicInput.on('change', function () {
                handleImageInputChange(dynamicInput, $(`.preview-container#${dynamicInputPrev}`));
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
    });
</script>
<?= $this->endSection(); ?>