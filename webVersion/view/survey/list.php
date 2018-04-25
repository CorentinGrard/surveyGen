<div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> My Surveys</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Objective</th>
                  <th>Start date</th>
                  <th>Final date</th>
                  <th>View More</th>
                </tr>
              </thead>
              <tbody>
              <?php
              foreach($tabS as $key => $survey) {
                ?>
                <tr>
                  <td><?php echo $key; ?></td>
                  <td><?php echo $survey->get('name'); ?></td>
                  <td><?php echo $survey->get('description');?></td>
                  <td><?php echo $survey->get('objective');?></td>
                  <td><?php echo $survey->get('startdate');?></td>
                  <td><?php echo $survey->get('finaldate');?></td>
                  <td><a class="btn btn-primary" href="?controller=survey&action=read&id=<?php echo $survey->get('id');?>" role="button">View More</a></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>