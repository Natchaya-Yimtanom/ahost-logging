<?php

namespace Quinn\Logging;

use App\Http\Controllers\Controller;
use Quinn\Logging\BaseLogger;
use Quinn\Logging\Logging;
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
        $users = Logging::orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();

        $dates = Logging::distinct()
                ->select('date')
                ->distinct()
                ->orderBy('date', 'desc')
                ->orderBy('time', 'desc')
                ->get();
        // return view()->file('..\packages\resources\views\LoggingViewer.blade.php',compact('users'),compact('dates'));
        return view()->file('..\vendor\quinn\logging\resources\views\LoggingViewer.blade.php',compact('users'),compact('dates'));
    }

    //show selected date data in log viewer
    public function show($id)
    {
        $users = Logging::where('date', 'like', $id)
                        ->orderBy('date', 'desc')
                        ->orderBy('time', 'desc')
                        ->get();

        $dates = Logging::distinct()
                ->select('date')
                ->distinct()
                ->orderBy('date', 'desc')
                ->orderBy('time', 'desc')
                ->get();
        // return view()->file('..\packages\resources\views\LoggingViewer.blade.php',compact('users'),compact('dates'));
        return view()->file('..\vendor\quinn\logging\resources\views\LoggingViewer.blade.php',compact('users'),compact('dates'));
    }
}