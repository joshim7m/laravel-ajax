@foreach($products as $key=>$product)
	
	<p>{{ $key.'. '. $product->name }}</p>

@endforeach 

{{ $products->links() }}