<?php
// (A) COMMAND LINE ONLY!
if (isset($_SERVER["REMOTE_ADDR"]) || isset($_SERVER["HTTP_USER_AGENT"]) || !isset($_SERVER["argv"])) {
  exit("Please run this script from command line");
}

// (B) SETTINGS
$cycle = 60; // WAIT 10 SECS BETWEEN CYCLES

// (C) RUN
while (true) {
  echo "It works!" . PHP_EOL;
  sleep($cycle);
}

?>