@extends('templates.client')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="card">
            <div class="card-body">
                <textarea class="form-control mb-3" id="listclone" cols="30" rows="10" placeholder="1574240341
100038109124153
100040784721022
100068939451311
100034528666062

1 UID / LINE"></textarea>

                <button class="btn btn-success mb-3" onclick="check_live_uid()" id="checkliveuid">Check live</button>

                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h3 class="bold text-success">LIVE</h3>
                <textarea class="form-control mb-3" id="listclonelive" cols="30" rows="10" readonly></textarea>
                <button class="btn btn-primary" onclick="copy('listclonelive')">Copy</button>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-3">
        <div class="card">
            <div class="card-body">
                <h3 class="bold text-danger">DIE</h3>
                <textarea class="form-control mb-3" id="listclonedie" cols="30" rows="10" readonly></textarea>
                <button class="btn btn-primary" onclick="copy('listclonedie')">Copy</button>
            </div>
        </div>
    </div>

    
</div>

<script>
    var listclone, arrclone, n, c;
    var live, die;

    function check_live_uid() {
        $('#checkliveuid').prop('disabled', true);
        $('#listclonelive').val("");
        $('#listclonedie').val("");
        $('.progress').show();
        n = 0;
        live = 0;
        die = 0;
        listclone = $('#listclone').val().trim();
        arrclone = listclone.split('\n');
        c = arrclone.length;
        for (var i = 0; i < 20; i++) {
            check_live_uid_progress();
        }
    }

    function check_live_uid_progress() {
        n = n + 1;
        var m = n - 1;
        var uid = get_uid(arrclone[m]);
        var url = 'https://graph.facebook.com/' + uid + '/picture?type=normal';
        fetch(url).then((response) => {
            if (/100x100/.test(response.url)) {
                $('.live').show();
                live++;
                $('#live').html(live);
                $('#listclonelive').val($('#listclonelive').val() + arrclone[m] + '\n');
            }else {
                $('.die').show();
                die++;
                $('#die').html(die);
                $('#listclonedie').val($('#listclonedie').val() + arrclone[m] + '\n');
            }
            var r = $(".progress-bar");
            var t = Math.floor(n * 100 / c);
            r.css("width", t + "%"), jQuery("span", r).html(t + "%");
            if (n < c) {
                check_live_uid_progress();
            }else {
                $('#checkliveuid').prop('disabled', false);
                return false;
            }
        });

    }

    function get_uid(data) {
        var clone = data.split("|");
        return clone[0];
    }

    function copy(id) {
        var copyText = document.getElementById(id);
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
    }
</script>

@endsection