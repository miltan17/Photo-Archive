@extends('layouts.app')

@section('content')
<div class="container"> 
    
    <!-- photo Galary -->
    <div class="row photos">
        @foreach($photos as $photo)
            <div class="col-md-3">
                <div class="thumbnail" style="padding: 9px;">
                    <a href="/photo/{!! $photo->id !!}">
                        <img src="/img/{{ $photo->imageName }}" alt="Lights" style="width:100%">
                    </a>
                    <div class="row clearfix" data-photoid = "{{ $photo->id }}" style="height: 36px;">
                        <div class=" col-md-8 title">
                            <p class="caption">
                                {{ str_limit($photo->title, $limit = 10, $end = '...') }}
                            </p>
                        </div>
                        <div class="col-md-4 like " style="top: 9px;text-align: right;right: 10px;">
                            @if($photo->user_id != Auth::user()->id)
                                <a class="glyphicon
                                @if(Auth::user()->likes()->where('photo_id', $photo->id)->first()) 
                                glyphicon-thumbs-down 
                                @else
                                    glyphicon-thumbs-up
                                @endif
                                btn btn-default btn-sm" href="#" class="like" id="{{ $photo->id}}">
                                @if( $photo->likes->count()!= 0)
                                    {!! $photo->likes->count() !!}
                                @endif   
                                </a>
                            @else
                                <p>
                                    @if( $photo->likes->count()!= 0)
                                    {!! $photo->likes->count() !!} likes
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
    <div class="row" style="text-align: center;;">
        {{ $photos->links() }} 
    </div>
</div>
<script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like') }}';
</script>
@endsection
