
  <div class="form-group col-12">
    <label for="name">Nombre : </label>
    <input type="text" name="name" id="name" class="form-control">
  </div>
  @if ($errors->has('name'))
  <div class="alert alert-danger">{{ $errors->first('name') }}</div>
  @endif

  <div class="form-group col-12">
    <label for="location">Ubicacion : </label>
    <input type="text" name="location" id="location" class="form-control">
  </div>
  @if ($errors->has('location'))
  <div class="alert alert-danger">{{ $errors->first('location') }}</div>
  @endif

