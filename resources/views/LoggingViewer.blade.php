<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Log Viewer</title>
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">

    <style>
        .color1{
            background-color: grey;
        }

        .th{
            width: 110px;
        }

    </style>

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col sidebar mb-3 color1">
                <h1>Log Viewer</h1>
                <div class="list-group-item">
                    <a>1</a>
                    <div class="list-group-folder">
                        <a>2</a>
                    </div>
                </div>
            </div>

            <div class="col-10 sidebar mb-3 ">
                <h1>Log Viewer2</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Level</th>
                            <th>User</th>
                            <th class="th">Date-Time</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                        <td>{{ $user->level_name }}</td>
                        <td>{{ $user->user }}</td>
                        <td>{{ $user->date }} {{ $user->time }}</td>
                        <td>{{ $user->message }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
