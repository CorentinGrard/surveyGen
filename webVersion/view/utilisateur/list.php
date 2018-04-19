<?php

$test = '
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<hr>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">

                            <thead>
                                <tr>
                                <th><span>Pseudo</span></th>
                                <th><span>Login</span></th>
                                <!--<th><span>Date d\'inscription</span></th>-->
                                <th><span>Sexe</span></th>
                                <th><span>Email</span></th>
                                <th><span>Profession</span></th>
                                <th>Modération</th>
                                </tr>
                            </thead>
                            <tbody>';

                            foreach ($tab_u as $u){
                              $login=htmlspecialchars($u->get('login'));
                              $loginUrl=rawurlencode($u->get('login'));
                              $pseudo=htmlspecialchars($u->get('pseudo'));
                              $sexe=htmlspecialchars($u->get('sexe'));
                              $email=htmlspecialchars($u->get('email'));
                              $profession=htmlspecialchars($u->get('profession'));
                              $admin=htmlspecialchars($u->get('admin'));
                              $status="Membre";
                              if($admin){
                                $status="Admin";
                              }
                              $test .= '<tr>
                                  <td>
                                      <img src="./image/utilisateur/user_default.jpg" alt="Utilisateur default">
                                      <a href="index.php?controller=utilisateur&action=read&login='.$loginUrl.'">'.$pseudo.'</a>
                                      <span class="user-subhead">'.$status.'</span>
                                  </td>

                                  <td>
                                      <div>'.$login.'</div>
                                  </td>
                                  <!--<td>2013/08/12</td>-->
                                  <td>
                                      <div>'.$sexe.'</div>
                                  </td>
                                  <td>
                                      <div>'.$email.'</div>
                                  </td>
                                  <td>
                                      <div>'.$profession.'</div>
                                  </td>
                                  <td style="width: 10%;">
                                      <a href="index.php?controller=utilisateur&action=read&login='.$loginUrl.'" class="table-link" data-toggle="tooltip" data-placement="top" title="Voir le profil de cet utilisateur">
                                          <span class="fa-stack">
                                              <i class="fa fa-square fa-stack-2x"></i>
                                              <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                          </span>
                                      </a>
                                      <a href="index.php?controller=utilisateur&action=update&login='.$loginUrl.'" class="table-link" data-toggle="tooltip" data-placement="top" title="Modifier cet utilisateur">
                                          <span class="fa-stack">
                                              <i class="fa fa-square fa-stack-2x"></i>
                                              <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                          </span>
                                      </a>
                                      <a href="index.php?controller=utilisateur&action=delete&login='.$loginUrl.'" class="table-link danger" data-toggle="tooltip" data-placement="top" title="Supprimer cet utilisateur">
                                          <span class="fa-stack">
                                              <i class="fa fa-square fa-stack-2x"></i>
                                              <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                          </span>
                                      </a>
                                  </td>

                              </tr>';
                            }
                            $test .= '  </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>';
                            echo $test;


?>
