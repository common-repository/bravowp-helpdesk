<?php

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

//Quick adding log info
//Example: "INFO", "TICKET UPDATE PROPERTY", "...data..."
function bwhd_systemlog_addentry( $type, $event, $message )
{

        //reading enabled log setting
        //$option_loglevel = get_option( "bwhd_log_enable", "yes_debugno" );
        $option_loglevel = get_option( "bwhd_log_enable", "no" );
        if ( $option_loglevel == "yes_errors" || $option_loglevel == "yes_debug" )
        {

                if (
                ( $type == "QUERY" && ( $option_loglevel=='yes_debug' ) )
                ||
                ( $type == "FUNCTION" && ( $option_loglevel=='yes_debug' ) )
                ||
                ( $type == "ERROR" && ( $option_loglevel=='yes_debug' || $option_loglevel=='yes_errors' ) )
                ||
                ( $type == "WARNING" && ( $option_loglevel=='yes_debug' ) )
                ||
                ( $type == "INFO" && ( $option_loglevel=='yes_debug' ) )
                ||
                ( $type == "DEBUG" && ( $option_loglevel=='yes_debug' ) )
                )
                {

                        // Logging class initialization
                        $log = new bwhd_systemlog_helper();

                        //checks if the file is writable/readable
                        if ( $log->CheckFileReadableWritable() == false )
                        {
                                return false;
                        }

                        // write message to the log file
                        $log->lwrite( $type, $event, $message);

                        // close log file
                        $log->lclose();

                }

        }

}

//Reads the log file row by row and returns an array of objects
function bwhd_systemlog_readlogfile( )
{

        $log = new bwhd_systemlog_helper();
        $result = array();

        $log_file_default = bwhd_globals()->plugin_url . '/utils/log/log.txt';

        if( file_exists( $log_file_default ) )
        {
                $fileContent = file_get_contents( $log_file_default );
        }

        $arrayLines = (file( $log_file_default , FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));

        //reversing the array and building an object array instead
        foreach ( array_reverse( $arrayLines ) as $line ) {

                $lineDataArray =  explode("*/*/*", $line);

                $newLogInfo = new stdClass();

                $newLogInfo->Date = $lineDataArray[0];
                $newLogInfo->Type = $lineDataArray[1];
                $newLogInfo->Method = $lineDataArray[2];
                $newLogInfo->EventText = $lineDataArray[3];

                if ( $newLogInfo->Type=="QUERY" )
                {
                        $newLogInfo->EventText = str_replace("\r", " ", $newLogInfo->EventText);
                }
                if ( $newLogInfo->Type=="FUNCTION" )
                {
                        $newLogInfo->TextColor="black";
                }
                if ( $newLogInfo->Type=="DEBUG" || $newLogInfo->Type=="QUERY" )
                {
                        $newLogInfo->TextColor="black";
                }
                if ( $newLogInfo->Type=="INFO" )
                {
                        $newLogInfo->TextColor="black";
                }
                if ( $newLogInfo->Type=="WARNING")
                {
                        $newLogInfo->TextColor="orange";
                }
                if ( $newLogInfo->Type=="ERROR")
                {
                        $newLogInfo->TextColor="red";
                }

                array_push( $result, $newLogInfo );

        }

        return $result;

}


class bwhd_systemlog_helper {

        // declare log file and file pointer as private properties
        private $log_file, $fp;

        //checks if the file is readable and writeable and returns true just in case
        public function CheckFileReadableWritable()
        {

                $log_file_default = bwhd_globals()->plugin_url . '/utils/log/log.txt';

                $result = false;

                if ( is_readable( $log_file_default ) )
                {

                        if ( is_writeable( $log_file_default ) )
                        {
                                $result = true;
                        }

                }

                return $result;

        }

        // set log file (path and name)
        public function lfile($path) 
        {
                $this->log_file = $path;
        }

        // write message to the log file
        public function lwrite($type, $event, $message) {

                // if file pointer doesn't exist, then open log file
                if (!is_resource($this->fp)) 
                {
                        $this->lopen();
                }

                // define current time and suppress E_WARNING if using the system TZ settings
                // (don't forget to set the INI setting date.timezone)
                $time = @date('[d/M/Y:H:i:s]');

                // write current time, script name and message to the log file
                fwrite($this->fp, "$time*/*/*$type*/*/*$event*/*/*$message" . PHP_EOL);
        }

        // close log file (it's always a good idea to close a file when you're done with it)
        public function lclose() {
                fclose($this->fp);
        }

        // open log file (private method)
        private function lopen() {

                $log_file_default = bwhd_globals()->plugin_url . '/utils/log/log.txt';

                // define log file from lfile method or use previously set default
                $lfile = $this->log_file ? $this->log_file : $log_file_default;

                // open log file for writing only and place file pointer at the end of the file
                // (if the file does not exist, try to create it)
                $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");

        }

}

//clears the log file
function bwhd_systemlog_clearlogfile( )
{

        $log = new bwhd_systemlog_helper();
        $result = array();

        $log_file_default = bwhd_globals()->plugin_url . '/utils/log/log.txt';

        if( file_exists( $log_file_default ) )
        {
                file_put_contents($log_file_default, "");
        }

}

?>
