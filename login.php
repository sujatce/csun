<?php session_start(); ?>
<?php require("botdetect.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
     <link type="text/css" rel="Stylesheet" 
    href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="authenticate.php" method="post">
        <?php // Adding BotDetect Captcha to the page
        $ExampleCaptcha = new Captcha("ExampleCaptcha");
        $ExampleCaptcha->UserInputID = "CaptchaCode";
        echo $ExampleCaptcha->Html();
      ?>
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
				<p class="form__text">
					<a href="#" class="form__link">Forgot your password?</a>
				</p>
				<p class="form__text">
					<a class="form__link" href="./register.html" id="linkCreateAccount">Don't have an account? Create account</a>
				</p>
           <?php // when the form is submitted
          if ($_POST) {
            // validate the Captcha to check we're not dealing with a bot
            $isHuman = $ExampleCaptcha->Validate();

            if (!$isHuman) {
              // Captcha validation failed, show error message
              echo "<span class=\"incorrect\">Incorrect code</span>";
            } else {
              // Captcha validation passed, perform protected action
              echo "<span class=\"correct\">Correct code</span>";
            }
          }
        ?>
			</form>
		</div>
	</body>
</html>
