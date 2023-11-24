<table class="table">
  <thead>
    <tr>
      @foreach (['Titulo','Categoria','número de quartos','Alterar','Excluir'] as $key => $title)
        <th scope="col">{{ $title }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody id="tb">
    @foreach ($listProperty as $item)
      <tr class="delete" id="name_{{$item->id}}">
        <td > {{ $item->title }} </td>
        <td > {{ $item->category->title }} </td>
        <td > {{ $item->number_of_rooms }} </td>
        <td class="col-2"><button type="button" id="exaModal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('property.edit',$item->id) }}">
          Alterar
        </button></td>
        <td><a href="{{ route('property.delete',$item->id) }}" id="deleteProperty" data-token="{{ csrf_token() }}" data-id="{{$item->id}}"><button type="button" class="btn btn-danger">Excluir</button></a></td>
      </tr>
    @endforeach
  </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="formEditProperty">
          @csrf
          @method('POST') 
          <input type="hidden" class="form-control" id="inputId" name="inputId">
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
                <option id="category" value="0">------------</option>
            </select>
          </div>
          <div class="col-md-12">
            <label for="inputOthers" class="form-label">Outros</label>
            <textarea id="txtEditor" name="inputOthers"></textarea> 
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="dados"></div>
<script>
  $(document).ready(function() {
		$("#txtEditor").Editor();
    //$("#txtEditor").Editor("getText");
	});
</script>