@section('form')
    <fieldset>
        @include('helpers.form_text', ['field' => 'address', 'model' => $model])
@include('helpers.form_text', ['field' => 'address2', 'model' => $model])
@include('helpers.form_text', ['field' => 'city', 'model' => $model])
@include('helpers.form_text', ['field' => 'state', 'model' => $model])
@include('helpers.form_text', ['field' => 'postal', 'model' => $model])
        @include('helpers.form_submit')
    </fieldset>
@show