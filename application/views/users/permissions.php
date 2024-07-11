     <div class="nk-content ">
         <div class="container-fluid">
             <div class="nk-content-inner">
                 <div class="nk-content-body">
                     <div class="nk-block-head nk-block-head-sm">
                         <div class="nk-block-between g-3">
                             <div class="nk-block-head">
                                 <div class="nk-block-head-content">
                                     <h4 class="title nk-block-title"><?= $title; ?></h4>
                                     <div class="nk-block-des">
                                         <p>This feature allows you to manage user permissions and document access. </p>
                                     </div>
                                 </div>
                             </div>
                             <div class="nk-block-head-content">
                                 <a href="html/user-list-regular.html" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                 <a href="html/user-list-regular.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                             </div>
                         </div>
                     </div><!-- .nk-block-head -->
                     <div class="nk-block">
                         <div class="card">
                             <div class="card-aside-wrap">
                                 <div class="card-content">
                                     <div class="card-inner">
                                         <div class="nk-block">
                                             <div class="nk-block-head nk-block-head-line">
                                                 <h6 class="title overline-title text-base">User Information</h6>
                                             </div><!-- .nk-block-head -->
                                             <hr>
                                             <div class="profile-ud-list">
                                                 <div class="profile-ud-item">
                                                     <div class="profile-ud wider">
                                                         <span class="profile-ud-label">Full Name</span>
                                                         <span class="profile-ud-value"><?php echo $user->username; ?></span>
                                                     </div>
                                                 </div>
                                                 <div class="profile-ud-item">
                                                     <div class="profile-ud wider">
                                                         <span class="profile-ud-label">Role type</span>
                                                         <span class="profile-ud-value"><?php echo $user->role == 1 ? 'Admin Access' : 'User Access'; ?></span>
                                                     </div>
                                                 </div>
                                                 <div class="profile-ud-item">
                                                     <div class="profile-ud wider">
                                                         <span class="profile-ud-label">User Email</span>
                                                         <span class="profile-ud-value"><?php echo $user->email; ?></span>
                                                     </div>
                                                 </div>
                                                 <div class="profile-ud-item">
                                                     <div class="profile-ud wider">
                                                         <span class="profile-ud-label">Permission type</span>
                                                         <span class="profile-ud-value"><span class="badge bg-warning">View Document</span></span>
                                                     </div>
                                                 </div>
                                             </div><!-- .profile-ud-list -->
                                         </div><!-- .nk-block -->
                                         <div class="nk-divider divider md"></div>
                                         <div class="nk-block">
                                             <div class="nk-block-head nk-block-head-sm nk-block-between">
                                                 <h5 class="title"></h5>
                                                 <a href="<?= site_url('add-permission') ?>" class="link link-sm">+ Add Permission</a>
                                             </div><!-- .nk-block-head -->
                                             <div class="bq-note">
                                                 <table class="datatable-init table nowrap table">
                                                     <thead>
                                                         <tr>
                                                             <th>#</th>
                                                             <th>Document Access</th>
                                                             <th>Status</th>
                                                             <th>Action</th>
                                                         </tr>
                                                     </thead>
                                                     <tbody>
                                                         <?php if (!empty($permissions)) : ?>
                                                             <?php $no = 1;
                                                                foreach ($permissions as $permission) : ?>
                                                                 <tr>
                                                                     <td><?= $no++ ?></td>
                                                                     <td><?php echo $permission->document_title; ?></td>
                                                                     <td>
                                                                         <?php if ($permission->status == 'open') : ?>
                                                                             <span class="badge bg-success">open</span>
                                                                         <?php else : ?>
                                                                             <span class="badge bg-danger">close</span>
                                                                         <?php endif; ?>
                                                                     </td>
                                                                     <td>
                                                                         <form method="post" action="<?php echo site_url('users/update_document_status/' . $permission->id); ?>">
                                                                             <button type="submit" name="status" value="<?php echo $permission->status == 'open' ? 'close' : 'open'; ?>" class="btn btn-<?php echo $permission->status == 'open' ? 'light' : 'dark'; ?> btn-sm">
                                                                                 <?php echo $permission->status == 'open' ? 'close' : 'open'; ?>
                                                                             </button>
                                                                         </form>
                                                                     </td>
                                                                 </tr>
                                                             <?php endforeach; ?>
                                                         <?php else : ?>
                                                             <tr>
                                                                 <td colspan="4">No permissions found.</td>
                                                             </tr>
                                                         <?php endif; ?>
                                                     </tbody>
                                                 </table>

                                             </div>
                                         </div>
                                     </div><!-- .card-inner -->
                                 </div><!-- .card-content -->
                             </div><!-- .card-aside-wrap -->
                         </div><!-- .card -->
                     </div><!-- .nk-block -->
                 </div>
             </div>
         </div>
     </div>