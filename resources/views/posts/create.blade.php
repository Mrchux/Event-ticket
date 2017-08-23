@extends('layouts.app')

@section('title')
    Add New Post
@endsection

@section('content')

    <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector : "textarea",
            plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
            toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
        });
    </script>

    <div class="col-md-6 col-md-offset-3">
            {!! Form::open(array('url' => URL::to('/new-post', array(), false), '')) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title"class="form-control" />
            </div>
            <div class="form-group">
            {!! Form::select('category[]', $categories, null , array('class'=>'form-control flat', 'id' => '', 'multiple' => true)) !!}
            </div>
            <div class="form-group">
                <textarea name='content'class="form-control">{{ old('content') }}</textarea>
            </div>
            <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
            <input type="submit" name='save' class="btn btn-default" value = "Save Draft" />
        </form>
    </div>
@endsection