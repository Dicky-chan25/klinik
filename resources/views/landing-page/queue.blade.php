<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Praktik Mandiri Dokter Asep</title>
    <link rel="stylesheet" href="{{ asset('css/landingpage/index.css') }}">
</head>

<body>
    <div class="ribbon-info">
        <p>Selected clinic <strong style="font-family: 'PoppinsMedium' !important">OPEN ON SUNDAY</strong>. Book
            Appointment Now</p>
    </div>

    @yield('landing-page-form-layout')

    <div class="bg-header">
        @include('landing-page.footer')
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@yield('script')
<script>
    //initialize
    $(".ls-choose").css('opacity', 0);
    $(".ls-data-choosed").css('display', 'none');
    var lsTitle;
    var lsDoctor;
    var lsSchedule;
    var lsPrice;
    var lsTime;
    var lsId;

    // when click choose service
    $(".choose-service").click(function() {
        $(".ls-data-choosed").css('display', 'flex');
        $('.ls-data-title').text(lsTitle)
        $('.ls-data-doctor').text(lsDoctor)
        $('.ls-data-schedule').text(lsSchedule)
        $('.ls-data-time').text(lsTime)
        $('.service_value').val(lsId)
    });

    $(".ls-data").click(function() {
        // reset all change
        $(".ls-data").removeClass('ls-item-active');
        $(".ls-data").addClass('ls-item');
        $(".ls-choose").css('opacity', 0);

        // selected based on item
        var increment = $(this).data("iddata");
        $(".ls-attr" + increment).removeClass('ls-item');
        $(".ls-attr" + increment).addClass('ls-item-active');
        $(".ls-choose" + increment).css('opacity', '100%');

        // get value per data
        lsId = $(this).data("iddata")
        lsTitle = $(this).data("lstitle")
        lsTime = $(this).data("lssclstimehedule")
        lsSchedule = $(this).data("lsschedule")
        lsDoctor = $(this).data("lsdoctor")
        lsPrice = $(this).data("lsprice")
        lsTime = $(this).data("lstime")
    });
</script>
</html>
