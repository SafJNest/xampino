<!DOCTYPE html>
<html>
<head>
<title>Esempio pagina WEB dinamica</title>
<link rel="stylesheet" type="text/css" href="stile.css">
<script src="script.js"></script>
</head>
<body>
<div id="content">
  <img src="img/logo.png" width="500">

  <div id="form">
    <form action="ricerca.php" method="post">
      <input type="text" name="key" id="id_key" placeholder="Codice fiscale">
      <input type="submit" value="cerca" onclick="return check();" />
    </form>
  </div>

  <div id="dinamicHTML">
  <?php
  
  if (isset($_POST["key"])) {
  
  //significa che nella url è presente il parametro key (si dice che in querystring è presente key)
  
  $servername = "localhost"; //il DBMR è sul server web
  $username = "root"; //utente con cui accediamo al db
  $password = ""; //password con cui accediamo al db (vuoto in questo caso)
  $db = "dentisti"; //nome del database (su un DBMS possono esserci più db)
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $db);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $key = $_POST["key"]; //leggo la chiave di ricerca
  
  $sql = "SELECT spec, codiceFiSc, nome, cognome from dentone where codiceFisc = '" . $key . "'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
  
      //recupero i valori dal database e costruisco la tabella
  
      echo("<table>");
      echo("<tr>");
      echo("<th id = 'left'>codiceFiSc</th>");
      echo("<th>nome</th>");
      echo("<th>cognome</th>");
      echo("<th id = 'right'>spec</th>");
      echo("</tr>");
  
      while($row = $result->fetch_assoc()) {
  
        echo("<tr>");
        echo("<td>" . $row["codiceFiSc"]. "</td>");
        echo("<td>" . $row["nome"]. "</td>");
        echo("<td>" . $row["cognome"]. "</td>");
        echo("<td>" . $row["spec"]. "</td>");
        echo("</tr>");
  
      }
  
      echo("</table>");
      echo("<br/>Risultati: <b>" . $result->num_rows . "</b>");
  
  } else {
      echo("<br/>Risultati: <b>0</b>");
  }
  $conn->close();
  }
  ?>
  </div>
</div>
</body>
</html>