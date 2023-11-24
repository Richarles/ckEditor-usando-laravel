@extends('layout.app')
@section('content')
<form class="row g-3" id="formCategory">
  @csrf
  @method('POST') 
  <div class="col-md-6">
    <label for="inputTitle" class="form-label">Titulo</label>
    <input type="text" class="form-control" id="inputTitle" name="inputTitle">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </div>
</form>
<div class="dados"></div>
<script>
$(document).on('submit', '#formCategory', function (e) {
  e.preventDefault();

  var dados = $('#formCategory').serializeArray();

  $.ajax({
    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
    type: "POST",
    url: "{{ route('category.store') }}",
    data: dados,
    success: function (data) {
      $('.dados').html(data);
    },
    error: function (reject) {
      var response = $.parseJSON(reject.responseText);

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