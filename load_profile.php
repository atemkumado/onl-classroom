<div class="e-profile">
    <div class="row">
        <div class="col-12 col-sm-auto mb-3">
            <div class="mx-auto d-flex justify-content-center align-items-center">
                <img src="<?php echo $data['avatar'] ?>" alt="" width="140" height="140">
            </div>
        </div>
        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
            <div class="text-center text-sm-left mb-2 mb-sm-0">
                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $data['fullname'] ?></h4>
                <p class="mb-0">@<?php echo $data['username'] ?></p>
                <div class="text-muted"><small><?php echo $data['email'] ?></small></div>
                <form action="" method="POST">
                    <input type="file" id="myfile" name="myfile">
                </form>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs">
        <li class="nav-item active nav-link">Settings</li>
    </ul>
    <form class="form mt-3">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input class="form-control" type="text" name="name" value="<?php echo $data['fullname'] ?>">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" value="<?php echo $data['username'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="text" value="<?php echo $data['phone'] ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 mb-3">
                <div class="mb-2"><b>Change Password</b></div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input class="form-control" type="password" placeholder="••••••">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>New Password</label>
                            <input class="form-control" type="password" placeholder="••••••">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                            <input class="form-control" type="password" placeholder="••••••"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button class="btn btn-primary mr-2" type="submit">Save Changes</button>
            </div>
        </div>
    </form>
</div>