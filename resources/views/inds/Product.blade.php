<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-3 pl-0">
    <div class="card flex-md-row mb-4 box-shadow  h-100">
        <div class="card-body d-flex flex-column align-items-start">
            <strong class="d-inline-block mb-2 text-primary">{{$product->category->name}}</strong>
            <h3 class="mb-0">
                <a class="text-dark" href="{{route('product', $product->id)}}">{{$product->name}}</a>
            </h3>
            <div class="mb-1 text-muted size-14">{{$product->price}}$</div>
            <p class="card-text mb-auto">{{Str::limit($product->description, 80)}}</p>
            <div class="d-flex align-items-center justify-content-center w-100">
                <form action="{{route('main.order.create', $product)}}" method="GET">
                    <button type="submit" class="btn btn-primary mr-5">Buy</button>
                </form>
                <form action="{{route('baskets.add', $product->id)}}">
                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-shopping-cart"></i></button>
                </form>
            </div>
        </div>
        <div class="img">
            <img class="img" src="{{asset('/storage/' . $product->image)}}" style="width: 200px; height: auto;" data-holder-rendered="true">
        </div>

    </div>
</div>