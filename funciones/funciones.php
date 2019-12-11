<?php
function format_data($time){
	$mescat=array(" ","Gen","Feb","Mar","Abr","Mai","Jun","Jul","Ago","Sep","Oct","Nov","Dec");
	$dia=date("d",$time);
	$mes=$mescat[date ("n",$time)];
	$any=date ("Y",$time);
	$data=$dia.'/'.$mes.'/'.$any;
	return $data;
}