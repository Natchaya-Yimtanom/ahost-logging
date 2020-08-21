<?php

namespace Quinn\Logging;

use DB;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class LoggingHandler extends AbstractProcessingHandler{
/**
 *
 * Reference:
 * https://github.com/markhilton/monolog-mysql/blob/master/src/Logger/Monolog/Handler/MysqlHandler.php
 */
    public function __construct($level = Logger::DEBUG, $bubble = true) {
        
        $this->table = 'logging';
        parent::__construct($level, $bubble);
    }

    protected function write(array $record):void
    {
        //set log format and store log in database
        $formatStr = substr($record['formatted'],strpos($record['formatted'], "]") + 2);
        $date = substr($record['datetime'],0,10);
        $time = substr($record['datetime'],11,8);

        $data = array(
           'user'          => get_current_user(),
           'message'       => $record['message'],
           'context'       => json_encode($record['context']),
           'level'         => $record['level'],
           'level_name'    => $record['level_name'],
           'channel'       => $record['channel'],
        //    'record_datetime' => $record['datetime']->format('Y-m-d H:i:s'),
            'date'         => $date,
            'time'         => $time,
           'extra'         => json_encode($record['extra']),
           'formatted'     => $formatStr,
           'remote_addr'   => $_SERVER['REMOTE_ADDR'],
           'user_agent'    => $_SERVER['HTTP_USER_AGENT'],
       );

       DB::connection()->table($this->table)->insert($data);
        
    }

}