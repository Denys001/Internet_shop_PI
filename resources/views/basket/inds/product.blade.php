<div class="w-100 mb-2">
    <div class="card flex-md-row mb-4 box-shadow  h-100">
        <div class="img ml-3">
            <img class="img" src="{{asset('/storage/' . $product->image)}}" style="width: 200px; height: auto;" data-holder-rendered="true">
        </div>
        <div class="card-body d-flex flex-column align-items-start">
            <strong class="d-inline-block mb-2 text-primary w-100 text-center">{{$product->category->name}}</strong>
            <h3 class="mb-0 w-100 text-center">
                <a class="text-dark w-100 text-center" href="{{route('product', $product->id)}}">{{$product->name}}</a>
            </h3>
            <div class="mb-1 text-muted size-14 w-100 text-center">{{$product->price}}$</div>
            <p class="card-text mb-auto text-justify">{{Str::limit($product->description, 120)}}</p>
        </div>
        <div class="d-flex flex-column align-items-center justify-content-center w-25">
            <form class="w-25" action="{{route('main.order.create', $product->id)}}" method="GET">
                <button type="submit" class="btn btn-primary w-100 mb-3">Buy</button>
            </form>
            <button onclick="$('{{'#modal' . $product->id}}').modal('show')" class="btn btn-outline-secondary w-25"><i class="fas fa-trash"></i></button>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="{{'modal' . $product->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure that you want to delete this product from the basket?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('baskets.destroy', $basket->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Yes</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>