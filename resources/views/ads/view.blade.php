@extends('layouts.app')
<link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet" type="text/css">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('layouts.sidebar')
        <div class="col-md-9">
            @if(Session::has('flash_message'))
                <div id="alert-success" class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>@lang('Success!')</strong> {!! session('flash_message') !!}
                </div>
            @endif
            @if(Session::has('flash_error_message'))
                <div id="alert-danger" class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>@lang('Error!')</strong> {!! session('flash_error_message') !!}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <span class="text-left"> @lang('View Ads')</span> 
                    <a href="{{route('ads.index')}}" class="text-right" style="float:right; cursor: pointer;">
                        <button type="button" class="btn btn-danger">< @lang('Back')</button>
                    </a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($ads_data)
                        <p><strong>@lang('Title') : </strong> {{ $ads_data->title }} </p>
                        <p><strong>@lang('Description') : </strong> {{ $ads_data->description }} </p>
                        <p><strong>@lang('Total Views') : </strong> {{ ($ads_data->views) ? $ads_data->views : 0 }} </p>
                        <p><strong>@lang('Ads Image') : </strong> 
                        @if($ads_data->image_filename != "") <img src="{{ asset('img') }}/{{$ads_data->image_filename}}" style="padding-left:20px; height:100; width:100; border:none;" /> @endif </p>
                    @else
                        <p><center><strong>@lang('Ads not found.') : </strong> </center></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script type="text/javascript">
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection