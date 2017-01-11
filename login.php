
<?php
require("Connection.php");

$LoginType=$_REQUEST['LoginType'];
$UN=$_REQUEST['UN'];
$PW=$_REQUEST['PW'];


session_start();
if($LoginType=='Customer')
{
	$_SESSION['CFN']='';
}
else if($LoginType=='User')
{
	$_SESSION['UFN']='';
}
else if($LoginType=='TollShop')
{
	$_SESSION['TSFN']='';
}


//	u	users					User_Id, Full_Name, Address, User_Type, Contact_No, E_Mail, User_Name, User_Password
//	c	customer				Customer_Id, Full_Name, Address, DOB, Mobile_No, E_Mail, User_Name, Customer_Password, 
//								Question, Answer, ImageName, Account_No, Balance
//	ts	toll_shop				TollShop_Id, Shop_Name, Owner_Name, Shop_Address, User_Name, User_Password, Contact_No, E_Mail

$Flag=0;

if($LoginType=='Customer')
	$sql = "select * from customer where User_Name='$UN' and Customer_Password='$PW'";
else if($LoginType=='User')
	$sql = "select * from users where User_Name='$UN' and User_Password='$PW'";
else if($LoginType=='TollShop')
	$sql = "select * from toll_shop where User_Name='$UN' and User_Password='$PW'";
	
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result))
{
	if($LoginType=='Customer')
	{
		$Flag = "Customer.php";
		$_SESSION['CId']=$row['Customer_Id'];
		$_SESSION['CFN']=$row['Full_Name'];
		$_SESSION['CAdd']=$row['Address'];
		$_SESSION['CD']=$row['BDate'];
		$_SESSION['CM']=$row['BMonth'];
		$_SESSION['CY']=$row['BYear'];
		$_SESSION['CMN']=$row['Mobile_No'];
		$_SESSION['CEM']=$row['E_Mail'];
		$_SESSION['CUN']=$row['User_Name'];
		$_SESSION['CPW']=$row['Customer_Password'];
		$_SESSION['CQst']=$row['Question'];
		$_SESSION['CAns']=$row['Answer'];
	}
	else if($LoginType=='User')
	{
		$_SESSION['UId']=$row['User_Id'];
		$_SESSION['UFN']=$row['Full_Name'];
		$_SESSION['UAdd']=$row['Address'];
		$_SESSION['UT']=$row['User_Type'];
		$_SESSION['UCN']=$row['Contact_No'];
		$_SESSION['UEM']=$row['E_Mail'];
		$_SESSION['UN']=$row['User_Name'];
		$_SESSION['UP']=$row['User_Password'];
		$Flag = "Admin.php";
	}
	else if($LoginType=='TollShop')
	{
		$_SESSION['TSId']=$row['TollShop_Id'];
		$_SESSION['TSFN']=$row['Owner_Name'];
		$_SESSION['TSSN']=$row['Shop_Name'];
		$_SESSION['TSSA']=$row['Shop_Address'];
		$_SESSION['TSUN']=$row['User_Name'];
		$_SESSION['TSUP']=$row['User_Password'];
		$_SESSION['TSCN']=$row['Contact_No'];
		$_SESSION['TSEM']=$row['E_Mail'];
		$Flag = "TollShop.php";
	}
}

echo $Flag;
?>
