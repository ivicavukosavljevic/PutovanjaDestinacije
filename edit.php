<?php
if (!empty($_POST["action"])) {
// Preuzimanje promenljivih iz form elemenata
    $id = $_POST['id'];
    $ime = $_POST['Ime'];
    $prezime = $_POST['Prezime'];
    $nazivDestinacije = $_POST['NazivDestinacije'];
    $PrevoznoSredstvo = $_POST['Prevozno'];
    
    echo $id. " ".$ime. " ".$prezime. " ".$nazivDestinacije. " ".$PrevoznoSredstvo;


    $con = mysql_connect('localhost','root','');
   /* $con = mysql_connect('localhost', 'korisnik_putovanja', 'korisnik123'); */
    if (!$con) {
        exit('Povezivanje nije uspelo: ' . mysql_error());
    }

    mysql_select_db("dbputovanja", $con);
    $result = mysql_query("UPDATE destinacije SET Ime = '$ime', Prezime = '$prezime', NazivDestinacije = '$nazivDestinacije', Prevozno = $PrevoznoSredstvo WHERE IDDestinacije = $id");
    mysql_close($con);
    header('Location: destinacije.php');
    exit();
} else {
    $id = $_GET['id'];
    
    $con = mysql_connect('localhost','root','');
   /* $con = mysql_connect('localhost', 'korisnik_putovanja', 'korisnik123'); */
    if (!$con) {
        exit('Povezivanje nije uspelo: ' . mysql_error());
    }
    
    mysql_select_db("dbputovanja", $con);
    $result = mysql_query("SELECT * FROM destinacije WHERE IDDestinacije = $id");
    if (!$result) {
		exit('Invalid query: ' . mysql_error());
	}
        
        $d = mysql_fetch_array($result);
	
            mysql_close($con);
}
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
            $(document).ready(function () {
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
                        <h1>Izmena destinacije</h1>
                        <form method="post" action="edit.php">
                            <table class="table_create">
                                <tr>
                                    <td>
                                        Ime:
                                    </td>
                                    <td>
                                        <textarea name="Ime" cols="20" rows="1"><?php echo $d['Ime']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        Prezime: 
                                    </td>
                                    <td>
                                        <textarea name="Prezime" cols="30" rows="1"><?php echo $d['Prezime']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Naziv destinacije:
                                    </td>
                                    <td>
                                        <textarea name="NazivDestinacije" cols="30" rows="2"><?php echo $d['NazivDestinacije']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Prevozno sredstvo:
                                    </td>

                                    <td>
                                        <select name="Prevozno">
                                             <?php
                                             $con = mysql_connect('localhost','root','');
                                          /*  $con = mysql_connect('localhost', 'korisnik_putovanja', 'korisnik123'); */
                                            if (!$con) {
                                                exit('Povezivanje nije uspelo: ' . mysql_error());
                                            }

                                            mysql_select_db("dbputovanja", $con);
                                            
                                            $result = mysql_query('SELECT * FROM prevozno_sredstvo');
                                            if (!$result) {
                                                exit('Invalid query: ' . mysql_error());
                                            }

                                            $prevozna_sredstva = array();
                                            while ($row = mysql_fetch_array($result)) {
                                                $prevozna_sredstva[] = $row;
                                            }
                                            foreach ($prevozna_sredstva as $p):
                                                ?>
                                                <option value="<?php echo $p['IDPrevozno']."\""; if($p['IDPrevozno'] == $d['Prevozno']) echo " selected"; ?>> <?php echo $p['NazivSredstva']; ?></option>

                                                <?php
                                            endforeach;
                                            mysql_close($con);
                                            ?>
                                            
                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="hidden" name="action" value="edit" ></input>
                                        <input type="hidden" name="id" id="id" value="<?php echo $d['IDDestinacije']; ?>" >
                                        <input type="submit" value="Snimi" ></input>
                                    </td>
                                </tr>


                            </table>

                        </form>

                    </div> <!-- close content item -->

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
