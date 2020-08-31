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
        $select = date('F');
        $selectM = date('m');

        $users = Logging::where('date', 'like','%-'.$selectM.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();

        $dates = Logging::distinct()
                        ->select('date')
                        ->where('date', 'like','%-'.$selectM.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();
        return view()->file('..\vendor\quinn\logging\resources\views\LoggingViewer.blade.php',['dates' => $dates , 'users' => $users, 'select' => $select]);
        // return view()->file('..\packages\resources\views\LoggingViewer.blade.php',['dates' => $dates , 'users' => $users , 'select' => $select]);
    }

    //show selected date data in log viewer
    public function show($id)
    {
        if (strpos($id, "-")) { 
            $startCharCount = strpos($id, "-") + strlen("-");
            $firstSubStr = substr($id, $startCharCount, strlen($id));
            $endCharCount = strpos($firstSubStr, "-");
            if ($endCharCount == 0) {
                $endCharCount = strlen($firstSubStr);
            }
            $select = substr($firstSubStr, 0, $endCharCount);
        }

        $users = Logging::where('date', 'like', $id)
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();

        $dates = Logging::distinct()
                        ->select('date')
                        ->where('date', 'like','%-'.$select.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();
                
        $select = date("F", mktime(0, 0, 0, $select, 10));
        return view()->file('..\vendor\quinn\logging\resources\views\LoggingViewer.blade.php',['dates' => $dates , 'users' => $users, 'select' => $select]);
        // return view()->file('..\packages\resources\views\LoggingViewer.blade.php',['dates' => $dates , 'users' => $users, 'select' => $select]);
    }

    //show selected month data in log viewer
    public function send( Request $request)
    {
        $select = $request->select;

        $users = Logging::where('date', 'like','%-'.$select.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();

        $dates = Logging::distinct()
                        ->select('date')
                        ->where('date', 'like','%-'.$select.'-%')
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();

        $select = date("F", mktime(0, 0, 0, $select, 10));

        return view()->file('..\vendor\quinn\logging\resources\views\LoggingViewer.blade.php',['dates' => $dates , 'users' => $users, 'select' => $select]);
        // return view()->file('..\packages\resources\views\LoggingViewer.blade.php',['select' => $select , 'dates' => $dates , 'users' => $users]);
    }

}