<div class="modal fade" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="delete-form">
        <div class="modal-header">
          <h5 class="modal-title delete-titel">Delete Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
        <h4>Are you sure, you wan to delete?</h4>
        <strong class="text-danger">This action can't be undone!</strong>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="student-id" value="" >
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" 
                  onclick="event.preventDefault();
                  deleteStudent();">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>