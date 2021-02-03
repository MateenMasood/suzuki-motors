<div class="modal fade" id="DepartmentEditModal" tabindex="-1" role="dialog"
    aria-hidden="true">
    <form id="formEdit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DepartmentEditModalLabel">Department edit form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <input type="hidden" id="department-id" name="id">
                    <div class="form-group">

                        <label for="recipient-name"
                            class="col-form-label">Title:</label>
                        <input type="text" class="form-control" id="department-name"
                        data-msg-required="Title is required!" required
                        data-msg-minlength="At least three chars" data-rule-minlength="3" name="name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Number of employee:</label>
                        <input class="form-control" id="employee-number" type="number" disabled>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </div>
    </div>
  </form>
</div>
