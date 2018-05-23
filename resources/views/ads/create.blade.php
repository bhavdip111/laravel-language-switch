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
                    <strong>Success!</strong> {!! session('flash_message') !!}
                </div>
            @endif
            @if(Session::has('flash_error_message'))
                <div id="alert-danger" class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> {!! session('flash_error_message') !!}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <span class="text-left"> @lang('Create Ads')</span> 
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
                    <form action="{{ route('ads.store') }}" class="horizontal-form" id="ads_register" method="post" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="form-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <button class="close" data-close="alert"></button> @lang('You have some form errors. Please check below.') 
                                </div>
                            @endif
                            @include('ads.form')
                        </div>
                        <hr>
                        <div class="form-actions pull-right">
                            <button type="submit" class="btn btn-primary" id="create-ads">@lang('Create')</button>
                            <a href="{{route('ads.index')}}"><button type="button" class="btn btn-danger">@lang('Cancel')</button></a>
                        </div>
                        <div class="clearfix"></div>
                    </form>
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