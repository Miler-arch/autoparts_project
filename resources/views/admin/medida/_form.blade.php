<div class="form-group">
  <label for="name">Nombre :</label>
  <input type="text" name="name" id="name" class="form-control" placeholder="Unidad, Caja, Paquete">
</div>
@if ($errors->has('name'))
  <div class="alert alert-danger">{{ $errors->first('name') }}</div>
@endif