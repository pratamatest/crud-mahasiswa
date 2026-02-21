<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Data Mahasiswa</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Mahasiswa</button>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NPM</th>
                            <th>Nama Lengkap</th>
                            <th>Prodi</th>
                            <th>Fakultas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $m)
                        <tr>
                            <td>{{ $m->npm }}</td>
                            <td>{{ $m->nama_lengkap }}</td>
                            <td>{{ $m->prodi }}</td>
                            <td>{{ $m->fakultas }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $m->id }}">Edit</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $m->id }}">Hapus</button>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEdit{{ $m->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('mahasiswa.update', $m->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header"><h5>Edit Mahasiswa</h5></div>
                                        <div class="modal-body">
                                            <div class="mb-3"><label>NPM</label><input type="text" name="npm" class="form-control" value="{{ $m->npm }}" readonly></div>
                                            <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="nama_lengkap" class="form-control" value="{{ $m->nama_lengkap }}" required></div>
                                            <div class="mb-3"><label>Prodi</label><input type="text" name="prodi" class="form-control" value="{{ $m->prodi }}" required></div>
                                            <div class="mb-3"><label>Fakultas</label><input type="text" name="fakultas" class="form-control" value="{{ $m->fakultas }}" required></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="modal fade" id="modalHapus{{ $m->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header"><h5>Konfirmasi Hapus</h5></div>
                                    <div class="modal-body">Apakah Anda yakin ingin menghapus <b>{{ $m->nama_lengkap }}</b>?</div>
                                    <div class="modal-footer">
                                        <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Ya, Hapus!</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header"><h5>Tambah Mahasiswa</h5></div>
                    <div class="modal-body">
                        <div class="mb-3"><label>NPM</label><input type="text" name="npm" class="form-control" required></div>
                        <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="nama_lengkap" class="form-control" required></div>
                        <div class="mb-3"><label>Prodi</label><input type="text" name="prodi" class="form-control" required></div>
                        <div class="mb-3"><label>Fakultas</label><input type="text" name="fakultas" class="form-control" required></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>