<?php
/**
 * Created by Mustafeez Ali (mtfz@msn.com).
 * Date: 5/3/2017
 * Time: 11:23 PM
 */

$baseProto = isset( $_SERVER['HTTPS'] ) ? "https://" : "http://";
$baseHost  = $_SERVER['HTTP_HOST'];
$baseURI   = $_SERVER['REQUEST_URI'];
$baseLoc   = $baseProto . $baseHost;

session_start();
session_destroy();

header('Location: '.$baseLoc.'/jobs/login.php');