<div class="modal fade modal-right" id="changePasswordModal" tabindex="-1" role="dialog"
aria-labelledby="changePasswordModal" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Chnage Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="formPasswordUpdate">
            @csrf

        <div class="modal-body">



                <div class="form-row">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" class="form-control" name="oldPassword"  placeholder="Please enter your old password" autocomplete="off">
                        </div>

                    </div>

                </div>
                <div class="form-row">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Please enter your new password" autocomplete="off">
                        </div>

                    </div>

                </div>
                <div class="form-row">
                    <div class="col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="confirmPassword" placeholder="Please re-type your password" autocomplete="off">
                        </div>

                    </div>

                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary"
                data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

    </div>
</div>
</div>
