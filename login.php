<?
// SETTINGS
// These are your DoggoCMS Settings that apply to the DoggoCMS backend. 
$password = 'Your password goes here'; // ALSO UPDATE DIS ON U index.php PAGE!!
$lockdown = false; // dis only if u got da cattos attackin u blebsite
$version = '1.0'; // change this for cache busting (mainly for egg)
// TODO; ADD SOME MORE OF DAT GORD COMMENTS


if (isset($_COOKIE['DoggoCMS-Login']) == $password) {
    //die('<!DOCTYPE html><html><head><title>hmmmmmmm...</title></head><body>u do be already logged in doe... cna u just lik go to <a href="index.php">dis page,</a> pls????</body></html>');
} 

if (isset($_POST["doggoID"])) {
    if ($lockdown == true) { http_response_code(429); die('DA CATTOS ARE INVADING!!!'); }
	else if ($_POST["doggoID"] == $password) {
		http_response_code(200);
		setcookie("DoggoCMS-Login", $_POST["doggoID"], time() + 86400);
		die("u a good boi");
	} else { http_response_code(500); die("u can do it!!"); } }

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../style.css?v=<? echo $version; ?>"/>
		<script>
        async function login() {
				document.getElementById('loginBtn').innerHTML = 'hol\' up, ya boi egg be hookin u up rn...';
				let formData = new FormData();
				formData.append("doggoID", document.getElementById('login').value);
				let response = await fetch('#', {
					method: "POST",
					body: formData
				})
				if (response.status == 429) { // no login
					document.getElementById('loginBtn').innerHTML = 'no';
					document.getElementById('loginForm').style.display = "none";
					document.getElementById('main').style.paddingBottom = "5px";
				}
				else if (response.status < 200 || response.status > 300) { // bad password
				    if (totalTries == 0) { document.getElementById('loginBtn').innerHTML = 'bwro how could u do dis to me. u liberally got da password wrong buh'; totalTries++; }
				    else if (totalTries == 1) { document.getElementById('loginBtn').innerHTML = 'buh could u lik STOP doin dis/???? tanks'; totalTries++; }
				    else if (totalTries == 2) { document.getElementById('loginBtn').innerHTML = 'buh me liberally gonna ban u fwrom u own blebsite lik buh'; totalTries++; }
				    else if (totalTries == 3) { document.getElementById('loginBtn').innerHTML = 'ok buh i see wat u tryna do'; document.getElementById('loginForm').style.display = "none"; document.getElementById('main').style.paddingBottom = "5px"; }}
				else { // u got it wight!11!!!!
					document.getElementById('loginBtn').innerHTML = 'u welcome';
					location.reload();
					window.location.replace('index.php');
				}
			}
			
			// ya boi egg do be makin ur life bebber by adding these SUPER USEFUL features
			document.onkeyup = enter; // on enter click, make u login
			function enter(e) { if (e.which == 13) login(); }
			totalTries = 0;
		</script>
    </head>
    <body>
    <noscript><div class="card"> <p><strong>ya boi missin dat JAVASCRIPT doe... u no longer allowed... </strong></p> </div></noscript> <!-- i do gotta take care of dem pups dat dont got dat juicy JS enabled doe... -->
    
		<div id="main" class="card" style="width: 80%; padding-bottom: 25px; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
			<h2 class="button" id="loginBtn">login to become a happ boi</h2>
			<div id="loginForm">
				<input id="login" type="password" name="password" value="" placeholder="doggo password go here">
				<a id="submitLogin" class="button" onclick="login()">click me to start vibin</a>
			</div>
		</div>
	</body>
</html>
