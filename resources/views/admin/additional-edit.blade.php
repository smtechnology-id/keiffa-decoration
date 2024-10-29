@extends('layouts.app')

@section('active-additional', 'active-page')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Additional</h5>
            <form action="{{ route('admin.additional.updatePost') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="image">Image</label>
                        <img src="{{ asset('storage/additional/' . $additional->image) }}" alt="Image"
                            style="max-width: 100%; margin-top: 10px; height: 200px; object-fit: cover;">
                        <input type="file" name="image" id="image" class="form-control" required accept="image/*"
                            onchange="previewImage(event)">
                        <input type="hidden" name="oldImage" value="{{ $additional->image }}">
                        <img id="imagePreview" src="#" alt="Image Preview"
                            style="display:none; max-width:100%; margin-top:10px; height: 200px; object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nama">Additional Name</label>
                            <input type="hidden" name="id" id="id" value="{{ $additional->id }}">
                            <input type="text" name="nama" id="nama" class="form-control"
                                placeholder="Additional Name" required value="{{ $additional->nama }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="additional_number">Additional Number</label>
                            <input type="number" name="additional_number" id="additional_number" class="form-control"
                                placeholder="Additional Number" required value="000{{ $additional->additional_number }}"
                                readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" placeholder="Price"
                                required value="{{ $additional->harga }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" required>{{ $additional->deskripsi }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary" style="background-color: #7E4752; border-color: #fff;">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
