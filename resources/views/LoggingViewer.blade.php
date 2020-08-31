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
        a{
            text-decoration: none;
            color: black;
        }

        a:hover{
            text-decoration: none;
            color: 	#696969;
        }

        .levelCell{ width: 80px; }
        .dateCell{ width: 110px; }
        
        .color1{ 
            background-color: #A9A9A9; 
            min-height: 100vh;
        }

        .status[data-status="ERROR"]{
            background-color: #DC143C;
            color : white;
            text-align: center;
        }

        .status[data-status="INFO"]{
            background-color: #1E90FF;
            color : white;
            text-align: center;
        }

        .status[data-status="WARNING"]{
            background-color: #FFD700;
            color : black;
            text-align: center;
        }

        .status[data-status="DEBUG"]{
            background-color: grey;
            color : white;
            text-align: center;
        }

        .status[data-status="EMERGENCY"]{
            background-color: #FF7F50;
            color : white;
            text-align: center;
        }

        .status[data-status="NOTICE"]{
            background-color: #87CEFA;
            color : white;
            text-align: center;
        }

        .status[data-status="CRITICAL"]{
            background-color: #8B0000;
            color : white;
            text-align: center;
        }

        .status[data-status="ALERT"]{
            background-color: #0000CD;
            color : white;
            text-align: center;
        }

        .seeAll{
            border: none;
            background-color: transparent;
            color: grey;
            font-size: 12px;
        }

        .logDate{
            padding: 10px;
            border: none;
            width: 100%;
        }

        .dateSelect{
            border: none;
            padding: 5px 0px 5px 5px;
        }

        .selectBtn{
            border: none;
            margin-bottom: 30px;
            width: 100%;
        }

        #stack{
            display: none;
            white-space: pre-line;
        }

        #see:focus + div#stack{
            display: block;
        }

        #date{
            border: none;
            background-color: transparent;
            font-size: 16px;
        }

        #select{
            width: 100%; 
            height: 30px;
            margin-bottom: 20px;
        }

    </style>
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col sidebar color1">
                <h1 style="margin-bottom: 20px; margin-top: 10px; text-align: center;">
                    <a href="{{route('view')}}">Log Viewer</a>
                </h1>

                    <form method="post" id="selectDropdown" action="{{route('send')}}">
                        <select id="select"  name="select" onchange="document.getElementById('selectDropdown').submit();">
                            <option value="">Select Month</option>
                            <option value="01">January</option>
                            <option value="02">Febuary</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </form>

                    <h3 id="showMonth" style="text-align: center; margin-bottom: 20px;">{{$select}}</h3>

                    @if($dates->isEmpty())
                    <p style="text-align: center;">There is no log in {{$select}}</p>
                    @else
                        @foreach ($dates as $date)
                            <div class="list-group-item">
                                <a href="{{route('show', ['id' => $date->date])}}">{{ $date->date }}</a>
                            </div>
                        @endforeach
                    @endif
            </div>

            <div class="col-10 sidebar mb-3">
                <table class="table table-striped" id="log">
                    <thead>
                        <tr>
                            <th class="levelCell" style="text-align: center">Level</th>
                            <th class="dateCell" style="text-align: center">User</th>
                            <th class="dateCell" style="text-align: center">Date-Time</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($users->isEmpty())
                    <tr>
                        <td colspan="4" style="text-align: center">No log data available in this month</td>
                    </tr>
                    @else
                        @foreach ($users as $user)
                        <tr>
                            <td data-status="{{$user->level_name}}" class="status">{{ $user->level_name }}</td>
                            <td style="text-align: center">{{ $user->user }}</td>
                            <td>{{ $user->date }} {{ $user->time }}</td>
                            
                            @if($user->level_name == "ERROR")
                            <td id="message">{{ $user->message }} 
                                <button id="see" class="seeAll">See All</button>
                                <div id="stack">
                                    {{ $user->stack }}
                                </div>
                            </td>
                            @else
                            <td>{{ $user->message }} </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>

</body>
</html>
