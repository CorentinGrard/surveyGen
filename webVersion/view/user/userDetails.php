<?php
require(File::build_path(array("view","head.php")));
?>
    <div id="userInfos">
        <p>
            <?php
                echo($u->get('email'));
                echo("<br>");
                echo($u->get('name'));
                echo("<br>");
                echo($u->get('lastname'));
                echo("<br>");
                echo($u->get('birthdate'));
                echo("<br>");

                echo("<a href=\"?controller=user&action=update&email=".$u->get('email')."\">");
                  echo("Edit Profile");
                echo ("</a>");

                echo("<br>");
                echo("<br>");
                echo("<br>");
                echo("<br>");
                echo("<br>");

                echo("<a href=\"?controller=user&action=delete&email=".$u->get('email')."\">");
                  echo("Delete Profile");
                echo ("</a>");
            ?>
        </p>
    </div>
