<div class="container-fluid">
    <div class="container justify-content-center d-flex justify-content-center">
        <div class="card col-md-4 mt-5 p-3">
            <h1 class="text-center mt-3 p mb-3">Sign In</h1>
            
            <form action="<?= base_url('User/SignIn') ?>" method="post" class="row px-2">
                <div class="alert alert-danger">
                    Hello
                </div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control mb-3" required>
                <label for="password">Password</label>
                <input type="text" name="password" id="password" class="form-control mb-3" required>
                <input type="submit" value="Sign In" class="btn btn-primary mb-3">
            </form>
        </div>
        
    </div>
</div>