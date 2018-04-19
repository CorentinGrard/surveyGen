<form class="form-horizontal" method="get" action="index.php" id="form_id">
  <fieldset>
    <legend>Connexion :</legend>
    <input type='hidden' name='action' value='connected'>
    <input type='hidden' name='controller' value='utilisateur'>
    <div class="form-group">
      <label for="login_id" class="col-lg-2 control-label">Login</label>
      <div class="col-lg-10 connect">
        <input type="text" class="form-control" id="login_id" name="login" placeholder="Login">
      </div>
    </div>
    <div class="form-group">
      <label for="mdp_id" class="col-lg-2 control-label">Mot de passe</label>
      <div class="col-lg-10 connect">
        <input type="password" class="form-control" id="mdp_id" name="mdp" placeholder="Mot de passe">
      </div>
    </div>
    <div class="form-group" id="boutons_connect">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Annuler</button>
        <button type="submit" class="btn btn-primary">Connexion</button>
      </div>
    </div>
  </fieldset>
</form>
