<?php
if (file_exists('/etc/dstar-radio.mmdvmhost')) {
  $logfile = "/var/log/pi-star/MMDVM-".gmdate('Y-m-d').".log";
}
elseif (file_exists('/etc/dstar-radio.dstarrepeater')) {
  $logfile = "/var/log/pi-star/DStarRepeater-".gmdate('Y-m-d').".log";
}

$unixfile = file_get_contents($logfile);
$dosfile = str_replace("\n", "\r\n", $unixfile);

header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false);
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="Pi-Star_'.basename($logfile).'";');
header('Content-Length: '.filesize($logfile));
header('Accept-Ranges: bytes');

//readfile($logfile);

set_time_limit(0);
$file = @fopen($logfile,"rb");
while(!feof($file)) {
  //print(str_replace("\n", "\r\n", @fread($file, 1024*8)));
	print(@fread($file, 1024*8));
	ob_flush();
	flush();
}

exit;
?>
