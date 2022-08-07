<div class="container-fluid">
    <div class="container justify-content-center d-flex justify-content-center">
        
        <div class="row col-md-8 mt-3">
            <div class="col-md-12 m-0 p-0">
                <h1 class="col text-left">Manage User</h1>
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Hapus</th>
                        <th scope="col">User Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
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
                    <form action="<?= base_url('User/DeleteUser') ?>" method="post" enctype="multipart/form-data">
                        <div class="col-3 m-0 p-0">
                            <input type="submit" class="btn btn-danger" name="action" value="Delete">
                            <a href="<?= base_url('User/Regis') ?>" class="btn btn-success">Tambah Admin</a>
                        </div>
                        
                        <?php foreach($Users as $data): ?>
                        <tr>
                            
                            <td>
                                <?php if($data->Role !=1){
                                    echo "<input type='checkbox' class='form-check-input' name='Deleteid[]' id='' value='$data->User_id'>";
                                }?>
                            </td>
                            
                            <td>
                                <?= $data->User_id ?>
                                <input type="hidden" name="User_id[]" value="<?= $data->User_id ?>">
                            </td>
                            <td>
                            <?= $data->User_name ?>
                            </td>
                            <td class="">
                                <?= $data->Email ?>
                            </td>
                            <td>
                                <?php if($data->Role == 1){
                                    echo "Root";
                                }else{
                                    echo "Admin";
                                } ?>
                            </td>   
                        </tr>
                        <?php endforeach; ?>
                    </form>
                </tbody>

            </table>
        </div>
    </div>
</div>