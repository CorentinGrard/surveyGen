<form method=<?php echo $postOrGet?> action="index.php" id="form_id" class="col-md-10">
  <fieldset>
    <legend>Inscription :</legend>
    <div class="form-group">
    <input type='hidden' name='action' value='created'>
    <input type='hidden' name='controller' value='utilisateur'>
    <div class="form-group">
      <label class="col-lg-2 control-label" for="login_id">Login*</label>
      <input class="form-control connect" id="login_id" type="text" name="login" placeholder="Ex : Momomio" required>
    </div>
    <div class="form-group">
      <label for="pseudo_id" class="col-lg-2 control-label">Pseudo*</label>
      <input type="text" class="form-control connect" id="pseudo_id" name="pseudo" placeholder="Ex : DarkEvilox" required>
    </div>
    <div class="form-group">
      <label for="email_id" class="col-lg-2 control-label">Email*</label>
      <input type="email" class="form-control connect" id="email_id" name="email" placeholder="Ex : eviloxLeDieu@gmail.com" required>
    </div>
    <div class="form-group">
      <label for="mdp_id" class="col-lg-2 control-label">Mot de passe*</label>
      <input type="password" class="form-control connect" id="mdp_id" name="mdp" placeholder="Ex : gtr5rg145" required>
    </div>
    <div class="form-group">
      <label for="confMdp_id" class="col-lg-5 control-label">Confirmation mot de passe*</label>
      <input type="password" class="form-control connect" id="confMdp_id" name="confMdp" placeholder="Ex : gtr5rg145" required>
    </div>
    <div class="form-group">
      <label for="sexe_id" class="col-lg-2 control-label">Sexe</label>
      <input list="sexe_id" class="form-control" placeholder="Ex : Helicoptere Apache" name="sexe">
      <datalist id="sexe_id">
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
      </datalist>
    </div>
    <div class="form-group">
      <label for="profession_id" class="col-lg-2 control-label">Profession</label>
      <input type="text" class="form-control connect" id="profession_id" name="profession" placeholder="Ex : Cuisinier">
    </div>
    <?php
      echo $admin;
    ?>
  </fieldset>
      <button type="reset" class="btn btn-default">Annuler</button>
      <button type="submit" class="btn btn-primary">Confirmer</button>
</form>
<small> * requis</small>
