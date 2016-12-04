@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row">
        @if(session()->has('PositiveMessage'))
            <div class="alert alert-success">
                {{ session()->get('PositiveMessage') }}
            </div>
        @elseif(session()->has('NegativeMessage'))
            <div class="alert alert-danger">
                {{ session()->get('NegativeMessage') }}
            </div>
        @endif
    </div>

    

    <!-- photo upload form will be in here -->

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Upload Photo
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/store') }}">

                        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                        <input type="hidden" value="{{ Session::token() }}" name="_token">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Title</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Upload Image</label>

                            <div class="col-md-8">
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-upload"></i> &nbsp; Upload
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- photo Galary -->
    <div class="row photos">
        @foreach($photos as $photo)
            <div class="col-md-3">
                <div class="thumbnail" style="padding: 9px;">
                    <a href="/photo/{!! $photo->id !!}">
                        <img src="/img/{{ $photo->imageName }}" alt="Lights" style="width:100%">
                    </a>
                    <div class="row" data-photoid = "{{ $photo->id }}" style="height: 36px;">
                        <div class=" col-md-8 title">
                            <p class="caption">
                                {{ str_limit($photo->title, $limit = 10, $end = '...') }}
                            </p>
                        </div>
                        <div class="col-md-4 like " style="top: 9px;text-align: right;right: 10px;">
                            <p>
                                @if( $photo->likes->count()!= 0)
                                {!! $photo->likes->count() !!} likes
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach  
        {{ $photos->links() }}  
    </div>
    <div class="row" style=" text-align: center;">
        {{ $photos->links() }} 
    </div>
</div>
<script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like') }}';
</script>
@endsection
