@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Image Upload') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('image.upload') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image" >
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button id="uploadBtn" type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    
    $('#uploadBtn').on('click', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        })

        $.ajax({
            url: "{{ url('imageupload') }}",
            method: 'POST',
            data: {
                file: $('#image').val(),
            },

            success: function(result){
                console.log(result)
            }
        })
        
    })

</script>

@endpush
