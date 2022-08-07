<div class="container-fluid">
    <div class="container justify-content-center d-flex justify-content-center">
        <div class="card col-md-4 my-5 p-3">
            <h1 class="text-center mt-3 p mb-3">Register</h1>
            
            <form action="<?= base_url('User/SignUp') ?>" method="post" class="row px-2">
                <?php if(validation_errors() != ""){ echo "<div class='alert alert-danger'>". validation_errors() ."</div>";} ?>
                <label for="username">username</label>
                <input type="text" name="username" id="username" class="form-control mb-3" required placeholder="Masukkan Username..." value="<?= set_value('username') ?>">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control mb-3" required placeholder="Masukkan Email..." value="<?= set_value('email') ?>">
                <label for="password">Password</label>
                <input name="password" id="password" type="password" class="form-control mb-3" required placeholder="Masukkan Password..." >
                <label for="repassword">Ketik Ulang Password</label>
                <input name="repassword" id="repassword" type="password" class="form-control mb-3" required placeholder="Masukkan Ulang Password...">
                <input type="submit" value="Sign In" class="btn btn-primary mb-3">
            </form>
        </div>
        
    </div>
</div>