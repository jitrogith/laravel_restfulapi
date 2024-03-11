@if (Session::has('success'))
  <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@if ($errors->any())
  <div class="alert alert-danger">
    @foreach ($errors->all() as $item)
      <li>{{ $item }}</li>
    @endforeach
  </div>
@endif