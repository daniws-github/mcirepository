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
                                       <p>This feature allows you to manage user permissions and document access. With this functionality, you can ensure that only authorized users have access to specific documents. </p>
                                   </div>
                               </div>
                           </div>
                           <div class="card card-bordered card-preview">
                               <div class="card-inner">
                                   <table class="datatable-init table nowrap table">
                                       <thead>
                                           <tr>
                                               <th>#</th>
                                               <th>User</th>
                                               <th>Role</th>
                                               <th>Action</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           <?php if (!empty($users)) : ?>
                                               <?php $no = 1;
                                                foreach ($users as $user) : ?>
                                                   <tr>
                                                       <td><?= $no++; ?></td>
                                                       <td><?php echo $user->username; ?></td>
                                                       <td><?php echo $user->role == 1 ? 'Admin' : 'User'; ?></td>
                                                       <td><a href="<?php echo site_url('users/permissions/' . $user->id); ?>">View Permissions</a></td>
                                                   </tr>
                                               <?php endforeach; ?>
                                           <?php else : ?>
                                               <tr>
                                                   <td colspan="3">No users found.</td>
                                               </tr>
                                           <?php endif; ?>
                                       </tbody>
                                   </table>
                               </div>
                           </div><!-- .card-preview -->
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>