<?= $this->extend('template/dashboard') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tambah Data Denah Produk</h4>
    </div>
    <div class="card-body">
        <form class="form" method="post" action="<?= base_url('products_floor/store') ?>" enctype="multipart/form-data">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="row">
                <div class="form-group">
                    <label for="id_product">Nama Produk</label>
                    <select class="form-control" name="id_product" id="id_product">
                        <?php foreach ($product as $row) { ?>
                            <option value="<?= $row->id; ?>">
                                <?= $row->id; ?>-
                                <?= $row->name_product; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_floor">Nama Denah</label>
                    <select class="form-control" name="id_floor" id="id_floor">
                        <?php foreach ($floorplan as $row) { ?>
                            <option value="<?= $row->id; ?>" data-src="<?= base_url('img/' . $row->picture_floor); ?>">
                                <?= $row->name_floor; ?>
                            </option>
                        <?php } ?>
                    </select>
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
    new TomSelect("#id_floor", {
        sortField: {
            field: "text",
            direction: "asc"
        },
        render: {
            option: function (data, escape) {
                return `<div><img width="100" height="100" src="${data.src}"> ${data.text}</div>`;
            },
            item: function (item, escape) {
                return `<div><img width="100" height="100" src="${item.src}"> ${item.text}</div>`;
            }
        }
    });
</script>
<?= $this->endSection(); ?>