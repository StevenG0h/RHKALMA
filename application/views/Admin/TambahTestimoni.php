<div class="container-fluid">
    <div class="container justify-content-center d-flex justify-content-center">
        <div class="row col-md-6 mt-3">
            <div class="row">
                <h1 class="text-center">Tambah Testimoni</h1>
            </div>
            <form class="row" action="<?= base_url("Testimoni/addTestimoniService") ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Komentar Konsumen</label>
                    <textarea name="komentar" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Gambar</label>
                    <input name="gambar" class="form-control" type="file" id="formFile">
                </div>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </form>
        </div>
        
    </div>
</div>