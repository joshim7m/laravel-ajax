<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="edit-form">
        <div class="modal-header">
          <h5 class="modal-title">Edit Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" id="edit-form-error">
              <ol id="edit-student-error">
                
              </ol>
            </div>
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="name" required class="form-control">
            </div>
            <div class="form-group">
              <label for="">Roll No</label>
              <input type="text" name="roll" required class="form-control">
            </div>
            <div class="form-group">
              <select name="level" class="form-control">
                <option value="One">One</option>
                <option value="Tow">Tow</option>
                <option value="Three">Three</option>
              </select>
            </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" name="student-id" value="" >
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" 
                  onclick="event.preventDefault();
                  update();">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>