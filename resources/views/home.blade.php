<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <title>{{ env('APP_NAME', "IDLE NODE") }} - API</title>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        type="text/css"
    />

    <style type="text/css">

        .bg-primary-75 {
            background: #007bffaa; !important;
        }

    </style>

</head>
<body>

    <div class="container">

        <!-- HEADER -->
        <div class="row bg-primary-75 text-white">
            <h1 class="display-2">IDLE NODE API</h1>
        </div>

        <br />

        <!-- CONTENT -->

        <table class="table table-bordered">
            <thead class="text-center font-weight-bold">
                <td>No</td>
                <td>Variable</td>
                <td>Values</td>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Time Zone</td>
                    <td>{{ date_default_timezone_get() }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Current Time</td>
                    <td>{{ (new \App\Facade\TimeFacade())->getStringifiedEpochTime() }}</td>
                </tr>
            </tbody>
        </table>

    </div>

</body>
</html>
