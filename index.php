<?
$password = 'PASSWORD GOES HERE';
$version = '1.0'; // change this for cache busting (mainly for egg)
if (!isset($_COOKIE['DoggoCMS-Login']) || $_COOKIE['DoggoCMS-Login'] != $password) {
	require('login.php');
	die();
}

if (isset($_GET['logout'])) { setcookie("login", "", time() - 3600); header("Location: login.php"); }

if (isset($_POST['postData']) && isset($_POST['postTitle'])) {
    $lines = implode(file("../blog.html")); // WRITE DATA TO THE ARCHIVES FIRST!!
    $content = explode('<h3>', $lines);
    echo $data = $content[0] . '<h3>' . $_POST['postTitle'] . ' (' . date('n/j/Y', time()) . ')</h3>' . '<p>' . $_POST['postData'] . "</p><br>\n";
    unset($content[0]);
    foreach($content as $item) {
        $data = $data . '<h3>' . $item;
    }
    if(!file_put_contents('../blog.html', $data)) { http_response_code(501); exit; }
    die('aight i fibished');
}

else if (isset($_FILES["doggofile"]) && isset($_POST["doggoname"])) {
	if(!empty($_FILES["doggofile"]["name"])) {
		$tmp = explode('.', $_FILES["doggofile"]["name"]);
		$extension = end($tmp);

		if (move_uploaded_file($_FILES["doggofile"]["tmp_name"], "../media/" . $_POST["doggoname"] . '.' . $extension)){
			die('my doeggo did itt!!!!');
		} else { http_response_code(501); /* Couldn't move file */ exit; }
	} else { http_response_code(501); /* No file uploaded */ exit; }
http_response_code(501); exit; } 



?>
<!doctype html>
<html lang="en">
    <head>
        <title>da good boi's gord panel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../style.css?v=<? echo $version; ?>">
		<script>
		    async function savedatnewpost() {
		        document.getElementById('savedatgordpost').innerHTML = 'hol\' up, da egg is poopin so we gotta wait for him to finish first...';
				let formData = new FormData();
				formData.append("postData", document.getElementById('postData').value);
				formData.append("postTitle", document.getElementById('postTitle').value);
				let response = await fetch('#', {
					method: "POST",
					body: formData
				})
				if (response.status != 200) { document.getElementById('savedatgordpost').innerHTML = 'ok so i plugged up the toilet so we kinda have some problems tbh'; alert('yeah so there was a problem so contact ur local egg to get it fixed ok bye'); return; }
				document.getElementById('savedatgordpost').innerHTML = 'aight da egg fibished poopin so we all good';
				setTimeout(function() {
				    function randomIntFromInterval(min, max) { return Math.floor(Math.random() * (max - min + 1) + min) }
				    //min = Math.ceil(1); // my toes usually dont touch dis very often tbh
                    //max = Math.floor(4); // my toes usually are touching this 
                    const randomNum = randomIntFromInterval(1, 4)
                    console.log(randomNum)
				    if (randomNum == 1) { document.getElementById('savedatgordpost').innerHTML = 'ye dat was a good one tbh'; }
				    else if (randomNum == 2) { document.getElementById('savedatgordpost').innerHTML = 'tbh i had a kinda average poo but we still good'; }
				    else if (randomNum == 3) { document.getElementById('savedatgordpost').innerHTML = 'ok so u kno how lik sometimes u have a bad poo? lik thats what i had bro it was kinda terrible tbh'; }
				    else { document.getElementById('savedatgordpost').innerHTML = 'ok bro i had like willy bad diahrea so lik just gib me a moment buh'; }
				}, 2000);
				setTimeout(function() {
				    document.getElementById('savedatgordpost').innerHTML = 'oe yeah btw u can click me if u wan see the new post';
				    document.getElementById('savedatgordpost').href = '../';
				    document.getElementById('savedatgordpost').setAttribute('onclick', '');
				}, 3500); 

		    }
		    
		    async function savedatupload() {
				document.getElementById('datUploadBtn').innerHTML = 'sending da derpy doggos to Seattle...'; // Saving text
				let formData = new FormData();
				formData.append("doggofile", fileupload.files[0]);
				formData.append("doggoname", document.getElementById('doggoname').value);
				let response = await fetch('#', {
					method: "POST",
					body: formData
				})
				if (response.status != 200) { document.getElementById('savedatgordpost').innerHTML = 'ueh oh... da derpy doggos got too derpy and derped off onto another planet!!!11!'; alert('ok so da egg did a poopy and now u need to contact ur local egg NOAW.'); return; }
				document.getElementById('datUploadBtn').innerHTML = 'da doggos made it dere safely!!'; // Saving text
				var fileInput = document.getElementById('fileupload');
                var fileName = fileInput.files[0].name;
                var extension = fileName.split('.').pop();
                
				navigator.clipboard.writeText('<img src="media/' + document.getElementById('doggoname').value + '.' + extension + '">');
				setTimeout(function() {
					document.getElementById('datUploadBtn').innerHTML = 'aleso me is a gord boi so i copied da img to u clipborb if u eber need it. u welcome.';
				}, 500);
				setTimeout(function() {
					document.getElementById('datUploadBtn').innerHTML = 'also click meh if u wan upload moar derpy doeggo gifs';
				}, 2000);
		    }
		</script>
    </head>
    <body>
		
		<ul>
            <li><a href="#" style="font-weight: bold">DoggoCMS</a></li>
            <li><a href="../">View Blebsite</a></li>
			<li class="right"><a href="?logout">Logout</a></li>
        </ul>
		
		<div class="card">
		<h1>cweate a new floofy blog poest:</h1>
		<textarea cols="40" id="postData" name="data" rows="20" placeholder="enter u floofy text here or else u glitch da puppies out!!11!!!!" style="width: -webkit-fill-available; margin: 0px 10px 0px 10px;"></textarea>
		<h2> da gord title: <input type="text" name="date" value="" placeholder="u floofy title go here" id="postTitle"> </h2>
		<!--<p>da date is prwe-set to toeday (<? echo date('n/j/Y', time()) ?>)</p> -->
		<a onclick="savedatnewpost()" class="button" style="display: block" id="savedatgordpost">save dat gord post</a>
		</div>
		<br>
		<div class="card">
		<h1>uepload soem of dat GORD media:</h1>
		<input type="file" name="fileupload" id="fileupload">
		<h2> meidae tietle: <input type="text" name="date" value="" placeholder="noe extension pls" id="doggoname"> </h2>

		<a onclick="savedatupload()" class="button" style="display: block" id="datUploadBtn">click me to upload moar derpy doeggo gifs</a>
		</div>
		
		<footer>
			<p>dis panel is for da gord bois only. no cattos allowed. </p>
		</footer>
    </body>
</html>
