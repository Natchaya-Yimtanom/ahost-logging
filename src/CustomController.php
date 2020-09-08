<?php

namespace Quinn\Logging;

use App\Http\Controllers\Controller;
use Quinn\Logging\BaseLogger;
use Quinn\Logging\Logging;
use Illuminate\Http\Request;
use Exception;

class CustomController extends Controller
{
    /**
     * @var BaseLogger
     */
    private $baseLogger;
    private $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(BaseLogger $baseLogger)
    {
        $this->baseLogger = $baseLogger;
        $this->baseLogger->init();
    }

    public function test()
    {
        try{
            //success
            $this->baseLogger->info('INFO: Action log info tests');
            // $this->baseLogger->debug('DEBUG: Action log debug tests');
            // $this->baseLogger->error('ERROR: Action log error tests');
            // $this->baseLogger->emergency('EMERGENCY: Action log emergency tests');
            // $this->baseLogger->warning('WARNING: Action log warning tests');
            // $this->baseLogger->alert('ALERT: Action log alert tests');
            // $this->baseLogger->notice('NOTICE: Action log notice tests');
            // $this->baseLogger->critical('CRITICAL: Action log critical tests');

            //error
            // Logging::channel('sample')->error($message);
        } 
        catch (Exception $e) {
            $this->baseLogger->error($e);
        }
    }

    //show all data in log viewer
    public function view()
    {
        $month = date('F');
        $monthM = date('m');

        $tables = Logging::where('date', 'like','%-'.$monthM.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();

        $dateLists = Logging::distinct()
                        ->select('date')
                        ->where('date', 'like','%-'.$monthM.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();

        $date = '';
        return view()->file('..\vendor\quinn\logging\resources\views\LoggingViewer.blade.php', ['dateLists' => $dateLists , 'tables' => $tables, 'month' => $month , 'date' => $date]);
        // return view()->file('..\packages\resources\views\LoggingViewer.blade.php',['dateLists' => $dateLists , 'tables' => $tables , 'month' => $month, 'date' => $date]);
    }

    //show selected date data in log viewer
    public function show($date)
    {
        if (strpos($date, "-")) { 
            $startCharCount = strpos($date, "-") + strlen("-");
            $firstSubStr = substr($date, $startCharCount, strlen($date));
            $endCharCount = strpos($firstSubStr, "-");
            if ($endCharCount == 0) {
                $endCharCount = strlen($firstSubStr);
            }
            $month = substr($firstSubStr, 0, $endCharCount);
        }

        $tables = Logging::where('date', 'like', $date)
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();

        $dateLists = Logging::distinct()
                        ->select('date')
                        ->where('date', 'like','%-'.$month.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();
                
        $month = date("F", mktime(0, 0, 0, $month, 10));
        return view()->file('..\vendor\quinn\logging\resources\views\LoggingViewer.blade.php', ['dateLists' => $dateLists , 'tables' => $tables, 'month' => $month , 'date' => $date]);
        // return view()->file('..\packages\resources\views\LoggingViewer.blade.php',['dateLists' => $dateLists , 'tables' => $tables, 'month' => $month , 'date' => $date]);
    }

    //show selected month data in log viewer
    public function send( Request $request)
    {
        $month = $request->month;
        $level = $request->level;
       
        $tables = Logging::where('date', 'like','%-'.$month.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();
        

        $dateLists = Logging::distinct()
                        ->select('date')
                        ->where('date', 'like','%-'.$month.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();

        $month = date("F", mktime(0, 0, 0, $month, 10));
        $date = '';
        return view()->file('..\vendor\quinn\logging\resources\views\LoggingViewer.blade.php', ['dateLists' => $dateLists , 'tables' => $tables, 'month' => $month , 'date' => $date]);
        // return view()->file('..\packages\resources\views\LoggingViewer.blade.php', ['dateLists' => $dateLists , 'tables' => $tables, 'month' => $month, 'date' => $date]);
    }

    //show selected level data in log viewer
    public function level( $month,$level)
    {
        $monthM = date("m", strtotime($month));

        if($month[0] != "2"){
            if($level != 'all'){
                $tables = Logging::where('level_name', 'like', $level)
                        ->where('date', 'like','%-'.$monthM.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();
            } else{
                $tables = Logging::where('date', 'like','%-'.$monthM.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();
            }
            $date = '';
        } else{
            if($level != 'all'){
                $tables = Logging::where('level_name', 'like', $level)
                        ->where('date', 'like', $month)
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();
            } else{
                $tables = Logging::where('date', 'like','%-'.$monthM.'-%')
                        ->where('date', 'like', $month)
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();
            }
            $date = $month;
        }

        $dateLists = Logging::distinct()
                        ->select('date')
                        ->where('date', 'like','%-'.$monthM.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();

        $month = date("F", mktime(0, 0, 0, $monthM, 10));

        return view()->file('..\vendor\quinn\logging\resources\views\LoggingViewer.blade.php', ['dateLists' => $dateLists , 'tables' => $tables, 'month' => $month , 'date' => $date]);
        // return view()->file('..\packages\resources\views\LoggingViewer.blade.php', ['dateLists' => $dateLists , 'tables' => $tables, 'month' => $month , 'date' => $date]);
    }

}