<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')
        <script id="container" name="detail" type="text/plain">
            {!! old($column, $value) !!}
        </script>
    </div>
</div>