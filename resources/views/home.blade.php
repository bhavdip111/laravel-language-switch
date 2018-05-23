@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('layouts.sidebar')
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">@lang('Dashboard')</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p> @lang('Welcome') {{Auth::user()->name}}. <span id="greetMessage"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var time = new Date().getHours();
    var greeting = "";
    if (time < 10) {
        greeting = "{{ __('Wish you a Good morning!') }}";
    } else if (time < 20) {
        greeting = "{{ __('Wish you have a Good day!') }}";
    } else {
        greeting = "{{ __('Have a happy evening!') }}";
    }
    document.getElementById("greetMessage").innerHTML = greeting;
</script>
@endsection