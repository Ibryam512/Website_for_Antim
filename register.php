<!DOCTYPE  html>
    <head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Въпроси</title>
		<link rel="stylesheet" href="css\style.css">
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<script src="js/jquery.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/script.js"></script>
	</head>
	<body>
        <h1 style="text-align:center">Моето училище</h1>
		<div class="row">
            <form action="connectUsers.php" class="col s12"style="text-align: center;margin-top: 10px;">
              <div class="row">
                <div class="input-field col s6"style="text-align: center;margin-top: 10px;">
                  <input placeholder="Първо име" id="first_name" type="text" class="validate">
                </div>
                <div class="input-field col s6"style="text-align: center;margin-top: 10px;">
                  <input placeholder="Фамилия" id="last_name" type="text" class="validate">
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12"style="text-align: center;margin-top: 10px;">
                  <input placeholder="Парола" id="password_1" type="password" class="validate">
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12"style="text-align: center;margin-top: 10px;">
                  <input placeholder="Потвърди парола" id="password_2" type="password" class="validate">
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12"style="text-align: center;margin-top: 10px;">
                  <input placeholder="Имейл" id="email" type="email" class="validate">
                </div>
              </div>
              <div class="row">
                  <div class="input-field col s12" style="text-align: center;margin-top: 10px;">
                      <button id="register" style="text-align: center;">Напред</button>
                  </div>
              </div>
            </form>
          </div>
    </body>
</html>