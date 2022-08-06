<div class="container-fluid">
    <div class="container justify-content-center d-flex justify-content-center">
        
        <div class="row col-md-12 mt-3">
            <div class="col-md-12 m-0 p-0">
                <h1 class="col text-left">Katalog</h1>
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Deskripsi Produk</th>
                        <th scope="col">Media(Video/gambar)</th>
                        <th scope="col">Tambah</th>
                    </tr>
                </thead>
                <tbody class="">
                    <form action="<?= base_url('Katalog/Add') ?>" method="post" enctype="multipart/form-data">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="Nama_produk" id="">
                            </td>
                            <td>
                                <textarea class="form-control" rows="1" name="Desc_produk" id="" required></textarea>
                            </td>
                            <td class="col-4">
                                <input class="form-control" type="file" name="Media" required>
                            </td>   
                            <td>
                                <input type="submit" value="Tambah" class="btn btn-success">
                            </td>
                        </tr>
                    </form>
                </tbody>

            </table>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Hapus</th>
                        <th scope="col">Id Katalog</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Deskripsi Produk</th>
                        <th scope="col">Media(Video/gambar)</th>
                        <th scope="col">Upload</th>
                    </tr>
                </thead>
                <?php 
                if(!empty($_SESSION['message'])):
                    if($_SESSION['action_status'] == true){
                ?>
                    <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']);unset($_SESSION['action_status']); ?></div>
                <?php  }else if($_SESSION['action_status'] ==false){ ?>
                    <div class="alert alert-danger"><?= $_SESSION['message'];unset($_SESSION['message']);unset($_SESSION['action_status']); ?></div>
                <?php } endif;?>
                <tbody class="">
                    <form action="<?= base_url('Katalog/Update') ?>" method="post" enctype="multipart/form-data">
                        <div class="col-3 m-0 p-0">
                            <input type="submit" class="btn btn-primary" name="action" value="Save">
                            <input type="submit" class="btn btn-danger" name="action" value="Delete">
                        </div>
                        
                        <?php foreach($Katalog as $data): ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input" name="Deleteid[]" id="" value="<?= $data->Id_produk ?>">
                            </td>
                            <td>
                                <?= $data->Id_produk ?>
                                <input type="hidden" name="Id_produk[]" value="<?= $data->Id_produk ?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="Nama_produk[]" id="" value="<?= $data->Nama_produk ?>">
                            </td>
                            <td>
                                <textarea class="form-control" rows="1" name="Desc_produk[]" id=""><?= $data->Desc_produk ?></textarea>
                            </td>
                            <td class="">
                                <a class="btn btn-primary" href="<?= base_url($data->Media) ?>" target="_blank">Tampilkan</a>
                                
                            </td>
                            <td>
                            <input class="form-control" type="file" name="Media[]">
                            </td>   
                        </tr>
                        <?php endforeach; ?>
                    </form>
                </tbody>

            </table>
        </div>
    </div>
</div>