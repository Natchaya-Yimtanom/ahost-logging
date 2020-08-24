<?php

namespace Quinn\Logging;

use App\Http\Controllers\Controller;
use Quinn\Logging\BaseLogger;
use Quinn\Logging\Logging;
use Exception;
use DB;

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
            // $this->baseLogger->info('INFO: Action log info tests');
            // $this->baseLogger->debug('DEBUG: Action log debug tests');
            // $this->baseLogger->error('ERROR: Action log error tests');
            // $this->baseLogger->emergency('EMERGENCY: Action log emergency tests');
            // $this->baseLogger->warning('WARNING: Action log warning tests');
            // $this->baseLogger->alert('ALERT: Action log alert tests');
            // $this->baseLogger->notice('NOTICE: Action log notice tests');
            // $this->baseLogger->critical('CRITICAL: Action log critical tests');

            //error
            Logging::channel('sample')->error($message);
        } 
        catch (Exception $e) {
            $this->baseLogger->error($e);
        }
    }

    // public function view()
    // {
    //     $users = DB::select('select * from logging order by date desc,time desc');
    //     $dates = DB::select('select distinct date from logging order by date desc');
    //     return view()->file('..\packages\resources\views\LoggingViewer.blade.php',['users'=>$users],['dates'=>$dates]);
    // }

    public function view()
    {
        $users = DB::select('select * from logging order by date desc,time desc');
        $dates = DB::select('select distinct date from logging order by date desc');
        return view()->file('..\packages\resources\views\LoggingViewer.blade.php',['users'=>$users],['dates'=>$dates]);
    }
}