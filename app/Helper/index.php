<?php

# get all files in directory and include

foreach (glob(__DIR__ . '/*.php') as $filename) {
    if ($filename !== __FILE__) {
        include_once $filename;
    }
}
