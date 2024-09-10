<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengarang dan Buku</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="py-3" style="background: #343f52;">
        <h1 class="text-center text-white font-weight-bold">Daftar Pengarang dan Buku</h1>
    </div>
    <div class="container mt-4">
        <!-- Tampilkan Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tampilkan Pesan Kesalahan -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="author">

            <h3 class="mb-4 text-center font-weight-bold">Daftar Pengarang</h3>
            <!-- Tabel Daftar Pengarang -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Action</th> <!-- Tambahkan kolom Action -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($authors as $author)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->email }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('authors.edit', $author->id) }}" class="btn bg-yellow btn-sm">Edit</a>
            
                                <!-- Tombol Delete -->
                                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-red btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada pengarang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
    
            <!-- Pagination Links untuk Pengarang -->
            {{ $authors->links('pagination::bootstrap-4') }}
    
            <!-- Formulir Tambah Pengarang -->
            <div class="mb-4 mt-5 p-4 text-white rounded-25" style="background: #343f52" >
                <form action="{{ route('authors.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Tambah Data Author</button>
                </form>
            </div>
        </div>

        <div class="book">
            <h3 class="mb-4 text-center font-weight-bold">Daftar Buku</h3>
    
            <!-- Tabel Daftar Penulis -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Nomor Seri</th>
                        <th>Tahun Terbit</th>
                        <th>Penulis</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->serial_number }}</td>
                            <td>{{ $book->published_at }}</td>
                            <td>{{ $book->author->name }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                <!-- Tombol Delete -->
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data buku ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada buku ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mb-4 mt-5 p-4 text-white rounded-25" style="background: #343f52">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Judul Buku:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="serial_number">Nomor Seri:</label>
                        <input type="text" name="serial_number" id="serial_number" class="form-control" value="{{ old('serial_number') }}" required>
                        @error('serial_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="published_at">Tahun Terbit:</label>
                        <input type="number" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}" required>
                        @error('published_at')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="author_id">Penulis:</label>
                        <select name="author_id" id="author_id" class="form-control" required>
                            <option value="">Pilih Penulis</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Tambah Buku</button>
                </form>
            </div>

        </div>

    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
