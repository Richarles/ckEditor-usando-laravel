@extends('layout.app')
@section('content')
<a href="{{ route('category.create') }}"><button type="button" class="btn btn-primary btn-lg">Incluir Imovél</button></a>
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
                <h1 class="h4 text-gray-900 mb-4">Lista de Categorias</h1>
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
            method	: 'GET',
            url     : "{{ route('category.index') }}",
            data: data,
            success	: function(html) {
                $('#listAjax').html(html);
            },
            error: function (error) {}
        }); 
    }

    $('#searchProperty').on('click', function(e) {
        e.preventDefault();

        var dados = $('#formSearch').serialize();

        loadData(dados);
    });
  
    $(document).on('click','#deleteCategory', function(e) {
        e.preventDefault();
        var hrf = $(this).data('href');

        $.ajax({
            method	: 'delete',
            url     : hrf,
            data	: {
                        _token	: $(this).data('token')
                    },
            success	: function(data) {},
            error: function (error) {}
        }); 
    });
  
    $(document).on('click','#exaModal', function () {
        var hrf = $(this).data('href');

        $.ajax({
            method	: 'GET',
            url     : hrf,
            success	: function(data) {
                $("#inputTitle").val(data.category.title);
                $("#inputId").val(data.category.id);
            },
            error: function (error) {}
       });
    })
  
    $(document).on('submit', '#formEditCategory', function (e) {
        e.preventDefault();

        var dados = $('#formEditCategory').serializeArray();
        var id = dados[2].value;

        $.ajax({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            type: "PUT",
            url: "/Category/alterar/"+id,
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