<?php
$con = mysql_connect('localhost','root','');
/* $con = mysql_connect('localhost', 'korisnik_putovanja', 'korisnik123'); */
if (!$con) {
    exit('Povezivanje nije uspelo: ' . mysql_error());
}

$query = "";
if (!empty($_GET["search"])) {
    $search = $_GET["search"];
    $query = "SELECT * FROM destinacije INNER JOIN prevozno_sredstvo "
            . "ON destinacije.Prevozno = prevozno_sredstvo.IDPrevozno WHERE NazivDestinacije LIKE'%" . $search . "%'";
} else {
    $query = "SELECT * FROM destinacije INNER JOIN prevozno_sredstvo "
            . "ON destinacije.Prevozno = prevozno_sredstvo.IDPrevozno";
}
mysql_select_db('dbputovanja', $con);
$result = mysql_query($query);
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
                    <li><a class="selected" href="index.php">Naslovna</a></li>
                    <li><a href="destinacije.php">Destinacije</a></li>
                    <li><a href="#">Prevozna sredstva</a></li>
                    <li style="float:right"><a href="#">Uloguj se</a></li>
                </ul>
            </div><!-- nav --> 

            <div id="site_content">            
                <div id="content">
                    
                    <div class="content_item">
                        <h1>Lista destinacija</h1>
                        <br/>
<?php foreach ($destinacije as $d): ?>
                            <div class="tablediv">
                                Ime: <?php echo $d['Ime']; ?><br/>
                                Prezime: <?php echo $d['Prezime']; ?><br/>
                                Naziv Destinacije: <?php echo $d['NazivDestinacije']; ?><br/>
                                Prevozno sredstvo: <?php echo $d['NazivSredstva']; ?>
                            </div>
                                <br/>
                                <?php endforeach; ?>
                                </div> <!-- close content item 
                    
                                

                            -->    
                    <div class="sidebar_container">
                        <div class="sidebar">
                            <div class="sidebar_item">
                                    <?php include('side_menu.php'); ?>
                                   </div><!--close sidebar_item--> 
                            </div><!--close sidebar-->
                    </div><!--close sidebar_container-->	
                </div><!--close content-->
            </div><!--close site_content--> 
            
                    
                    
                    <div id="footer">
                            <p>Copyright &copy; Ivica Vukosavljević</p>
                        </div>
                </div> <!-- close page-->

                    </body>
                    </html>
