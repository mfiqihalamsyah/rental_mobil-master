<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	     : koneksi.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
$user = 'root';
$pass = '';

$koneksi = new PDO("mysql:host=localhost;dbname=rental_mobil", $user, $pass);
$con = mysqli_connect("localhost", "root", "", "rental_mobil");

global $url;
$url = "http://localhost/rental_mobil-master/";

$sql_web = "SELECT * FROM infoweb WHERE id = 1";
$row_web = $koneksi->prepare($sql_web);
$row_web->execute();
global $info_web;
$info_web = $row_web->fetch(PDO::FETCH_OBJ);

error_reporting(0);
