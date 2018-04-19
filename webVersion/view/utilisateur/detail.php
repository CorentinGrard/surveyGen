  <br>
   <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
     <div class="profilBox">
      <img src="./image/utilisateur/user_default.jpg" alt="Utilisateur default" height=120 width=120>
       <div class="infoBox">
        <?php if(isset($_SESSION['login']) && Session::is_user($_SESSION['login'])){ ?><div><span class="titre_profil">Login</span> : <?php echo $login; ?></div> <?php } ?>
        <div><span class="titre_profil">Pseudo</span> : <?php echo $pseudo; ?></div>
        <?php if(isset($_SESSION['login']) && Session::is_user($_SESSION['login'])){ ?><div><span class="titre_profil">E-mail</span> : <?php echo $mail; ?></div>
        <div><span class="titre_profil">Sexe</span> : <?php echo $sexe; ?></div>
        <div><span class="titre_profil">Profession</span> : <?php echo $profession; ?></div><?php } ?>
     </div>
     <?php if((isset($_SESSION['login']) && Session::is_user($u->get('login'))) || (isset($_SESSION['login']) && Session::is_admin())  ){ ?><div class="modifBox">
       <a href="index.php?controller=utilisateur&action=update&login=<?php echo $login; ?>" class="table-link" data-toggle="tooltip" data-placement="right" title="Modifier vos données">
          <span class="fa-stack">
              <i class="fa fa-square fa-stack-2x"></i>
              <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
          </span>
       </a>
     <div id="btn-brouillon" data-toggle="tooltip" data-placement="right" title="Voir ses brouillons">
       <a href="?controller=anecdote&action=readBrouillon">
         <img alt="brouillon" id="image_brouillon" href="?controller=anecdote&action=readBrouillon" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4IiB2aWV3Qm94PSIwIDAgMTI4IDEyOCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMTI4IDEyOCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTgsMTEyVjE2YzAtNC40MTQsMy41OTQtOCw4LThoODBjNC40MTQsMCw4LDMuNTg2LDgsOHY0Ny4wMzFsOC04VjE2YzAtOC44MzYtNy4xNjQtMTYtMTYtMTZIMTZDNy4xNjQsMCwwLDcuMTY0LDAsMTZ2OTYgICAgYzAsOC44MzYsNy4xNjQsMTYsMTYsMTZoNDR2LThIMTZDMTEuNTk0LDEyMCw4LDExNi40MTQsOCwxMTJ6IE04OCwyNEgyNHY4aDY0VjI0eiBNODgsNDBIMjR2OGg2NFY0MHogTTg4LDU2SDI0djhoNjRWNTZ6IE0yNCw4MCAgICBoMzJ2LThIMjRWODB6IE0xMjUuNjU2LDcyTDEyMCw2Ni4zNDRjLTEuNTYzLTEuNTYzLTMuNjA5LTIuMzQ0LTUuNjU2LTIuMzQ0cy00LjA5NCwwLjc4MS01LjY1NiwyLjM0NGwtMzQuMzQ0LDM0LjM0NCAgICBDNzIuNzgxLDEwMi4yNSw2OCwxMDguMjkzLDY4LDExMC4zNEw2NCwxMjhsMTcuNjU2LTRjMCwwLDguMDk0LTQuNzgxLDkuNjU2LTYuMzQ0bDM0LjM0NC0zNC4zNDQgICAgQzEyOC43ODEsODAuMTg4LDEyOC43ODEsNzUuMTIxLDEyNS42NTYsNzJ6IE04OC40OTIsMTE0LjgyYy0wLjQ1MywwLjQzLTIuMDIsMS40ODgtMy45MzQsMi43MDdsLTEwLjM2My0xMC4zNjMgICAgYzEuMDYzLTEuNDU3LDIuMjQ2LTIuOTIyLDIuOTc3LTMuNjQ4bDI1Ljg1OS0yNS44NTlsMTEuMzEzLDExLjMxM0w4OC40OTIsMTE0LjgyeiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+Cjwvc3ZnPgo=" />
       </a>
      </div>
      <button class="suppProfil bouton-danger" type="button" data-toggle="modal" data-target="#modalSuppr" title="Supprimer votre compte">
           <span class="fa-stack">
               <i class="fa fa-square fa-stack-2x"></i>
               <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
           </span>
      </button>
    </div><?php } ?>
  </div>
  <?php if((isset($_SESSION['login']) && Session::is_user($u->get('login'))) || (isset($_SESSION['login']) && Session::is_admin())){ ?>
  <div class="modal fade" id="modalSuppr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmer la suppression</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Êtes vous sur de vouloir supprimer votre compte ? Une fois supprimé toutes les données vous concernant seront supprimées</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <form action="index.php" >
            <input type='hidden' name='action' value='delete'>
            <input type='hidden' name='controller' value='utilisateur'>
            <input type='hidden' name='login' value='<?php echo $login; ?>'>
            <button type="submit" class="btn btn-primary delconf">Confirmer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

  <h2> Les anecdotes de <?php echo $pseudo; ?> </h2>
    <?php foreach ($tab_a as $key => $a) {
      require(File::build_path(array ("view","anecdote","anecdote.php")));
    }
    ?>
