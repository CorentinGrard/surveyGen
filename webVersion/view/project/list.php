<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> My projects</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Number of surveys</th>
                  <th>View more</th>
                </tr>
              </thead>
              <tbody>
              <?php
              foreach($tabP as $key => $project) {
                ?>
                <tr>
                  <td><?php echo $key; ?></td>
                  <td><?php echo $project->get('name'); ?></td>
                  <td><?php echo $project->get('description');?></td>
                  <td>Oui</td>
                  <td><a class="btn btn-primary" href="?controller=project&action=read&id=<?php echo $project->get('id');?>" role="button">View More</a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>