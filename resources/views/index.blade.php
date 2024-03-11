<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">


</head>
<body class="bg-light">
  
    <main class="container">
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
          @include('message')
            <form action='' method='post'>
              @csrf
              @if (Route::current()->uri == 'buku/{id}')
                @method('put')
              @endif
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='judul' id="judul" value="{{ isset($data['judul'])? $data['judul'] : old('judul')}}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Pengarang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='pengarang' id="pengarang" value="{{ isset($data['pengarang'])? $data['pengarang'] : old('pengarang')}}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_publikasi" class="col-sm-2 col-form-label">Tanggal Publikasi</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control w-50" name='tanggal_publikasi' id="tanggal_publikasi" value="{{ isset($data['tanggal_publikasi'])? $data['tanggal_publikasi'] : old('tanggal_publikasi') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <a href="{{ url('buku') }}" type="" class="btn btn-warning" name="submit">CANCEL</a>
                      <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        <!-- START DATA -->
        @if (Route::current()->uri == 'buku')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-striped" id="example">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-4">Judul</th>
                        <th class="col-md-3">Pengarang</th>
                        <th class="col-md-2">Tanggal Publikasi</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $item)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $item['judul'] }}</td>
                      <td>{{ $item['pengarang'] }}</td>
                      <td>{{ date('d-m-Y',strtotime($item['tanggal_publikasi'])) }}</td>
                      <td>
                        <a href="{{ url('buku/'.$item['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ url('buku/'.$item['id']) }}" method="post" onsubmit="return confirm('Are you sure to delete this data ?')" class="d-inline">
                          @csrf
                          @method('delete')
                          <button type="submit" name="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>

        </div>
        @endif
        <!-- AKHIR DATA -->
    </main>
    <script>
      new DataTable('#example');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>

</body>

</html>