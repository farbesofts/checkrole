<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Unauthorized Access</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Unauthorized View') }}</div>
                        <div class="card-body text-center">
                            <h3>UNATHORIZED ACCESS</h3>
                            <p>
                                    @php
                                    $timetable = session()->get('timetable');
                                    $time_initiate = \Carbon\Carbon::parse($timetable->time_initiate)->format('h:i a');
                                    $time_end = \Carbon\Carbon::parse($timetable->time_end)->format('h:i a');
                                    @endphp
                                    <h5>Allowed Timetable: <strong>From {{ $time_initiate }} To {{ $time_end }}</strong></h5>
                                </p>
                                <p>
                                    <a href="/home" class="btn btn-primary" >Return To Home</a>
                                </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>