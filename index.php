<?php
// не показываем ошибки
error_reporting(0);

require_once('inc/google.php');
require_once('inc/yandex.php');
require_once('inc/whois.php');
require_once('inc/ip.php');
require_once('inc/passwd.php');
require_once('inc/code.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/colorpicker.js"></script>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/colorpicker.css">
	<link rel="shortcut icon" href="favicon.ico">

	<title>Web tools</title>
</head>

<body>
	<!--PR & CY-->
	PR &amp; CY:<br>
	<form method="post">
		<input type="text" name="url" class="input" maxlength="50">
		<input type="submit" name="pr-cy" value="Go">
	</form>
	<?php
	if(!empty($str = $_POST['url'])) echo '<pre>CY: '.htmlspecialchars(get_cy($str)).' PR: '.htmlspecialchars(getpr($str)).'</pre>';
	?>
	<!--/PR & CY-->

	<!--Whois Domain-->
	Whois Domain:<br>
	<form method="post">
		<input type="text" class="input" id="domain" name="domain" />
		<input type="submit" value="Go">
	</form>
		<?php if(!empty($_POST['domain'])) echo '<pre>'.htmlspecialchars(show_whois($_POST['domain'])).'</pre>'; ?>
	<!--/Whois Domain-->

	<!--/Whois Ip-->
	Whois IP:<br>
	<form method="post">
		<input type="text" name="ip" class="input" value="<?php echo htmlspecialchars($_REQUEST['ip']); ?>" maxlength="15">
		<input type="submit" value="Go">
	</form>
	<?php if(!empty($_POST['ip'])) echo '<pre>'.htmlspecialchars(whois("whois.ripe.net", $_POST['ip'])).'</pre>'; ?>
	<!--/Whois Ip-->

	<!--Password Generator-->
	Password Generator:<br>
	<form method="post">
		<input type="text" name="number" class="input" value="10" maxlength="2">
		<input type="submit" value="Go">
	</form>
	<?php if(!empty($_POST['number'])) echo '<pre>'.htmlspecialchars(generate_password(intval($_POST['number']))).'</pre>'; ?>
	<!--/Password Generator-->

	<!--Color Picker-->
	<script>
		$(document).ready(function() {
			$('#picker').farbtastic('#color');
		});
	</script>
	Color Picker:<br>
	<form>
		<input type="text" id="color" name="color" class="input" value="#000000">
	</form>
	<div id="picker"></div>
	<!--/Color Picker-->

	<!--En/De Coder-->
	En/De Coder:<br>
	<form method="post">
		<select name="cryptmethod" class="input">
			<option value="md5">Md5 Crypt</option>
			<option value="gost">Gost Crypt</option>
			<option value="sha1">Sha1 Crypt</option>
			<option value="b64enc">Base 64 Encode</option>
			<option value="b64dec">Base 64 Decode</option>
			<option value="asc2bin">ASCII to Binary</option>
			<option value="bin2asc">Binary to ASCII</option>
			<option value="asc2hex">ASCII to Hex</option>
			<option value="hex2asc">Hex to ASCII</option>
			<option value="bin2hex">Binary to Hex</option>
			<option value="hex2bin">Hex to Binary</option>
		</select>
		<br>
		<textarea name="code" class="input" maxlength="600"></textarea>
		<input type="submit" name="coder" value="Go">
	</form>
	<?php if(!empty($_POST['coder'])) echo '<pre>'.$code.'</pre>'; ?>
	<!--/En/De Coder-->

	Your Ip: <span style="color: #63b8fb;"><?php echo $_SERVER["REMOTE_ADDR"]; ?></span><br>
	Host Name: <span style="color: #63b8fb;"><?php echo gethostbyaddr($_SERVER['REMOTE_ADDR']); ?></span><br>
	User agent: <span style="color: #63b8fb;"><?php echo $_SERVER['HTTP_USER_AGENT'] ?></span><br>
	Accept: <span style="color: #63b8fb;"><?php echo $_SERVER[HTTP_ACCEPT]; ?></span><br>
	Accept-Encoding: <span style="color: #63b8fb;"><?php echo $_SERVER[HTTP_ACCEPT_ENCODING]; ?></span><br>
	Accept-Language: <span style="color: #63b8fb;"><?php echo $_SERVER[HTTP_ACCEPT_LANGUAGE]; ?></span>
</body>
</html>
