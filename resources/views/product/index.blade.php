@extends('layouts.app')


@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h3>Product List</h3>
					</div>
					<div class="card-body">
						@foreach($products as $key=>$product)
							
							<p>{{ $key.'. '. $product->name }}</p>
						
						@endforeach 
						
						{{ $products->links() }}

					</div>
				</div>
			</div>
		</div>
	</div>

@endsection


@push('scripts')

	<script>
		$(document).on('click', '.pagination a', function(e){
			e.preventDefault();
			let page = $(this).attr('href').split('page=')[1];

			getProducts(page);
		});

		function getProducts(page){

			$.ajax({
				url: 'ajax/products?page='+page,
				method: 'GET',
				success: function(data){
					$('.card-body').html(data);
					location.hash = page;
				}
			})
		}
	</script>

@endpush