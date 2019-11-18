@extends('panel.index')

@section('admin-content')
  <form method="post" action="{{ route('panel.updatepassword') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-xs-12 col-md-6">
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-xs-12">
              <label for="password">Hasło</label>
            </div>
            <div class="col-xs-12">
              <input type="password" name="password" id="password">
              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
            </div>
        </div>
     </div>
      <div class="col-xs-12 col-md-6">
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="col-xs-12">
          <label for="repassword">Powtórz hasło</label>
        </div>
        <div class="col-xs-12">
          <input type="password" name="repassword" id="repassword">
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
      </div>
    </div>
  </div>
    <div class="col-xs-12">
        <button type="submit">Zmień hasło</button>

    </div>
</form>
@endsection
