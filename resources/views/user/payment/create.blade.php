@extends('user.layouts.master')

@section('title')

@endsection

@section('mycss')
    <style>

    </style>
@endsection


@section('content')
    <div class="row my-5">

        <div class="col-10 mx-auto">
            <form action="">
               
            </form>

        </div>
    </div>
@endsection

@section('myjs')
<script>
    function backToPreviousUrl() {
        var previousUrl = "{{ url()->previous() }}";
        window.location.href = previousUrl;
    }
</script>
@endsection
