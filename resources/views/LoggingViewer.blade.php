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

        .levelCell{
            width: 80px;
        }

        .dateCell{
            width: 110px;
        }

        .status[data-status="ERROR"]{
            background-color: #DC143C;
            color : white;
        }

        .status[data-status="INFO"]{
            background-color: #1E90FF;
            color : white;
        }

        .status[data-status="WARNING"]{
            background-color: #FFD700;
            color : black;
        }

        .status[data-status="DEBUG"]{
            background-color: grey;
            color : white;
        }

        .status[data-status="EMERGENCY"]{
            background-color: #FF7F50;
            color : white;
        }

        .status[data-status="NOTICE"]{
            background-color: #87CEFA;
            color : white;
        }

        .status[data-status="CRITICAL"]{
            background-color: #8B0000;
            color : white;
        }

        .status[data-status="ALERT"]{
            background-color: #0000CD;
            color : white;
        }

        .seeAll{
            border: none;
            background-color: transparent;
            color: grey;
            font-size: 12px;
        }

    </style>
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script> -->

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col sidebar mb-3 color1">
                <h1>Log Viewer</h1>
                @foreach ($dates as $date)
                <div class="list-group-item">
                    <a>{{ $date->date }}</a>
                </div>
                @endforeach
            </div>

            <div class="col-10 sidebar mb-3 ">
                <h1>Log Viewer2</h1>
                <table class="table table-striped" id="log">
                    <thead>
                        <tr>
                            <th class="levelCell">Level</th>
                            <th>User</th>
                            <th class="dateCell">Date-Time</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td data-status="{{$user->level_name}}" class="status">{{ $user->level_name }}</td>
                            <td>{{ $user->user }}</td>
                            <td>{{ $user->date }} {{ $user->time }}</td>
                            <td id="message" onClick="showStack()">{{ $user->message }} </td>

                            <!-- @if($user->level_name == "ERROR")
                            <td id="message" onClick="showStack()">{{ $user->message }} 
                                <button class="seeAll" onClick="showStack($user)">(See all)</button>    
                            </td>
                            @else
                            <td id="message" onClick="showStack()">{{ $user->message }} </td>
                            @endif -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <script>
        function showStack($user) {
            document.getElementById("message").innerHTML = "Hello";
        }
    </script> -->
</body>
</html>
