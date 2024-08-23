@extends('admin.layouts.master')

@section('title')
    Payment
@endsection

@section('myCss')
    <style>
        .payment-send-btn:hover {
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <h2 class="text-center mb-3 font-weight-bold">Payment List</h2>
            {{-- @if (session('createSuccess'))
            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="alert alert-default-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('createSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
            </div>
            @endif
            @if (session('updateSuccess'))
            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="alert alert-default-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('updateSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
            </div>
            @endif --}}

            <div class="card mt-3">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Payment Image</th>
                                <th>Course</th>
                                {{-- <th>Address</th> --}}
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            ?>
                            @foreach ($paidUsers as $payment)
                                <tr style="line-height: 90px;">
                                    <td>{{ $num }}</td>
                                    <td>{{ $payment->name }}</td>
                                    <td>{{ $payment->email }}</td>
                                    <td>
                                        <a href="{{ asset('storage/paymentImage/' . $payment->image) }}" target="_blank"><img width="100px" src="{{ asset('storage/paymentImage/' . $payment->image) }}"
                                            alt=""></a>
                                    </td>
                                    <td>
                                        {{ $payment->course_name }}
                                    </td>
                                    <td class=""><a href="{{ route('admin.zoomLink.create', $payment->id) }}" class="payment-send-btn btn btn-warning" title="zoom link ပို့မယ်">
                                        <i class="far fa-paper-plane me-2"></i>Send</a></td>
                                </tr>

                                <?php $num++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
