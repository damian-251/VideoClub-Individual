<?php 

namespace Dwes\VideoClubIndividual\Util;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LogFactory {
    public static function getLogger(string $nombre = "VideoClub") {
        $log = new Logger($nombre);
        $log->pushHandler(new StreamHandler("logs/videoclub.log", Logger::DEBUG));
        return $log;
    }
}