<div class="container-fluid">
    <div class="container justify-content-center d-flex justify-content-center">
        
        <div class="row col-md-12 mt-3">
            <div class="row">
                <h1 class="text-center">Testimoni</h1>
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Hapus</th>
                        <th scope="col">Id Testimoni</th>
                        <th scope="col">Komentar</th>
                        <th scope="col">Media</th>
                        <th scope="col">Upload</th>
                    </tr>
                </thead>
                <?php 
                if(!empty($_SESSION['message'])):
                    if($_SESSION['action_status'] == true){
                ?>
                    <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']) ?></div>
                <?php  }else if($_SESSION['action_status'] ==false){ ?>
                    <div class="alert alert-danger"><?= $_SESSION['message'];unset($_SESSION['message']) ?></div>
                <?php } endif;?>
                <tbody class="">
                    <form action="<?= base_url('Testimoni/Update') ?>" method="post" enctype="multipart/form-data">
                        <div class="col-3 m-0 p-0">
                            <input type="submit" class="btn btn-primary" name="action" value="Save">
                            <input type="submit" class="btn btn-danger" name="action" value="Delete">
                        </div>
                        
                        <?php foreach($testimoni as $data): ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input" name="Deleteid[]" id="" value="1">
                            </td>
                            <td>
                                <?= $data->Testimoni_id ?>
                                <input type="hidden" name="testimoniId[]    " value="<?= $data->Testimoni_id ?>">
                            </td>
                            <td>
                                <textarea class="form-control" rows="1" name="komentar[]" id=""><?= $data->Komentar ?></textarea>
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
    <div class="container justify-content-center d-flex justify-content-center">
        <div class="row col-md-12 mt-5">
            <div class="row">
                <h1 class="text-center">Tambah Testimoni</h1>
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Komentar</th>
                        <th scope="col">Media</th>
                        <th scope="col">Simpan</th>
                    </tr>
                </thead>
                <tbody class="">
                    <form action="<?= base_url('Testimoni/Add') ?>" method="post" enctype="multipart/form-data">
                        <tr>
                            <td>
                                <textarea class="form-control" rows="1" name="komentar" id="" required></textarea>
                            </td>
                            <td class="col-4">
                                <input class="" type="file" name="Media" required>
                            </td>   
                            <td>
                                <input type="submit" value="Simpan" class="btn btn-success">
                            </td>
                        </tr>
                    </form>
                </tbody>

            </table>
        </div>
    </div>
</div>