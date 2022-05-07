@extends('templates.client')

@section('content')
<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter secret key" id="secret">
                    <span class="input-group-text" style="padding: 0;">
                        <button class="btn btn-success send" style="border-top-left-radius: 0; border-bottom-left-radius: 0;" onclick="getToken()">Get Token</button>
                    </span>
                </div>

                <h1 class="bold mt-3" id="result">
                    Please enter secret key!
                </h1>
            </div>
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>

<script>
    function getToken() {
        $(".send").text('Loading...').attr('disabled', 'disabled')
        $.ajax({
            type: "GET",
            url: "https://authenticator.bethanh.vn/get-token?key=" + $("#secret").val(),
            success: function (response) {
                $(".send").text('Get Token').removeAttr('disabled')
                
                if (response.ok) {
                    $("#result").addClass('text-success').text(response.data.token)
                } else {
                    Swal.fire({
                        title: "{{ __('system.swal_title_failed') }}",
                        text: response.message,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '{{ __("system.swal_btn_close") }}'
                    })
                }
            }
        });
    }
</script>
@endsection