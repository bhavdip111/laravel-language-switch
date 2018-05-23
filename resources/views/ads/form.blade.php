<div class="form-group">
    <label class="control-label">@lang('Title')<span class="required" aria-required="true">* </span></label>
    <input type="text" name="title" id="title" class="form-control" placeholder="@lang('Title')" value="{{old('title') ? old('title') : ( ($ads_data->title) ? $ads_data->title : '' )}}">
    @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label class="control-label">@lang('Description')<span class="required" aria-required="true">* </span></label>
    <textarea type="text" name="description" id="description" class="form-control" placeholder="@lang('Description')">{{old('description') ? old('description') : ( ($ads_data->description) ? $ads_data->description : '' )}}</textarea>
    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label class="control-label">@lang('Add Image')</label>
            <input type="file" name="file" accept="image/*" onchange="loadFile(event)" id="file" class="form-control" placeholder="@lang('Add Image')" />
            @if ($errors->has('file'))
                <span class="help-block">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-6">
            @php( $image = ( $ads_data->image_filename != null && File::exists('img/'.$ads_data->image_filename) ) ? $ads_data->image_filename : "preview.png" )
            <img id="output" style="height:100; width:100; border:none;" src="{{asset('img/')}}/{{$image}}"/>
        </div>
    </div>
</div>