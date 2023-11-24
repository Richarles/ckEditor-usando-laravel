<table class="table">
  <thead>
      <tr>
          @foreach (['Titulo','Alterar','Excluir'] as $key => $title)
              <th scope="col">{{ $title }}</th>
          @endforeach
      </tr>
  </thead>
  <tbody id="tb">
    @foreach ($listCategory as $item)
      <tr class="delete" id="name_{{$item->id}}">
        <td > {{ $item->title }} </td>
        <td class="col-2">
          <button type="button" id="exaModal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-href="{{ route('category.edit',$item->id) }}">
            Alterar
          </button>
        </td>
        <td><a data-href="{{ route('category.delete',$item->id) }}" id="deleteCategory" data-token="{{ csrf_token() }}" data-id="{{$item->id}}">
          <button type="button" class="btn btn-danger">Excluir</button>
        </a></td>
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
        <form class="row g-3" id="formEditCategory">
            @csrf
            @method('POST') 
            <input type="hidden" class="form-control" id="inputId" name="inputId">
              <div class="col-md-6">
                <label for="inputTitle" class="form-label">Titulo</label>
                <input type="text" class="form-control" id="inputTitle" name="inputTitle">
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Alterar</button>
              </div>
            </form>
      </div>
    </div>
  </div>
</div>
<div class="dados"></div>