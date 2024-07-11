<!-- content @s -->
<div class="nk-content p-0">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-fmg-body-content">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="example-alert mt-3">
                        <div class="alert alert-secondary alert-icon">
                            <em class="icon ni ni-alert-circle"></em> <strong>Welcome to MCI Repositori Portal, <?= $this->session->userdata('username') ?>!</strong>
                        </div>
                    </div>
                    <div class="nk-block-between position-relative mt-4">
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-1">
                                <li class="d-lg-none">
                                    <a href="#" class="btn btn-trigger btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                </li>
                                <li class="d-lg-none">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#file-upload" data-bs-toggle="modal"><em class="icon ni ni-upload-cloud"></em><span>Upload File</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-file-plus"></em><span>Create File</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-folder-plus"></em><span>Create Folder</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-lg-none me-n1"><a href="#" class="btn btn-trigger btn-icon toggle" data-target="files-aside"><em class="icon ni ni-menu-alt-r"></em></a></li>
                            </ul>
                        </div>
                        <div class="search-wrap px-2 d-lg-none" data-search="search">
                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                        </div><!-- .search-wrap -->
                    </div>
                </div>
                <div class="nk-fmg-listing nk-block-lg">
                    <div class="nk-block-head-xs">
                        <!-- Form Filter -->
                        <form action="" method="post" id="filter">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-search"></em>
                                            </div>
                                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Search document">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <select name="type_id" id="type_id" class="form-control">
                                                <option value="all">All</option>
                                                <?php foreach ($types as $type) : ?>
                                                    <option value="<?= $type->id ?>"><?= $type->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group" role="group">
                                        <?php if ($this->session->userdata('role') == 1) : ?>
                                            <a href="<?= site_url('document') ?>" class="btn btn-outline-danger"><em class="icon ni ni-upload-cloud"></em>&nbsp; Upload</a>
                                        <?php elseif ($this->session->userdata('role') == 2) : ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!-- .nk-block-head -->
                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="file-grid-view">
                            <div class="row">
                                <div class="col" id="document-container">
                                    <?php
                                    $all_documents_empty = true;
                                    foreach ($types as $type) {
                                        $filtered_documents = isset($documents_by_type[$type->id]) ? $documents_by_type[$type->id] : [];
                                        if (!empty($filtered_documents)) {
                                            $all_documents_empty = false;
                                            break;
                                        }
                                    }

                                    if ($all_documents_empty) : ?>
                                        <div class="d-flex justify-content-center align-items-center flex-column" style="height: 100vh;">
                                            <img src="<?= base_url('assets/images/no.webp') ?>" alt="No Data" style="max-width: 300px; max-height: 300px;">
                                            <p class="mt-3">No documents available</p>
                                        </div>
                                    <?php else : ?>
                                        <?php foreach ($types as $type) : ?>
                                            <?php
                                            $filtered_documents = isset($documents_by_type[$type->id]) ? $documents_by_type[$type->id] : [];
                                            if (empty($filtered_documents)) {
                                                continue;
                                            }
                                            ?>
                                            <div class="row mb-4">
                                                <div class="col mt-3">
                                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                                        <h4><?= $type->name ?></h4>
                                                        <a id="listData<?= $type->id ?>" data-type-name="<?= $type->name ?>" style="text-decoration: none; color: #E11C1C;">
                                                            <i class="fa-solid fa-eye"></i>&nbsp; Show All
                                                        </a>
                                                    </div>
                                                    <div style="height: 2px; background: gray; margin-top: 10px;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <?php foreach ($filtered_documents as $doc) : ?>
                                                    <div class="col-md-4 mb-4">
                                                        <div class="card h-100">
                                                            <?php if ($doc->thumbnail != null) : ?>
                                                                <img src="<?= base_url('uploads/thumbnail/') . $doc->thumbnail ?>" class="card-img-top" alt="Thumbnail" data-bs-toggle="modal" data-bs-target="#modalZoom<?= $doc->id ?>" style="max-height: 200px; object-fit: cover;">
                                                            <?php else : ?>
                                                                <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                                                                    <img src="<?= base_url('assets/images/pdf.png') ?>" class="card-img-top" alt="Thumbnail" data-bs-toggle="modal" data-bs-target="#modalZoom<?= $doc->id ?>" style="max-width: 80%; max-height: 80%; object-fit: contain;">
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="card-body">
                                                                <span><?= $doc->name ?></span>
                                                            </div>
                                                            <div class="card-footer d-flex justify-content-between">
                                                                <small class="text-muted"><?= date('d F Y', strtotime($doc->upload_date)) ?></small>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-link text-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?= $doc->id ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa-solid fa-ellipsis-v"></i>
                                                                    </button>
                                                                    <!-- Contoh penggunaan dalam template HTML -->
                                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $doc->id ?>">
                                                                        <li><a class="dropdown-item download-link" href="<?= base_url('uploads/' . $doc->file) ?>" data-user-id="<?= $this->session->userdata('id') ?>" data-document-id="<?= $doc->id ?>" download>Download</a></li>
                                                                        <li><a class="dropdown-item download-link" href="<?= base_url('document/update/' . $doc->id) ?>">Update</a></li>
                                                                    </ul>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div><!-- .tab-pane -->
                    </div>

                    <!-- list data all -->
                    <div class="card card-bordered card-preview mt-4" id="table-data" style="display: none;">
                        <div class="card-inner">
                            <table class="table" id="table-data">
                                <thead class="table-light" style="overflow-x: auto;">
                                    <tr>
                                        <th style="white-space: nowrap;">#</th>
                                        <th style="white-space: nowrap;">Name</th>
                                        <th style="white-space: nowrap;">Date</th>
                                        <th style="white-space: nowrap;">Description & Summary</th>
                                        <th style="white-space: nowrap;">Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data tabel akan dimasukkan secara dinamis di sini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->

<!-- modal details -->
<?php foreach ($documents_by_type as $type_id => $documents) : ?>
    <?php foreach ($documents as $d) : ?>
        <div class="modal fade zoom" tabindex="-1" id="modalZoom<?= $d->id ?>">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= $d->name ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><small><i><b><?= $d->type_name ?></b></i></small></h6>
                            </div>
                            <div class="col-md-6">
                                <h6><small><i><b><em class="icon ni ni-clock"></em> Upload time : <?= date('d F Y', strtotime($d->upload_date)) ?></b></i></small></h6>
                            </div>
                        </div>
                        <hr>
                        <p><?= $d->summary ?></p>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="<?= site_url('document/view/' . $d->id) ?>" class="btn btn-primary">Open</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>