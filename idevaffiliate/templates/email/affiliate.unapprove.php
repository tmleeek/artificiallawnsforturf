<?PHP

// FILE INCLUDE VALIDATION
if (!$EmailAuth) { exit(); }
// -------------------------------------------------------------------------------------------------

if ($ctype == 1) {
$ctype = "Standard";
} elseif ($ctype == 2) {
$ctype = "Tier";
} else {
$ctype = "N/A"; }

$camt = number_format($camt,$decimal_symbols);
if($cur_sym_location == 1) { $camt = $cur_sym . $camt; }
if($cur_sym_location == 2) { $camt = $camt . " " . $cur_sym; }
$camt = $camt . " " . $currency;

$adata=mysql_query("select username, password, f_name, l_name, email, email_override from idevaff_affiliates where id = '$sendid'");
$indv_data=mysql_fetch_array($adata);
$name=$indv_data['username'];
$pass=$indv_data['password'];
$fname=$indv_data['f_name'];
$lname=$indv_data['l_name'];
$e=$indv_data['email'];
$email_override=$indv_data['email_override'];
if ($email_override) { $email_table_extension = $email_override; }
// ------------------------------------------------
$edata=mysql_query("select aff_unapprove_sub, aff_unapprove_body from idevaff_email_$email_table_extension");
$indv_data=mysql_fetch_array($edata);
$sub=$indv_data['aff_unapprove_sub'];
$sub=preg_replace("/Sitename/",$sitename,$sub);
$con=$indv_data['aff_unapprove_body'];
$con=preg_replace("/Sitename/",$sitename,$con);
// ------------------------------------------------

$con = preg_replace("/_id_/", $sendid, $con);
$con = preg_replace("/_username_/", "$name", $con);
$con = preg_replace("/_password_/", "N/A - If you need to reset your password please do so on the login page.", $con);
$con = preg_replace("/_firstname_/", "$fname", $con);
$con = preg_replace("/_lastname_/", "$lname", $con);
$con = preg_replace("/_email_/", "$e", $con);
$con = preg_replace("/_webhome_/", "$siteurl", $con);
$con = preg_replace("/_affhome_/", "$base_url/index.php", $con);
$con = preg_replace("/_loginpage_/", "$base_url/login.php", $con);
if ($link_style == 1) {
$con = preg_replace("/_afflink_/", "$base_url/$filename.php?id=$sendid", $con);
} elseif ($link_style == 2) {
$con = preg_replace("/_afflink_/", "$siteurl{$sendid}.html", $con); }

include_once($path . "/templates/email/class.phpmailer.php");
include_once($path . "/templates/email/class.smtp.php");
$mail = new PHPMailer();

if ($email_smtp_delivery == true) {
$mail->IsSMTP();
$mail->SMTPAuth = $smtp_auth;
$mail->SMTPSecure = "$smtp_security";
$mail->Host = "$smtp_host";
$mail->Port = $smtp_port;
$mail->Username = "$smtp_user";
$mail->Password = "$smtp_pass";

// ----------------------------------------------------------
// CHECK FOR EMAIL ATTACHMENT
// ----------------------------------------------------------
$get_attachment = mysql_query("select template_id, filename from idevaff_email_attachments where template_id = '10' and enabled = '1'");
if (mysql_num_rows($get_attachment)) {
$attachment_data = mysql_fetch_array($get_attachment);
$attachment_filename = $attachment_data['filename'];
if (file_exists($path . "/docs/" . $attachment_filename)) {
$mail->AddAttachment($path . "/docs/" . $attachment_filename, $attachment_filename); } }
// ----------------------------------------------------------

}
$mail->CharSet = "$smtp_char_set";

if ($email_html_delivery == true) {
$mail->isHTML(true);
$content = nl2br($con) . "<br /><br />Commission Type: " . $ctype . "<br />Commission Amount: " . $camt . "<br />Original Commission Date: " . $date . "<br /><br />" . nl2br($signature);
} else {
$mail->isHTML(false);
$content = $con . "\n\nCommission Type: " . $ctype . "\nCommission Amount: " . $camt . "\nOriginal Commission Date: " . $date . "\n\n" . $signature;
}

$mail->Subject = "$sub";
$mail->From = "$address";
$mail->FromName = "$from_name";
$mail->AddAddress("$e","$name");
$mail->Body = $content;

$mail->Send();
$mail->ClearAddresses();

?>