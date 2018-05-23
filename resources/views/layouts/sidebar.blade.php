<div class="col-md-3">
    <div class="card">
        <div class="card-header">@lang('Actions')</div>
        <div class="card-body">
            <a href="/home" @if( strpos(\Request::route()->getName(),'home') !== false) class="active" @endif>{{ __('Dashboard') }}</a>
            <hr/>
            <a href="{{route('ads.index')}}" @if( strpos(\Request::route()->getName(),'ads') !== false) class="active" @endif>@lang('Ads Management')</a>
        </div>
    </div>
</div>