<?php

$con = mysql_connect('localhost','root','');
/* $con = mysql_connect('localhost', 'korisnik_putovanja', 'korisnik123'); */
if (!$con) {
    exit('Povezivanje nije uspelo: ' . mysql_error());
}

mysql_select_db('dbputovanja', $con);
$result = mysql_query('SELECT * FROM destinacije INNER JOIN prevozno_sredstvo ON destinacije.Prevozno = prevozno_sredstvo.IDPrevozno');
if (!$result) {
    exit('Invalid query: ' . mysql_error());
}

$destinacije = array();
while ($row = mysql_fetch_array($result)) {
    $destinacije[] = $row;
}
mysql_close($con);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Proputuj Srbiju</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
    });
  </script>

</head>

<body>
    <div id="page">
        <div id="header">
            <h1>Proputuj Srbiju</h1>
        </div>   					
        <div id="nav">
            <ul>
                <li>
                    <div align="center"><a href="index.php">Naslovna</a></div></li>
                <li class="selected"><a href="destinacije.php">Destinacije</a></li>
                <li><a href="#">Prevozna sredstva</a></li>
                <li style="float:right"><a href="#">Uloguj se</a></li>
            </ul>
        </div><!-- header -->  
        
        <div class="content_item">
             <h1>Administracija destinacija</h1>
            <a href="create.php">Kreiranje destinacije</a>
            <br/> <br/>
            <table class="list_prikaz">
                <?php                foreach ($destinacije as $d): ?>
                <tr>
                    <td>
                        Naziv destinacije: <?php echo $d['NazivDestinacije'];?>
                    </td>
                    <td>
                        <form name="edit<?php echo $d['IDDestinacije']; ?>" method="GET" action="edit.php">
                            <input type="hidden" name="id" id="id" value="<?php echo $d['IDDestinacije']; ?>"/>
                            <input type="Button" value="Izmeni" onclick="document.edit<?php echo $d['IDDestinacije']; ?>.submit()"/>
                    </form>
                        
                   </td>
                    <td>
                        <form name="delete<?php echo $d['IDDestinacije'];?>" method="POST" action="delete.php">
                            <input type="hidden" name="id" id="id" value="<?php echo $d['IDDestinacije']; ?>"/>
                            <input type="Button" value="Obriši" onclick="document.delete<?php echo $d['IDDestinacije']; ?>.submit()"/>
                    </form>
                   </td>
                </tr>
                <?php                endforeach; ?>
            </table>
        </div> <!-- conttent_item close -->
        
<div id="footer">
        <p>Copyright &copy; Ivica Vukosavljević</p>
    </div>
    </div>
</body>
</html>
