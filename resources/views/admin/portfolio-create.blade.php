@extends('layouts.app')

@section('active-additional', 'active-page')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Portfolio</h5>
            <form action="{{ route('admin.portfolio.createPost') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*"
                            onchange="previewImage(event)">
                        <img id="imagePreview" src="#" alt="Image Preview"
                            style="display:none; max-width:100%; margin-top:10px; height: 200px; object-fit: cover;">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="package_name">Nama Paket</label>
                            <input type="text" name="package_name" id="package_name" class="form-control"
                                placeholder="Nama Paket" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="venue_name">Nama Venue</label>
                            <input type="text" name="venue_name" id="venue_name" class="form-control"
                                placeholder="Nama Venue" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="bride_name">Nama Pengantin Wanita</label>
                            <input type="text" name="bride_name" id="bride_name" class="form-control"
                                placeholder="Nama Pengantin Wanita" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="groom_name">Nama Pengantin Pria</label>
                            <input type="text" name="groom_name" id="groom_name" class="form-control"
                                placeholder="Nama Pengantin Pria" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="total_price">Total Harga</label>
                            <input type="number" name="total_price" id="total_price" class="form-control"
                                placeholder="Total Harga" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="code_order">Kode Pesanan</label>
                            <input type="text" name="code_order" id="code_order" class="form-control"
                                placeholder="Kode Pesanan" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control" placeholder="Lokasi"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #7E4752; border-color: #fff;">Buat</button>
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
