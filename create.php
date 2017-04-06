<?php
if (!empty($_POST["action"])) {
// Preuzimanje promenljivih iz form elemenata
    $Ime = $_POST['Ime'];
    $Prezime = $_POST['Prezime'];
    $NazivDestinacije = $_POST['NazivDestinacije'];
    $PrevoznoSredstvo = $_POST['Prevozno'];


    $con = mysql_connect('localhost', 'root', '');
    /* $con = mysql_connect('localhost', 'korisnik_putovanja', 'korisnik123'); */
    if (!$con) {
        exit('Povezivanje nije uspelo: ' . mysql_error());
    }

    mysql_select_db("dbputovanja", $con);
    mysql_query("INSERT INTO destinacije(Ime, Prezime, NazivDestinacije, Prevozno) VALUES('$Ime', '$Prezime', '$NazivDestinacije', '$PrevoznoSredstvo')");
    header('Location: destinacije.php');
    exit();
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
                    <li><a href="index.php">Naslovna</a></li>
                    <li><a class="selected" href="destinacije.php">Destinacije</a></li>
                    <li><a href="#">Prevozna sredstva</a></li>
                    <li style="float:right"><a href="#">Uloguj se</a></li>
                </ul>
            </div><!-- nav --> 

            <div id="site_content">            
                <div id="content">

                    <div class="content_item">
                        <h1>Kreiranje destinacije</h1>
                        <form method="post" action="create.php">
                            <table class="table_create">
                                <tr>
                                    <td>
                                        Ime:
                                    </td>
                                    <td>
                                        <textarea name="Ime" cols="20" rows="1"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        Prezime: 
                                    </td>
                                    <td>
                                        <textarea name="Prezime" cols="30" rows="1"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Naziv destinacije:
                                    </td>
                                    <td>
                                        <textarea name="NazivDestinacije" cols="30" rows="2"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Prevozno sredstvo:
                                    </td>

                                    <td>
                                        <select name="Prevozno">
                                            <?php
                                            $con = mysql_connect('localhost', 'root', '');
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
                                            foreach ($prevozna_sredstva as $s):
                                                ?>

                                                <option value="<?php echo $s['IDPrevozno']; ?>"> <?php echo $s['NazivSredstva']; ?> </option>


                                                <?php
                                            endforeach;
                                            mysql_close($con);
                                            ?>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="hidden" name="action" value="create" ></input>
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
