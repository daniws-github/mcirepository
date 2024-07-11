  <div class="nk-content ">
      <div class="container-fluid">
          <div class="nk-content-inner">
              <div class="nk-content-body">
                  <div class="components-preview wide-md mx-auto">
                      <div class="nk-block nk-block-lg">
                          <div class="nk-block-head">
                              <div class="nk-block-head-content">
                                  <h4 class="title nk-block-title">Uploads Document</h4>
                                  <div class="nk-block-des">
                                      <p>Type file document : docs, pdf, ppt and image</p>
                                  </div>
                              </div>
                          </div>
                          <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                  <div class="preview-block">
                                      <form action="<?= site_url('document/update_process') ?>" method="post" enctype="multipart/form-data">
                                          <input type="hidden" name="user_id" value="<?= $this->session->userdata('id') ?>">
                                          <input type="hidden" name="document_id" value="<?= $document->id ?>">
                                          <div class="row gy-4">
                                              <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label class="form-label" for="default-06">Document Name <span class="text-danger">*</span></label>
                                                      <div class="form-control-wrap">
                                                          <div class="form-file">
                                                              <input type="text" class="form-control" name="name" value="<?= $document->name ?>" autocomplete="off">
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label class="form-label" for="default-06">Keyword <span class="text-danger">*</span></label>
                                                      <div class="form-control-wrap">
                                                          <div class="form-file">
                                                              <input type="text" class="form-control" name="keyword" value="<?= $document->keyword ?>" autocomplete="off">
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label class="form-label" for="default-06">Browse File <span class="text-danger">*</span></label>
                                                      <div class="form-control-wrap">
                                                          <div class="form-file">
                                                              <input type="file" class="form-file-input" id="customFile" name="file">
                                                              <label class="form-file-label" for="customFile">Choose file</label>
                                                          </div>
                                                          <p>&nbsp;<span class="ml-2 text-muted"><small>Maximum file size allowed for upload : 5 MB</small></span></p>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label class="form-label" for="default-06">Upload Image <span class="text-danger">*</span></label>
                                                      <div class="form-control-wrap">
                                                          <div class="form-file">
                                                              <input type="file" class="form-file-input" name="thumbnail">
                                                              <label class="form-file-label">Choose file</label>
                                                          </div>
                                                          <p>&nbsp;<span class="ml-2 text-muted"><small>Maximum file size allowed for upload : 5 MB</small></span></p>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-sm-12">
                                                  <div class="form-group">
                                                      <div class="d-flex justify-content-between align-items-center">
                                                          <label class="form-label" for="default-textarea">Description</label>
                                                      </div>
                                                      <div class="form-control-wrap">
                                                          <input type="text" class="form-control" name="description" value="<?= $document->description ?>">
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-sm-12">
                                                  <div class="form-group">
                                                      <div class="d-flex justify-content-between align-items-center">
                                                          <label class="form-label" for="default-textarea">Summary</label>
                                                          <button type="button" class="btn btn-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalAlert2">Generate with AI</button>
                                                      </div>
                                                      <div class="form-control-wrap">
                                                          <textarea name="summary" class="tinymce-basic form-control"><?= $document->summary ?></textarea>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label class="form-label">Work Type <span class="text-danger">*</span></label>
                                                      <div class="form-control-wrap">
                                                          <select class="form-select js-select2" data-search="on" name="type_id">
                                                              <option hidden value="<?= $document->type_id ?>"><?= $document->type_name ?></option>
                                                              <?php foreach ($type as $t) : ?>
                                                                  <option value="<?= $t->id ?>"><?= $t->name ?></option>
                                                              <?php endforeach; ?>
                                                          </select>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="col-sm-6">
                                                  <div class="form-group">
                                                      <label class="form-label">Product <span class="text-danger">*</span></label>
                                                      <div class="form-control-wrap">
                                                          <select class="form-select js-select2" data-search="on" name="product_id">
                                                              <option hidden value="<?= $document->product_id ?>"><?= $document->product_name ?></option>
                                                              <?php foreach ($product as $p) : ?>
                                                                  <option value="<?= $p->id ?>"><?= $p->name ?></option>
                                                              <?php endforeach; ?>
                                                          </select>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <hr class="preview-hr">
                                          <button style="float: right;" class="btn btn-danger btn-sm">Submit</button>
                                      </form>
                                  </div>
                              </div>
                          </div><!-- .card-preview -->
                      </div><!-- .nk-block -->
                  </div><!-- .components-preview -->
              </div>
          </div>
      </div>
  </div>


  <!-- Modal Alert 2 -->
  <div class="modal fade" tabindex="-1" id="modalAlert2">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-body modal-body-lg text-center">
                  <div class="nk-modal">
                      <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                      <h4 class="nk-modal-title">Unable to Process!</h4>
                      <div class="nk-modal-text">
                          <p class="lead">We are sorry, this feature is not available yet. Please check back later.</p>
                          <p class="text-soft">We will notify you as soon as it becomes available.</p>
                      </div>
                      <div class="nk-modal-action mt-5">
                          <a href="#" class="btn btn-lg btn-mw btn-light" data-bs-dismiss="modal">Return</a>
                      </div>
                  </div>
              </div><!-- .modal-body -->
          </div>
      </div>
  </div>

  <!-- kode filter -->