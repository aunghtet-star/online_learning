@extends('user.layouts.master')

@section('title')
    Details
@endsection

@section('mycss')
    <style>
        .user-course-detials-card {
            background-color: var(--purple);
        }
        .user-course-detials-card * {
            color: #fff;
        }
        .back-btn {
            background-color: var(--orange);

        }
        .back-btn:hover, .back-btn:active, .back-btn:focus {
            background-color: var(--orange) !important;
        }
    </style>
@endsection


@section('content')
    <div class="row my-5">

        <div class="col-5 mx-auto">

            <div class="row mt-2">
                <div class="user-course-detials-card card shadow p-5">
                    <h2 class="text-center mb-4">{{ $zoom_data->course_name }}</h2>
                    <div>
                        <h3>Link</h3>
                        <p>{{ $zoom_data->link }}</p>
                    </div>
                    <div>
                        <h3>Description</h3>
                        <p>{!! $zoom_data->description !!}</p>
                    </div>
                    <div>
                        <a id="backBtn" href="{{ route('user.index') }}" class="btn back-btn p-3">Back</a>
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
