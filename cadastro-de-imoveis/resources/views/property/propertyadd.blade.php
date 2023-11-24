@extends('layout.app')
@section('content')
<form class="row g-3" id="formProperty">
  @csrf
  @method('POST') 
  <div class="col-md-6">
    <label for="inputTitle" class="form-label">Titulo</label>
    <input type="text" class="form-control" id="inputTitle" name="inputTitle">
  </div>
  <div class="col-md-6">
    <label for="inputCod" class="form-label">Código</label>
    <input type="text" class="form-control" id="inputCod" name="inputCod">
  </div>
  <div class="col-6">
    <label for="inputNumberOfRooms" class="form-label">Número de Quartos</label>
    <input type="number" class="form-control" id="inputNumberOfRooms" name="inputNumberOfRooms">
  </div>
  <div class="col-6">
    <label for="inputvalue" class="form-label">Valor</label>
    <input type="text" class="form-control" id="inputvalue" name="inputvalue" placeholder="Apartment, studio, or floor">
  </div>
  <div class="col-md-6">
    <label for="inputConstructionDate" class="form-label">Data de Construção</label>
    <input type="date" class="form-control" id="inputConstructionDate" name="inputConstructionDate">
  </div>
  <div class="col-md-4">
    <label for="inputCategory" class="form-label">Categorias</label>
    <select id="inputCategory" class="form-select" name="inputCategory">
      @foreach ($lisCategory as $version)
        <option value="{{ $version->id }}" @selected(old('name') == $version)>
          {{ $version->title }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-12">
    <label for="inputOthers" class="form-label">Outros</label>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 nopadding">
          <textarea id="txtEditor" name="inputOthers"></textarea> 
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </div>
</form>
<div class="dados"></div>
<script>
$(document).ready(function() {
  $("#txtEditor").Editor();
  //$("#txtEditor").Editor("setText", "Hello")
  //$("#txtEditor").Editor('getText');
});

$(document).on('submit', '#formProperty', function (e) {
  e.preventDefault();

  var getEditor = $('#txtEditor').Editor('getText');
  $('#txtEditor').val(getEditor);
  var dados = $('#formProperty').serializeArray();
          
  $.ajax({
    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
    type: "POST",
    url: "{{ route('property.store') }}",
    data: dados,
    success: function (data) {
      $('.dados').html(data);
    },
    error: function (reject) {
      var response = $.parseJSON(reject.responseText);
      console.log(response);

      if($.isEmptyObject(response.errors) == false) {
        $.each(response.errors,function(key,val){
          $('#'+key+"_error").text(val[0]); 
        });
      }
    }
  });
});
</script>
@endsection