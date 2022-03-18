@extends("layouts.global")

@section("title") Edit Book @endsection

@section("content")
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<form class="bg-white shadow-sm p-3" action="{{route('books.update', [$book->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="PUT" name="_method">

    <label for="title">Title</label>
    <input type="text" name="title" class="form-control {{$errors->first('title') ? 'is-invalid' : ''}}" id="title" placeholder="Book title" value="{{old('title') ? old('title') : $book->title}}">
    <div class="invalid-feedback">
        {{$errors->first('title')}}
    </div>
    <br>

    <label for="title">Slug</label>
    <input type="text" name="slug" class="form-control {{$errors->first('slug') ? 'is-invalid' : ''}}" id="slug" placeholder="Book slug" value="{{old('slug') ? old('slug') : $book->slug}}">
    <div class="invalid-feedback">
        {{$errors->first('slug')}}
    </div>
    <br>

    <label for="cover">Cover</label>
    <br>
    Current Avatar : <br>
    @if ($book->cover)
    <img src="{{asset('storage/'. $book->cover)}}" width="120px">
    <br>
    @else
    No Avatar
    @endif
    <br>
    <input type="file" name="cover" class="form-control" id="cover">
    <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
    <hr class="my-3">

    <label for="categories">Categories</label>
    <br>
    <select name="categories[]" id="categories" class="form-control" multiple></select>
    <br>
    <br>

    <label for="description">Description</label>
    <textarea name="description" class="form-control {{$errors->first('description') ? 'is-invalid' : ''}}" id="description" cols="30" rows="4" placeholder="Give a description about this book">{{old('description') ? old('description') : $book->description}}</textarea>
    <div class="invalid-feedback">
        {{$errors->first('description')}}
    </div>
    <br>

    <label for="Stock">Stock</label>
    <input type="number" class="form-control {{$errors->first('stock') ? 'is-invalid' : ''}}" name="stock" id="stock" min="0" value="{{old('stock') ? old('stock') : $book->stock}}">
    <div class="invalid-feedback">
        {{$errors->first('stock')}}
    </div>
    <br>

    <label for="author">Author</label>
    <input type="text" name="author" class="form-control {{$errors->first('author') ? 'is-invalid' : ''}}" id="author" placeholder="Book author" value="{{old('author') ? old('author') : $book->author}}">
    <div class="invalid-feedback">
        {{$errors->first('author')}}
    </div>
    <br>

    <label for="publisher">Publisher</label>
    <input type="text" name="publisher" class="form-control {{$errors->first('publisher') ? 'is-invalid' : ''}}" id="publisher" placeholder="Book publisher" value="{{old('publisher') ? old('publisher') : $book->publisher}}">
    <div class="invalid-feedback">
        {{$errors->first('publisher')}}
    </div>
    <br>

    <label for="price">Price</label>
    <input type="number" class="form-control {{$errors->first('price') ? 'is-invalid' : ''}}" name="price" id="price" placeholder="Book price" value="{{old('price') ? old('price') : $book->price}}">
    <div class="invalid-feedback">
        {{$errors->first('price')}}
    </div>
    <br>

    <button class="btn btn-primary" name="status" value="PUBLISH">UPDATE</button>
</form>
@endsection

@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#categories').select2({
        ajax: {
            url: 'http://larashop.test/ajax/categories/search',
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                }
            }
        }
    });

    var categories = {!! $book->categories !!}
    
    categories.forEach(function(category) {
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
    });
</script>

@endsection