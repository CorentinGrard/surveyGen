<form method=<?php echo $postOrGet?> action="index.php" id="form_id" class="col-md-10">
  <fieldset>
    <legend>Mise à jour du profil : </legend>
    <div class="form-group">
    <input type='hidden' name='action' value='updated'>
    <input type='hidden' name='controller' value='utilisateur'>
    <div class="form-group">
      <label class="col-lg-2 control-label" for="login_id">Login*</label>
      <input class="form-control connect" id="login_id" type="text" name="login" placeholder="Ex : Momomio" value=<?php echo '"'.htmlspecialchars($login).'"'; ?> readonly>
    </div>
    <div class="form-group">
      <label for="pseudo_id" class="col-lg-2 control-label">Pseudo*</label>
      <input type="text" class="form-control connect" id="pseudo_id" name="pseudo" placeholder="Ex : DarkEvilox" value=<?php echo '"'.htmlspecialchars($Utilisateur->get('pseudo')).'"'; ?> required>
    </div>
    <div class="form-group">
      <label for="email_id" class="col-lg-2 control-label">Email*</label>
      <input type="email" class="form-control connect" id="email_id" name="email" placeholder="Ex : eviloxLeDieu@gmail.com" value=<?php echo '"'.htmlspecialchars($Utilisateur->get('email')).'"'; ?> required>
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
      <input list="sexe_id" class="form-control" placeholder="Ex : Helicoptere Apache" value=<?php echo '"'.htmlspecialchars($Utilisateur->get('sexe')).'"'; ?> name="sexe">
      <datalist id="sexe_id">
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
      </datalist>
    </div>
    <div class="form-group">
      <label for="profession_id" class="col-lg-2 control-label">Profession</label>
      <input type="text" class="form-control connect" id="profession_id" name="profession" placeholder="Ex : Cuisinier" value=<?php echo '"'.htmlspecialchars($Utilisateur->get('profession')).'"'; ?>>
    </div>
    <?php
    echo $admin;
    ?>
  </fieldset>
      <button type="reset" class="btn btn-default">Annuler</button>
      <button type="submit" class="btn btn-primary">Accepter</button>
</form>
<small> * requis</small>
