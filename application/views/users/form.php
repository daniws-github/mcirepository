<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to" href="html/components.html"><em class="icon ni ni-arrow-left"></em><span>Back</span></a></div>
                        </div>
                    </div><!-- .nk-block -->
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h4 class="title nk-block-title"><?= $title; ?></h4>
                                <div class="nk-block-des">
                                    <p>You can make style out your setting related form as per below example.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <form method="post" action="<?php echo site_url('process-permission'); ?>" class="gy-3">
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="site-name">User Account</label>
                                                <span class="form-note">Specify the user account to which you want to grant permissions.</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <select class="form-select js-select2" data-search="on" name="user_id">
                                                        <?php foreach ($users as $user) : ?>
                                                            <option value="<?php echo $user->id; ?>"><?php echo $user->username; ?></option>
                                                            <!-- Ganti "username" dengan kolom yang sesuai dari tabel users -->
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label">Document Access</label>
                                                <span class="form-note">Determine the document access type.</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <select class="form-select js-select2" data-search="on" name="document_id">
                                                        <?php foreach ($document as $doc) : ?>
                                                            <option value="<?php echo $doc->id; ?>"><?php echo $doc->name; ?></option>
                                                            <!-- Ganti "username" dengan kolom yang sesuai dari tabel users -->
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-lg-7 offset-lg-5">
                                            <div class="form-group mt-2">
                                                <button type="submit" class="btn btn-sm btn-primary">Add Permission</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- card -->
                    </div><!-- .nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>