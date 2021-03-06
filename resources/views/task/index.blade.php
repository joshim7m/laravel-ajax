@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row">
        <div class="col-md-6"> 
            <h2>Manage <b>Tasks</b></h2>
        </div> 
       <div class="col-md-6">
          <a onclick="event.preventDefault();
                addTaskForm();" href="#"
                class="btn btn-success" 
                data-toggle="modal">
          
           <span>Add New Task</span>
          </a> 
        </div>
      </div>

    <table class="table table-striped">
     <thead>
        <tr>
         <th>ID</th>
          <th>Task</th>
          <th>Description</th>
          <th>Done</th>
          <th>Actions</th> 
        </tr>
      </thead>
         <tbody id="tbody"> 
         
      </tbody>
    </table>

    <div class="row mt-5 justify-content-center">
      <div class="col-md-8">
        <ul class="task-list">
        </ul>
      </div>
    </div>
  </div>



    @include('task.partials.add')
    @include('task.partials.edit')
    @include('task.partials.delete') 

@endsection

@push('scripts')
  <script type="text/javascript">
    $(document).ready(function() { 

      $(window).on('load', function(){

         getData();

        })

    // get ajax data
      function getData(){
        $.ajax({
          url: 'ajax/task',
          method: 'GET',
          success: function(data){

            let tasks = data.tasks;
            let tbody = $('#tbody');
            tbody.html('');
            $.each(tasks, function(i, item){
              let tr = tbody.append('<tr></tr>');
              tr.append('<td>' + i + '</td>');
              tr.append('<td>' + item.name + '</td>');
              tr.append('<td>' + item.description + '</td>');
              tr.append('<td>' + item.done + '</td>');
              tr.append("<td> <a href='#' onclick='event.preventDefault(); editTaskForm("+item.id+")' >Edit</a> | <a href='#' onclick='event.preventDefault(); deleteTaskForm("+item.id+")' >Delete</a></td>");
            })
          }
         })
       }


    // add record
      $("#btn-add").click(function() {

        $.ajaxSetup({ 
          headers: { 
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
          } 
        }); 

       $.ajax({ 
          url: '/task', 
          method: 'POST', 
          data: { 
            name: $("#frmAddTask input[name='name']").val(), 
            description: $("#frmAddTask input[name='description']").val(), 
          }, 
          dataType: 'json', 
          success: function(data) { 
            $('#frmAddTask').trigger("reset"); 
            $("#frmAddTask .close").click(); 
            getData();
          }, 

          error: function(data) {
           var errors = $.parseJSON(data.responseText);
            $('#add-task-errors').html(''); 
            $.each(errors.messages, function(key, value) {
             $('#add-task-errors')
             .append('<li>' + value + '</li>'); }); 
            $("#add-error-bag").show(); 
            } 
          });
        }); 


      // edit record
      $("#btn-edit").click(function() {

         $.ajaxSetup({ 
            headers: { 
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            } 
          }); 

         $.ajax({ 
          url: '/task/' + $("#frmEditTask input[name=task_id]").val(), 
          method: 'PUT', 
          data: { 
            name: $("#frmEditTask input[name=name]").val(),
            description: $("#frmEditTask input[name=description]").val(), 
          }, 
          dataType: 'json', 

          success: function(data) {
            $('#frmEditTask').trigger("reset"); 
            $("#frmEditTask .close").click(); 
             window.location.reload(); 
            }, 

           error: function(data) { 
            var errors = $.parseJSON(data.responseText); 
            $('#edit-task-errors').html(''); 
            $.each(errors.messages, function(key, value) {
             $('#edit-task-errors').append('<li>' + value + '</li>'); });
              $("#edit-error-bag")
              .show(); 
            } 
          }); 
        }); 


      // delete record
      $("#btn-delete").click(function() {

         $.ajaxSetup({ 
            headers: { 
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            } 
          });

          $.ajax({ 
            method: 'DELETE', 
            url: '/task/' + $("#frmDeleteTask input[name=task_id]").val(),
            dataType: 'json', 
             success: function(data) { 
              $("#frmDeleteTask .close").click(); 
              getData();
             }, 
            error: function(data) {
             console.log(data); 
            } 
           }); 
        });
      });


    // record add form
    function addTaskForm() { 
      $(document).ready(function() {
       $("#add-error-bag").hide(); 
       $('#addTaskModal').modal('show'); 
      });
    }

    // record edit form
    function editTaskForm(task_id) { 
      $.ajax({ 
        method: 'GET', 
        url: '/task/' + task_id, 
        success: function(data) {
       $("#edit-error-bag").hide(); 
       $("#frmEditTask input[name=name]").val(data.task.name); 
       $("#frmEditTask input[name=description]").val(data.task.description); 
       $("#frmEditTask input[name=task_id]").val(data.task.id);
       $('#editTaskModal').modal('show'); 
      }, 

        error: function(data) {
         console.log(data); } 
       });
    }

    // record delete form
    function deleteTaskForm(task_id) {
     $.ajax({ 
      method: 'GET', 
      url: '/task/' + task_id, 
      success: function(data) { 
        $("#frmDeleteTask #delete-title").html("Delete Task (" + data.task.name + ")?");
        $("#frmDeleteTask input[name=task_id]").val(data.task.id); 
        $('#deleteTaskModal').
       modal('show');
        }, 
       error: function(data) { 
        console.log(data); 
       } 
      });
    }

  </script>
@endpush
