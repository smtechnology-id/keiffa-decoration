@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data User</h5>

                <div class="table-responsive">
                    <table id="datatable1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->no_hp }}</td>
                                    <td>{{ $user->jenis_kelamin }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#userModal{{ $user->id }}" style="background-color: #7E4752; border: none;">
                                            Detail
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1"
                                            aria-labelledby="userModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.user.update') }}" method="post">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="userModalLabel">Detail User
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $user->id }}">
                                                            <div class="form-group mb-3">
                                                                <label for="name">Nama</label>
                                                                <input type="text" name="name" id="name"
                                                                    class="form-control" value="{{ $user->name }}"
                                                                    required placeholder="Nama">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="email">Email</label>
                                                                <input type="email" name="email" id="email"
                                                                    class="form-control" value="{{ $user->email }}"
                                                                    required placeholder="Email">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="no_hp">No. HP</label>
                                                                <input type="text" name="no_hp" id="no_hp"
                                                                    class="form-control" value="{{ $user->no_hp }}"
                                                                    required placeholder="No. HP">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control"
                                                                    required>
                                                                    <option value="Laki-laki"
                                                                        {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                                                        Laki-laki</option>
                                                                    <option value="Perempuan"
                                                                        {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                </select>
                                                            </div>

                                                            {{-- Update Password --}}
                                                            <div class="form-group mb-3">
                                                                <label for="password">Password</label>
                                                                <input type="password" name="password" id="password"
                                                                    class="form-control" placeholder="********">
                                                                <small class="text-muted">Kosongkan jika tidak ingin
                                                                    mengubah password</small>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="password_confirmation">Konfirmasi
                                                                    Password</label>
                                                                <input type="password" name="password_confirmation"
                                                                    id="password_confirmation" class="form-control"
                                                                    placeholder="********">
                                                                <small class="text-muted">Kosongkan jika tidak ingin
                                                                    mengubah password</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
