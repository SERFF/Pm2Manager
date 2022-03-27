<?php

namespace SERFF\Pm2Manager\Helpers;

class OutputHelper
{
    public static function parse($output): array
    {
        $lines = array_filter(explode(PHP_EOL, $output), function ($line) {
            if (trim($line) === '') {
                return false;
            }

            if (preg_match("/[a-z]/i", $line)) {
                return true;
            }

            return false;
        });

        if (count($lines) === 1) {
            return [];
        }
        unset($lines[1]);
        $lines = array_values($lines);

        return array_map(function ($line) {
            return OutputHelper::parseLine($line);
        }, $lines);
    }

    public static function parseLine(string $line): array
    {
        $items = array_values(array_filter(array_map(function ($item) {
            return trim($item);
        }, explode('│', $line)), function ($item) {
            return $item !== '';
        }));

        return [
            'id' => (int) $items[0],
            'name' => $items[1],
            'namespace' => $items[2],
            'version' => $items[3],
            'mode' => $items[4],
            'pid' => (int) $items[5],
            'uptime' => $items[6],
            'restarts' => (int) $items[7],
            'status' => $items[8],
            'cpu' => $items[9],
            'mem' => $items[10],
            'user' => $items[11],
            'watching' => $items[12],
        ];
    }
}
