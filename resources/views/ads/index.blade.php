@extends('layouts.app')

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
                    <span class="text-left"> @lang('Ads Management')</span> 
                    <a href="{{route('ads.create')}}" class="text-right" style="float:right; cursor: pointer;">
                        <button type="button" class="btn btn-primary">@lang('Create Ads')</button>
                    </a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table id="myTable" class="display border table-bordered table-condensed" style="width:100%" cellpadding="10">
                        <thead>
                            <tr>
                                <th>@lang('Title')</th>
                                <th>@lang('Description')</th>
                                <th>@lang('Total Views')</th>
                                <th>@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ads as $ad)
                                <tr>
                                    <td>{{ str_limit($ad->title, 60, "...") }}</td>
                                    <td>{{ str_limit($ad->description, 60, "...") }}</td>
                                    <td>{{ ($ad->total_views) ? $ad->total_views : 0 }}</td>
                                    <td>
                                        <a href="{{route('ads.edit', $ad->id)}}" class="btn btn-info btn-sm" alt="@lang('Edit')">
                                            @lang('Edit')
                                        </a>
                                        <a href="{{route('ads.show', $ad->id)}}" class="btn btn-warning btn-sm" alt="@lang('View')">
                                            @lang('View')
                                        </a>
                                        <form action="{{ route('ads.destroy', $ad->id) }}" style="display: inline-block;" method="post" enctype="multipart/form-data" onclick="return confirm('<?php echo __('Are you sure you want to delete this item?'); ?>');">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger btn-sm" type="submit" alt="@lang('Delete')">@lang('Delete')</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"><center>@lang('No ads found!')</center></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready( function () {
            $.noConflict();
            $('#myTable').DataTable();
        });
    </script>
@endsection