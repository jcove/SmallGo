<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <div id="{{$id}}" style="width: 100%; height: 100%;" class="input-group iconpicker-container">
            <p>{!! old($column, $value) !!}</p>
        </div>

        <input type="text" name="{{$name}}" value="{{ old($column, $value) }}" id="category-icon"/>

    </div>
</div>