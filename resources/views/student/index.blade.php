@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
						<div class="row">
							<h4 class="col-md-6">{{ __('Students List') }}</h4>
							<a href="#" class="btn btn-primary ml-auto"
								 onclick="event.preventDefault(); addForm()" 
								 data-toggle="modal" 
								>+ Add New</a>
						</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Roll</th>
								<th>Level</th>
								<th>Active</th>
							</tr>
						</thead>
						<tbody>
							@foreach($students as $key=>$student)
								
								<tr>
									<td>{{ $key + 1 }}</td>
									<td>{{ $student->name }}</td>
									<td>{{ $student->roll }}</td>
									<td>{{ $student->level }}</td>
									<td>
										<a onclick="event.preventDefault();
										   showEditForm({{$student->id}});"
										   data-toggle="modal"
										   href="#">Edit</a> | 

										<a onclick="event.preventDefault();
										   showDeleteForm({{$student->id}})"
										   data-toggle="modal"
											 href="#">Delete</a>
									</td>
								</tr>

							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@include('student.partial.add')
@include('student.partial.edit')
@include('student.partial.delete')


@endsection

@push('scripts')
	<script>

		// popup delete form
		function showDeleteForm(id){
			$.ajax({
				url: 'student/' + id,
				method: 'GET',
				success: function(data){
					$("#delete-form .delete-titel").html("Delete Student (" + data.student.name + ")");
					$("#delete-form input[name='student-id']").val(data.student.id);
					$('#delete-form-error').hide();
					$('#deleteModal').modal('show');
				}
			})
		}
		// popup edti form
		function showEditForm(id){
			$.ajax({
				url: 'student/' + id,
				method: 'GET',
				success: function(data){
					$("#edit-form input[name='name']").val(data.student.name);
					$("#edit-form input[name='roll']").val(data.student.roll);
					$("#edit-form input[name='student-id']").val(data.student.id);
					$('#edit-form-error').hide();
					$('#editModal').modal('show');
				}
			})
			
		}
		// popup add student form
		function addForm(){
			$('#add-form-error').hide();
			$('#addModal').modal('show');
		}

		// delete the student 
		function deleteStudent(){
			let id = $("#delete-form input[name='student-id']").val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
				}
			})

			$.ajax({
				url: 'student/' + id,
				method: 'DELETE',
				success: function(data){
					$("#deleteModal .close").click();
					window.location.reload()
				},
				error: function(data){
					console.log(error)
				}
			})
		}
		// update the student
		function update(){

			let id =$("#edit-form input[name='student-id']").val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
				}
			})

			$.ajax({
				url: 'student/'+id,
				method: 'PUT',
				data: {
					name: 	$("#edit-form input[name='name']").val(),
					roll: 	$("#edit-form input[name='roll']").val(),
					level: 	$("#edit-form select[name='level']").val()
				},
				success: function(data){
					$("#edit-form").trigger('reset');
					$("#edit-form .close").click();
					//console.log(data.student.name);
					window.location.reload();
				},
				error: function(data){
					let errors = $.parseJSON(data.responseText);
					$('#add-student-error').html('');
					$.each(errors.message, function(key, value){
						$('#add-student-error')
						.append('<li>' + value + '</li>');
					})
					$('#add-form-error').show();
				}
			})
		}

		// add new student
		function save(){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
				}
			})

			$.ajax({
				url: '/student',
				method: 'POST',
				data: {
					name: 	$("#add-form input[name='name']").val(),
					roll: 	$("#add-form input[name='roll']").val(),
					level: 	$("#add-form select[name='level']").val()
				},
				dataType: 'json',
				success: function(data){
					//console.log(data);
					$("#add-form").trigger('reset');
					$("#add-form .close").click();
					//console.log(data.student.name);
					window.location.reload();
				},
				error: function(data){
					//console.log(data);
					let errors = $.parseJSON(data.responseText);
					$('#add-student-error').html('');
					$.each(errors.message, function(key, value){
						$('#add-student-error')
						.append('<li>' + value + '</li>');
					})
					$('#add-form-error').show();
				}
			})
		}

	</script>
@endpush