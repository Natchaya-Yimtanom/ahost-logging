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
        
        .rowColor{ 
            background-color: #A9A9A9; 
            min-height: 100vh;
        }

        .status[data-status="ERROR"]{
            background-color: #DC143C;
            color : white;
            text-align: center;
        }

        .status[data-status="INFO"]{
            background-color: #32CD32;
            color : white;
            text-align: center;
        }

        .status[data-status="WARNING"]{
            background-color: #FFD700;
            color : black;
            text-align: center;
        }

        .status[data-status="DEBUG"]{
            background-color: #00008B;
            color : white;
            text-align: center;
        }

        .status[data-status="EMERGENCY"]{
            background-color: #FF8C00;
            color : white;
            text-align: center;
        }

        .status[data-status="NOTICE"]{
            background-color: #1E90FF;
            color : white;
            text-align: center;
        }

        .status[data-status="CRITICAL"]{
            background-color: #8B0000;
            color : white;
            text-align: center;
        }

        .status[data-status="ALERT"]{
            background-color: #8B008B;
            color : white;
            text-align: center;
        }

        .seeAll{
            border: none;
            background-color: transparent;
            color: grey;
            font-size: 12px;
            cursor: pointer;
        }

        .activeDate{
            background-color: #DCDCDC;
        }

        .selectDate{
            width: 100%;
            text-align: center;
            cursor: pointer;
        }

        #stack{
            display: none;
            white-space: pre-line;
        }

        #see:focus + div#stack{
            display: block;
        }

        #select{
            width: 100%; 
            height: 30px;
            margin-bottom: 20px;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col sidebar rowColor">
                <h1 style="margin-bottom: 20px; margin-top: 10px; text-align: center;">
                    <a href="{{route('view')}}">Log Viewer</a>
                </h1>

                    <form method="post" id="selectDropdown" action="{{route('send')}}">
                        <select id="select"  name="select" onchange="document.getElementById('selectDropdown').submit();">
                            <option value="">{{$select}}</option>
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
                            @if($date->date == $id)
                                <input type="button" value="{{ $date->date }}" class="list-group-item selectDate activeDate "
                                    onclick="window.location.href='{{route('show', ['id' => $date->date])}}'">
                            @else
                                <input type="button" value="{{ $date->date }}" class="list-group-item selectDate"
                                    onclick="window.location.href='{{route('show', ['id' => $date->date])}}'">
                            @endif
                        @endforeach
                    @endif
            </div>

            <div class="col-10 sidebar mb-3">
                @if($id != null)
                    <h3 style="margin: 20px 0px 20px 0px;">Log data in : {{$id}}</h3>
                @endif
                <table class="table table-striped">
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
                            
                            @if($user->stack != null)
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
