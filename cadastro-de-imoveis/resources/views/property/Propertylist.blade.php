@extends('layout.app')
@section('content')
<a href="{{ route('property.create') }}"><button type="button" class="btn btn-primary btn-lg">Incluir Inmovél</button></a>
<form class="row g-3" method="GET" id="formSearch">
    <div class="col-auto">
        <input type="text" class="form-control" id="inputText" name="inputText" placeholder="Digite aqui">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3" id="searchProperty">Procurar</button>
    </div> 
</form>
<div class="row">
  <div class="col-lg">
      <div class="p-5">
          <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Lista de Candidatos</h1>
          </div>
          <div class="container text-center" id="listAjax"></div>
      </div>
  </div>
</div>
<div class="dados"></div>
<script>
$(function() {
    loadData(null);
});

function loadData(data) {
    $.ajax({
        method : 'GET',
        url    : "{{ route('property.index') }}",
        data   : data,
        success	: function(html) {
            $('#listAjax').html(html);
        },
        error: function (error) {
            console.log(error);
        }
    }); 
}

$('#searchProperty').on('click', function(e) {
    e.preventDefault();

    var dados = $('#formSearch').serialize();

    loadData(dados);
});

$('#deleteProperty').on('click', function(e) {
    e.preventDefault();

    $.ajax({
        method	: 'delete',
        url     : $(this).attr('href'),
        data	: {
                    _token	: $(this).data('token')
                },
        dataType: 'json',
        success	: function(data) {
            $("#name_"+data).remove();
        },
        error: function (error) {
            console.log(error);
        }
    }); 
});

$(document).on('click','#exaModal' , function () {
    var hrf = $(this).data('href');
    
    $.ajax({
            method	: 'GET',
            url     : hrf,
            success	: function(data) {
                var dataProperty = data['property'];

                $("#inputId").val(dataProperty.id);
                $("#inputTitle").val(dataProperty.title);
                $("#inputCod").val(dataProperty.code);
                $("#inputNumberOfRooms").val(dataProperty.number_of_rooms);
                $("#inputvalue").val(dataProperty.value);
                $("#inputConstructionDate").val(dataProperty.construction_date);
                $("#txtEditor").val(dataProperty.others);
                //$("#txtEditor").Editor("setText",$("#inputOthers").val(data.others));
                $("#txtEditor").Editor("setText",dataProperty.others);

                $.each(data['category'], function(index, value){
                    console.log(value.id);
                    $("<option/>", {
                        value: value.id,
                        text: value.title
                    }).appendTo($('#inputCategory'));
                });                
            },
            error: function (error) {
            }
    });
})

$(document).on('submit', '#formEditProperty', function (e) {
    e.preventDefault();

    var getEditor = $('#txtEditor').Editor('getText');
    $('#txtEditor').val(getEditor);

    var dados = $('#formEditProperty').serializeArray();    
    var id = dados[2].value;
    
    $.ajax({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        type: "PUT",
        url: "/propriedade/update/"+id,
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