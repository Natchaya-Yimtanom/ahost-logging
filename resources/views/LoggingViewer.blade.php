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
            padding-bottom: 20px;
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

    </style>
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col sidebar mb-3 color1">
                <h1 style="margin-bottom: 20px; margin-top: 10px; text-align: center;">
                    <a href="{{route('view') }}">Log Viewer</a>
                </h1>
                    <!-- @foreach ($dates as $date)
                    <div class="list-group-item">
                        <a href="{{route('show', ['id' => $date->date])}}">{{ $date->date }}</a>
                    </div>
                    @endforeach -->

                    <!-- <div id="selectDate" style="margin-bottom: 10px; width: 100%">
                        <select id="year" class="dateSelect" style="width: 30%;"></select>
                        <select id="month" class="dateSelect" style="width: 68%;" ></select>
                    </div> -->
                    
                    <!-- <select id="month"></select> -->
                    <form action="send" method="post">
                        <select id="comboA"  name="select" style="width: 68%; height: 30px;">
                            <option value="">Select combo</option>
                            <option value="01">JAN</option>
                            <option value="02">FEB</option>
                            <option value="03">MAR</option>
                            <option value="04">APR</option>
                            <option value="05">MAY</option>
                            <option value="06">JUN</option>
                            <option value="07">JUL</option>
                            <option value="08">AUG</option>
                            <option value="09">SEP</option>
                            <option value="10">OCT</option>
                            <option value="11">NOV</option>
                            <option value="12">DEC</option>
                        </select>
                        <input type="submit" class="selectBtn" id="btn" value="Submit" style="width:30%; height: 30px;">
                    </form>

                    @foreach ($dates as $date)
                    <div class="list-group-item">
                        <a href="{{route('show', ['id' => $date->date])}}">{{ $date->date }}</a>
                    </div>
                    @endforeach
            </div>

            <div class="col-10 sidebar mb-3 ">
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
                </table>
            </div>
        </div>
    </div>

</body>

</html>

<!-- <script>
$(document).ready(function() {
const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
  var qntYears = 4;
  var selectYear = $("#year");
  var selectMonth = $("#month");
  var currentYear = new Date().getFullYear();
  
  for (var y = 0; y < qntYears; y++){
    let date = new Date(currentYear);
    var yearElem = document.createElement("option");
    yearElem.value = currentYear 
    yearElem.textContent = currentYear;
    selectYear.append(yearElem);
    currentYear--;
  } 

  for (var m = 0; m < 12; m++){
      let monthNum = new Date(2018, m).getMonth()
      let month = monthNames[monthNum];
      var monthElem = document.createElement("option");
      monthElem.value = monthNum; 
      monthElem.textContent = month;
      selectMonth.append(monthElem);
    }

    var d = new Date();
    var month = d.getMonth();
    var year = d.getFullYear();

    selectYear.val(year); 
    selectMonth.val(month);    
});
</script> -->