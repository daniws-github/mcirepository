  <div class="nk-content ">
      <div class="container-fluid">
          <div class="nk-content-inner">
              <div class="nk-content-body">
                  <div class="nk-block-head nk-block-head-lg wide-sm">
                      <div class="nk-block-head-content">
                          <div class="nk-block-head-sub"><a class="back-to" href="<?= site_url('home') ?>"><em class="icon ni ni-arrow-left"></em><span>Back to home</span></a></div>
                      </div>
                  </div>
                  <div class="nk-block">
                      <div class="row g-gs">
                          <div class="col-xxl-6">
                              <a href="#" id="fullScreen" class="btn btn-light mb-2"><em class="icon ni ni-expand"></em></a>
                              <a id="download-button" href="<?= base_url('uploads/' . $document->file) ?>" class="btn btn-light mb-2" download>
                                  <em class="icon ni ni-download"></em>
                              </a>
                              <a href="#" id="print" class="btn btn-light mb-2"><em class="icon ni ni-printer"></em></a>

                              <div class="row g-gs">
                                  <div class="col-md-12" style="width: 100%; height: 100vh; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                      <iframe id="pdf-iframe" src="<?= base_url('uploads/' . $document->file) ?>#toolbar=0" style="width: 100%; height: 100%; border: none;" frameborder="0" allowfullscreen></iframe>
                                  </div>
                              </div><!-- .row -->
                          </div><!-- .col -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>