@if (Route::current()->uri == 'buku')
  @method('post')
@endif

@if (Route::current()->uri == 'buku/{id}')
  @method('put')
@endif