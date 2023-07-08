<?php 
$con=mysqli_connect("localhost","root","");
$query="CREATE DATABASE IF NOT EXISTS kmc";
mysqli_query($con,$query);
mysqli_select_db($con,"kmc");
$query="CREATE TABLE IF NOT EXISTS Admin
(
	AdID int primary key auto_increment,
	adFirstName varchar(100),
  adLastName varchar(100),
	adImage varchar(255),
	Email varchar(100),
	Password varchar(50)
);";
$result=mysqli_query($con,$query);
if ($result) 
{
	$q=mysqli_query($con, "insert into admin (adFirstName, adLastName, adImage, Email, Password) values ('Ko Aung', 'Thura', 'profile.png', 'admin@gmail.com', 123456)");
	echo "Admin TABLE Create Success <br>";
}

$query="CREATE TABLE IF NOT EXISTS Customer
(
	cusID int primary key auto_increment,
	cusFirstName varchar(50),
  cusLastName varchar(50),
	cusImage varchar(255),
	cusEmail varchar(50),
	cusPassword varchar(50),
	cusPhone varchar(50),
  cusAddress varchar(50), 
	cusJoinDate date
	
);";
$result=mysqli_query($con,$query);
if ($result) 
{
	echo "Customer TABLE Create Success <br>";
}

$query="CREATE TABLE IF NOT EXISTS Feedback
(
	fbID int primary key auto_increment,
	fbMessage text,
  cusID int,
	Foreign Key (cusID) References Customer(cusID) on delete cascade
);";
$result=mysqli_query($con,$query);
if ($result) 
{
	echo "Feedback TABLE Create Success <br>";
	
}

$query="CREATE TABLE IF NOT EXISTS ServiceCategory
(
	scID int Primary Key auto_increment,
	scName varchar(30)
);";
$result=mysqli_query($con,$query);
if ($result) {
	echo "ServiceCategory TABLE CREATE Success <br>";
}

$query="CREATE TABLE IF NOT EXISTS CleaningService
(
	csID int Primary Key auto_increment,
	csName varchar(100),
	csInfo text,
	scID int,
  price int,
	Foreign Key(scID) References ServiceCategory(scID) on delete cascade
);";
$result=mysqli_query($con,$query);
if ($result) {
	echo "CleaningService TABLE CREATE Success <br>";
}

$query="CREATE TABLE IF NOT EXISTS TransportationService
(
	tpID int Primary Key auto_increment,
	tpName varchar(100),
	tpDescription text,
	tpPrice int,
	scID int,
	Foreign Key(scID) References ServiceCategory(scID) on delete cascade
);";
$result=mysqli_query($con,$query);
if ($result) {
	echo "TransportationService TABLE CREATE Success <br>";
}

$query="CREATE TABLE IF NOT EXISTS Booking
(
	bookingID int Primary Key auto_increment,
	bookingDate date,
	bookingAddress varchar(200),
  bookingStatus varchar(100),
	cusID int,
	Foreign Key(cusID) References Customer(cusID) on delete cascade
);";
$result=mysqli_query($con,$query);
if ($result) {
	echo "Booking TABLE CREATE Success <br>";
}

$query="CREATE TABLE IF NOT EXISTS BookingService
(
	bsID int primary key auto_increment,
	tpID int,
  csID int,
  bookingID int,
	Foreign key (tpID) references TransportationService(tpID) on delete cascade,
  Foreign key (csID) references CleaningService(csID) on delete cascade,
  Foreign key (bookingID) references
  Booking (bookingID) on delete cascade
);";
$result=mysqli_query($con,$query);
if ($result) 
{
	echo "BookingService TABLE Create Success <br>";
	
}

$query="CREATE TABLE IF NOT EXISTS Assign
(
	assignID int primary key auto_increment,
	scID int,
	adID int,
	Foreign key (scID) references ServiceCategory(scID) on delete cascade,
  Foreign key (adID) references Admin(adID) on delete cascade
);";
$result=mysqli_query($con,$query);
if ($result) 
{
	echo "Assign TABLE Create Success <br>";
	
}
 echo mysqli_error($con);
 ?>