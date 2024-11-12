@extends('layouts.app')

@section('active-review', 'active-page')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">Review Kaiffa Decoration</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="datatable1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Order ID </th>
                                <th>Nama Venue</th>
                                <th>Foto Venue</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <td>{{ $review->order->code_order }}</td>
                                    <td>{{ $review->nama_venue }}</td>
                                    <td>
                                       <a href="{{ asset('storage/review_image/' . $review->image) }}" target="_blank">View Foto</a>
                                    </td>
                                    <td>{{ $review->review }}</td>
                                    <td>
                                        @if ($review->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($review->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif ($review->status == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                       @if ($review->status == 'pending')
                                            <a href="{{ route('admin.review.approve', $review->id) }}" class="btn btn-success mt-2" style="background-color: #7E4752; border: none;">Approve</a>
                                            <a href="{{ route('admin.review.reject', $review->id) }}" class="btn btn-danger mt-2" style="background-color: #7E4752; border: none;">Reject</a>
                                        @elseif ($review->status == 'approved')
                                        <a href="{{ route('admin.review.reject', $review->id) }}" class="btn btn-danger mt-2" style="background-color: #7E4752; border: none;">Reject</a>
                                        @elseif ($review->status == 'rejected')
                                        <a href="{{ route('admin.review.approve', $review->id) }}" class="btn btn-success mt-2" style="background-color: #7E4752; border: none;">Approve</a>
                                        @endif
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
