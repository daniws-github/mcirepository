   <div class="nk-content ">
       <div class="container-fluid">
           <div class="nk-content-inner">
               <div class="nk-content-body">
                   <div class="components-preview wide-md mx-auto">
                       <div class="nk-block nk-block-lg">
                           <div class="nk-block-head">
                               <div class="nk-block-head-content">
                                   <h4 class="title nk-block-title"><?= $title; ?></h4>
                                   <div class="nk-block-des">
                                       <p>This feature allows you to track various activities such as login attempts, document views, and document downloads. You can use the tabs below to navigate between the different activity logs and monitor user interactions in real-time.</p>
                                   </div>
                               </div>
                           </div>
                           <div class="card card-bordered card-preview">
                               <div class="card-inner">
                                   <ul class="nav nav-tabs mt-n3">
                                       <li class="nav-item">
                                           <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Login Activity</a>
                                       </li>
                                       <li class="nav-item">
                                           <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Views Activity</a>
                                       </li>
                                       <li class="nav-item">
                                           <a class="nav-link" data-bs-toggle="tab" href="#tabItem3">Download Activity</a>
                                       </li>
                                   </ul>
                                   <div class="tab-content">
                                       <div class="tab-pane active" id="tabItem1">
                                           <p>
                                           <table class="datatable-init table nowrap table">
                                               <thead>
                                                   <tr>
                                                       <th>#</th>
                                                       <th>Users</th>
                                                       <th>Email</th>
                                                       <th>Login time</th>
                                                       <th>IP</th>
                                                       <th>Status</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                   <?php $no = 1;
                                                    foreach ($login_history as $log) : ?>
                                                       <tr>
                                                           <td><?= $no++; ?></td>
                                                           <td><?php echo $log->username; ?></td>
                                                           <td><?php echo $log->email; ?></td>
                                                           <td><?php echo $log->login_time; ?></td>
                                                           <td><?php echo $log->ip_address; ?></td>
                                                           <td class="<?php echo $log->status === 'Success' ? 'status-success' : 'status-fail'; ?>">
                                                               <?php echo $log->status; ?>
                                                           </td>
                                                       </tr>
                                                   <?php endforeach; ?>
                                               </tbody>
                                           </table>
                                           </p>
                                       </div>
                                       <div class="tab-pane" id="tabItem2">
                                           <p>
                                           <table class="datatable-init table nowrap table">
                                               <thead>
                                                   <tr>
                                                       <th>#</th>
                                                       <th>Users</th>
                                                       <th>Document Name</th>
                                                       <th>View time</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                   <?php $no = 1;
                                                    foreach ($view_document as $viewdoc) : ?>
                                                       <tr>
                                                           <td><?= $no++; ?></td>
                                                           <td><?php echo $viewdoc->username; ?></td>
                                                           <td><?php echo $viewdoc->doc_name; ?></td>
                                                           <td><?php echo $viewdoc->view_time; ?></td>
                                                       </tr>
                                                   <?php endforeach; ?>
                                               </tbody>
                                           </table>
                                           </p>
                                       </div>
                                       <div class="tab-pane" id="tabItem3">
                                           <p>
                                           <table class="datatable-init table nowrap table">
                                               <thead>
                                                   <tr>
                                                       <th>#</th>
                                                       <th>Users</th>
                                                       <th>Document Name</th>
                                                       <th>Download time</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                   <?php $no = 1;
                                                    foreach ($download_document as $download) : ?>
                                                       <tr>
                                                           <td><?= $no++; ?></td>
                                                           <td><?php echo $download->username; ?></td>
                                                           <td><?php echo $download->doc_name; ?></td>
                                                           <td><?php echo $download->donwnloadtime; ?></td>
                                                       </tr>
                                                   <?php endforeach; ?>
                                               </tbody>
                                           </table>
                                           </p>
                                       </div>
                                   </div>
                               </div>
                           </div><!-- .card-preview -->
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>