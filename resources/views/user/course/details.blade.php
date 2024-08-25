@extends('user.layouts.master')

@section('title')
    Details
@endsection

@section('mycss')
    <style>

    </style>
@endsection


@section('content')
    <div class="row my-5">

        <div class="col-10 mx-auto">
            <a id="backBtn" href="{{route('user.index')}}"  class="btn btn-secondary p-3">Back</a>
            <div class="row mt-2">
                <div class="col-12 col-xl-8 ">
                    <div class="">
                        <video width="100%" height="600px" controls>
                            <source src="{{ asset('storage/courseVideo/'. $course->course_video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        {{-- <img class="w-100 h-75" src="{{ asset('storage/courseImage/' . $course->image) }}" alt=""> --}}
                    </div>
                    <h1>{{ $course->name }}</h1>
                    <p>{!! $course->description !!}</p>
                    <p>hello</p>
                </div>
                <div class="col-12 col-xl-3 ">
                    <div class=" card shadow p-5">
                        <div class="card-body">
                            <div class="mb-3 ">
                                <label>Instructor name</label>
                                <input type="text" class="form-control mt-3" disabled
                                    value="{{ $course->instructor_name }}">
                            </div>
                            <div class="mb-4">
                                <label for="">Price</label>
                                <input type="text" class="form-control mt-3" disabled value="{{ $course->price }} mmk">
                            </div>
                            <p>Kpay (09 771982598)</p>
                            <!-- Button trigger modal -->
                            <button class="btn btn-success w-100" data-bs-toggle="modal"
                                data-bs-target="#paymentModal">Enroll</button>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="paymentModalLabel">ငွေလွှဲပြေစာ screenshot ထည့်ပြီး
                                    အပ်နိုင်ပါသည်</h1>
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button> --}}
                            </div>
                            <div class="modal-body">
                                <form id="paymentForm" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="courseId" value="{{ $course->id }}">

                                    <label for="paymentSS">Screenshot *</label>
                                    <input type="file" class="form-control" name="paymentImage" id="paymentImage">
                                    <span class="text-danger" class="error" id="paymentImageError"></span>

                                    <div class="text-end mt-3">
                                        <button type="button" class="close-btn btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('myjs')
    <script>
        function backToPreviousUrl() {
            var previousUrl = "{{ url()->previous() }}";
            window.location.href = previousUrl;
        };

        $('#paymentForm').submit(function(e) {
            e.preventDefault();
            // form ကို key value အနေနဲ့ ပြောင်းဖို့
            let formData = new FormData(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('user.payment.create') }}",
                data: formData,
                // dataType: "dataType",
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 400) {
                        // alert(response.errors.paymentImage);
                        $('#paymentImageError').text(response.errors.paymentImage);
                        // $('#paymentForm').find('input').val(''); // clear input
                        // $('#paymentImageError').text(''); // clear error message
                    }

                    if (response.status === 200) {
                        $('#paymentForm').find('input').val(''); // clear input
                        $('#paymentImageError').text(''); // clear error message
                        // [0] ထညိ့တာက jquery object return ပြန်ပေးလိုက်လို့ first ကောင်ကို ယူလိုက်တာ
                        // $('#paymentForm')[0].reset();
                        alert(response.message);
                        $('#paymentModal').modal('hide');
                    }
                }
            });

        })

        // close btn နှိပ်ရင်
        $('.close-btn').click(function() {
            $('#paymentForm').find('input').val(''); // clear input
            $('#paymentImageError').text(''); // clear error message
        })


        $('#sendBtn').click(function() {
            $paymentImage = $(this).val().split('\\').pop();
            console.log($paymentImage);

            // $.ajax({
            //     type: "get",
            //     url: "/user/payment/create",
            //     data: {
            //         'paymentImage' : $paymentImage,
            //         'user_id' : 5,
            //     },
            //     dataType: "JSON",
            //     success: function (response) {
            //         console.log(response.message);
            //     }
            // });


        })


        // console.log();
        // $data = {
        //     payment: $paymentImage
        // }
        // $.ajax({
        //     type: "get",
        //     url: "{{ route('user.payment.create') }}",
        //     data: $data,
        //     dataType: "json",
        //     success: function (response) {

        //     }
        // });
    </script>
@endsection
