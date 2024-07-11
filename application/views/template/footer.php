  <!-- footer @s -->
  <div class="nk-footer">
      <div class="container-fluid">
          <div class="nk-footer-wrap">
              <div class="nk-footer-copyright"> &copy; 2024 MCI Repository Portal
              </div>
              <div class="nk-footer-links">
                  <ul class="nav nav-sm">
                      <li class="nav-item">
                          <a href="javascript:void(0)" class="nav-link text-muted"><span class="ms-1">Advance Analytics and Growth Marketing</span></a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
  <!-- footer @e -->
  </div>
  <!-- wrap @e -->
  </div>
  <!-- main @e -->
  </div>
  <!-- app-root @e -->

  <!-- JavaScript -->
  <script src="<?= base_url('assets') ?>/js/bundle.js?ver=3.0.0"></script>
  <script src="<?= base_url('assets') ?>/js/scripts.js?ver=3.0.0"></script>
  <script src="<?= base_url('assets') ?>/js/apps/file-manager.js?ver=3.0.0"></script>
  <link rel="stylesheet" href="<?= base_url('assets') ?>/css/editors/tinymce.css?ver=3.0.0">
  <script src="<?= base_url('assets') ?>/js/libs/editors/tinymce.js?ver=3.0.0"></script>
  <script src="<?= base_url('assets') ?>/js/editors.js?ver=3.0.0"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


  <script>
      $(document).ready(function() {
          $("#default-03").autocomplete({
              source: "<?= site_url('document/search_documents') ?>",
              minLength: 2,
              select: function(event, ui) {
                  // Set input field value to the label of the selected item
                  $('#default-03').val(ui.item.label);
                  // Optionally, you can do something with the selected document_id
                  console.log("Selected Document ID: " + ui.item.value);
                  // Prevent the widget from updating the input with the value
                  return false;
              }
          });
      });
  </script>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          var modalTriggers = document.querySelectorAll('.nk-file-icon-link img');

          modalTriggers.forEach(function(modalTrigger) {
              // Mengambil ID modal dari atribut data-bs-target pada img
              var targetId = modalTrigger.getAttribute('data-bs-target');
              var modalElement = document.querySelector(targetId);
              var modalInstance = new bootstrap.Modal(modalElement);

              modalTrigger.addEventListener('mouseover', function() {
                  modalInstance.show();
              });

              modalElement.addEventListener('mouseout', function(event) {
                  // Pastikan mouseout terjadi di luar modal content
                  if (!modalElement.contains(event.relatedTarget)) {
                      modalInstance.hide();
                  }
              });
          });
      });
  </script>

  <!-- alert -->
  <script>
      window.onload = function() {
          <?php if ($this->session->flashdata('success')) : ?>
              Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Success!',
                  text: '<?= $this->session->flashdata('success'); ?>',
                  timer: 3000,
                  timerProgressBar: true,
                  showConfirmButton: false,
                  toast: true
              });
          <?php endif; ?>

          <?php if ($this->session->flashdata('error')) : ?>
              Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'Oops...',
                  text: '<?= $this->session->flashdata('error'); ?>',
                  timer: 3000,
                  timerProgressBar: true,
                  showConfirmButton: false,
                  toast: true
              });
          <?php endif; ?>

          <?php if ($this->session->flashdata('failed')) : ?>
              Swal.fire({
                  position: 'top-end',
                  icon: 'info',
                  title: 'Oops...',
                  text: '<?= $this->session->flashdata('failed'); ?>',
                  timer: 3000,
                  timerProgressBar: true,
                  showConfirmButton: false,
                  toast: true
              });
          <?php endif; ?>
      }
  </script>

  <!-- Filter data -->
  <!-- <script>
      $(document).ready(function() {
          function filterDocuments() {
              var keyword = $('#keyword').val();
              var type_id = $('#type_id').val();

              console.log("Filter triggered");
              console.log("Keyword: " + keyword);
              console.log("Category ID: " + type_id);

              $.ajax({
                  url: '<?= site_url("document/search_documents") ?>',
                  method: 'POST',
                  data: {
                      keyword: keyword,
                      type_id: type_id
                  },
                  success: function(response) {
                      console.log("Response received");
                      console.log(response);

                      var documents = JSON.parse(response);
                      var documentHtml = '';

                      if (documents.length > 0) {
                          var groupedDocuments = {};

                          // Group documents by type_id
                          documents.forEach(function(document) {
                              if (!groupedDocuments[document.type_id]) {
                                  groupedDocuments[document.type_id] = [];
                              }
                              groupedDocuments[document.type_id].push(document);
                          });

                          for (var type_id in groupedDocuments) {
                              var filtered_documents = groupedDocuments[type_id];
                              var type_name = filtered_documents[0].work_type; // Assuming each group has the same work_type

                              documentHtml += `
                            <div class="row mb-4">
                                <div class="col mt-3">
                                    <h4>Search Result</h4>
                                </div>
                            </div>
                            <div class="row overflow-auto" style="max-height: 400px;">`;

                              filtered_documents.forEach(function(document) {
                                  var uploadDate = new Date(document.upload_date);
                                  var formattedDate = uploadDate.toLocaleDateString('en-US', {
                                      day: 'numeric',
                                      month: 'long',
                                      year: 'numeric'
                                  });

                                  var thumbnailHtml = document.thumbnail ? `
                                <img src="<?= base_url('uploads/thumbnail/') ?>${document.thumbnail}" class="card-img-top" alt="Thumbnail" data-bs-toggle="modal" data-bs-target="#modalZoom${document.document_id}" style="max-height: 200px; object-fit: cover;">` : `
                                <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                                    <img src="<?= base_url('assets/images/pdf.png') ?>" class="card-img-top" alt="Thumbnail" data-bs-toggle="modal" data-bs-target="#modalZoom${document.document_id}" style="max-width: 80%; max-height: 80%; object-fit: contain;">
                                </div>`;

                                  documentHtml += `
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        ${thumbnailHtml}
                                        <div class="card-body" style="height: 70px;">
                                            <span>${document.name}</span>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">${formattedDate}</small>
                                        </div>
                                    </div>
                                </div>`;

                                  // Modal for each document
                                  documentHtml += `
                                <div class="modal fade zoom" tabindex="-1" id="modalZoom${document.document_id}">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">${document.name}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6><small><i><b>${type_name}</b></i></small></h6>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6><small><i><b><em class="icon ni ni-clock"></em> Upload time : ${formattedDate}</b></i></small></h6>
                                                    </div>
                                                </div>
                                                <hr>
                                                <p>${document.summary}</p>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="<?= site_url('document/view/') ?>${document.document_id}" class="btn btn-primary">Open</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                              });

                              documentHtml += `</div>`;
                          }
                      } else {
                          documentHtml = '<p>No documents found</p>';
                      }

                      $('#document-container').html(documentHtml);
                  },
                  error: function(xhr, status, error) {
                      console.error("Error occurred: " + status + " " + error);
                  }
              });
          }

          $('#keyword').on('input', filterDocuments);
          $('#type_id').on('change', filterDocuments);

          // Add event listener to clear keyword and refresh page
          $('#keyword').on('keyup', function(event) {
              if (event.key === 'Backspace' || event.key === 'Delete') {
                  if ($('#keyword').val().length === 0) {
                      location.reload();
                  }
              }
          });
      });
  </script> -->

  <script>
      $(document).ready(function() {
          function filterDocuments() {
              var keyword = $('#keyword').val();
              var type_id = $('#type_id').val();

              console.log("Filter triggered");
              console.log("Keyword: " + keyword);
              console.log("Category ID: " + type_id);

              $.ajax({
                  url: '<?= site_url("document/search_documents") ?>',
                  method: 'POST',
                  data: {
                      keyword: keyword,
                      type_id: type_id
                  },
                  success: function(response) {
                      console.log("Response received");
                      console.log(response);

                      var documents = JSON.parse(response);
                      var documentHtml = '';

                      if (documents.length > 0) {
                          var groupedDocuments = {};

                          // Group documents by type_id
                          documents.forEach(function(document) {
                              if (!groupedDocuments[document.work_type]) {
                                  groupedDocuments[document.work_type] = [];
                              }
                              groupedDocuments[document.work_type].push(document);
                          });

                          for (var type_id in groupedDocuments) {
                              var filtered_documents = groupedDocuments[type_id];
                              var type_name = filtered_documents[0].work_type; // Assuming each group has the same work_type

                              documentHtml += `
                            <div class="row mb-4">
                                <div class="col mt-3">
                                    <h4>Search Result</h4>
                                </div>
                            </div>
                            <div class="row overflow-auto" style="max-height: 400px;">`;

                              filtered_documents.forEach(function(document) {
                                  var uploadDate = new Date(document.upload_date);
                                  var formattedDate = uploadDate.toLocaleDateString('en-US', {
                                      day: 'numeric',
                                      month: 'long',
                                      year: 'numeric'
                                  });

                                  var thumbnailHtml = document.thumbnail ? `
                                <img src="<?= base_url('uploads/thumbnail/') ?>${document.thumbnail}" class="card-img-top" alt="Thumbnail" data-bs-toggle="modal" data-bs-target="#modalZoom${document.document_id}" style="max-height: 200px; object-fit: cover;">` : `
                                <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                                    <img src="<?= base_url('assets/images/pdf.png') ?>" class="card-img-top" alt="Thumbnail" data-bs-toggle="modal" data-bs-target="#modalZoom${document.document_id}" style="max-width: 80%; max-height: 80%; object-fit: contain;">
                                </div>`;

                                  documentHtml += `
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        ${thumbnailHtml}
                                        <div class="card-body" style="height: 70px;">
                                            <span>${document.name}</span>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">${formattedDate}</small>
                                        </div>
                                    </div>
                                </div>`;

                                  // Modal for each document
                                  documentHtml += `
                                <div class="modal fade zoom" tabindex="-1" id="modalZoom${document.document_id}">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">${document.name}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6><small><i><b>${type_name}</b></i></small></h6>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6><small><i><b><em class="icon ni ni-clock"></em> Upload time : ${formattedDate}</b></i></small></h6>
                                                    </div>
                                                </div>
                                                <hr>
                                                <p>${document.summary}</p>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="<?= site_url('document/view/') ?>${document.document_id}" class="btn btn-primary">Open</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                              });

                              documentHtml += `</div>`;
                          }
                      } else {
                          documentHtml = '<p>No documents found</p>';
                      }

                      $('#document-container').html(documentHtml);
                  },
                  error: function(xhr, status, error) {
                      console.error("Error occurred: " + status + " " + error);
                  }
              });
          }

          $('#keyword').on('input', filterDocuments);
          $('#type_id').on('change', filterDocuments);

          // Add event listener to clear keyword and refresh page
          $('#keyword').on('keyup', function(event) {
              if (event.key === 'Backspace' || event.key === 'Delete') {
                  if ($('#keyword').val().length === 0) {
                      location.reload();
                  }
              }
          });
      });
  </script>


  <!-- List data table -->
  <script>
      document.addEventListener("DOMContentLoaded", function() {
          var listDataLinks = document.querySelectorAll('#document-container a');

          listDataLinks.forEach(function(link) {
              link.addEventListener('click', function() {
                  var typeName = link.getAttribute('data-type-name').trim();

                  var xhr = new XMLHttpRequest();
                  xhr.open('GET', '<?php echo base_url("document/get_documents"); ?>', true);

                  xhr.onload = function() {
                      if (xhr.status == 200) {
                          var data = JSON.parse(xhr.responseText);
                          var tableBody = document.querySelector('#table-data tbody');
                          tableBody.innerHTML = ''; // Kosongkan isi tbody sebelum memasukkan data baru

                          // Filter dokumen sesuai dengan typeName yang diklik
                          var filteredDocuments = data.documents.filter(function(doc) {
                              return doc.type_name === typeName;
                          });

                          // Format data untuk DataTable
                          var formattedData = filteredDocuments.map(function(doc, index) {
                              var uploadDate = new Date(doc.upload_date);
                              var formattedDate = ('0' + uploadDate.getDate()).slice(-2) + '/' + ('0' + (uploadDate.getMonth() + 1)).slice(-2) + '/' + uploadDate.getFullYear().toString().slice(-2);

                              return [
                                  (index + 1) + '.', // No
                                  '<a href="' + '<?php echo site_url("view-document/") ?>' + doc.id + '" target="_blank" class="text-dark"><b>' + doc.name + '</b></a>', // Name with href
                                  formattedDate, // Upload Date
                                  '<div class="card">' +
                                  '<div class="card-body">' +
                                  '<p class="mb-2"><strong>Description:</strong><br> ' + doc.description + '</p>' +
                                  '<hr>' +
                                  '<p><strong>Summary:</strong> ' + doc.summary + '</p>' +
                                  '</div>' +
                                  '</div>', // Card for Description and Summary
                                  doc.type_name // Type Name (untuk filter, tidak ditampilkan)
                              ];

                          });

                          // Tampilkan tabel setelah diisi dengan data baru dengan efek slide down
                          $('#table-data').slideDown(function() {
                              // Setelah slide down selesai, inisialisasi DataTable jika belum ada
                              var dataTable;
                              if (!$.fn.DataTable.isDataTable('#table-data table')) {
                                  dataTable = $('#table-data table').DataTable({
                                      "paging": true, // Aktifkan paging
                                      "lengthMenu": [10, 50, 100], // Pilihan jumlah data per halaman
                                      "pageLength": 10, // Jumlah data per halaman awal
                                      "searching": true, // Aktifkan fitur pencarian
                                      "order": [], // Nonaktifkan pengurutan default
                                      "columnDefs": [{
                                          "visible": false,
                                          "targets": [5] // Hide the type_name column
                                      }]
                                  });
                              } else {
                                  dataTable = $('#table-data table').DataTable();
                                  dataTable.clear(); // Kosongkan tabel sebelum diisi ulang
                              }
                              dataTable.rows.add(formattedData).draw(); // Tambahkan data baru ke tabel
                          });

                          // Tambahkan tombol "Hide Table" jika belum ada
                          if (!document.getElementById('hide-table-button')) {
                              var hideTableButton = document.createElement('button');
                              hideTableButton.textContent = 'Hide Table';
                              hideTableButton.id = 'hide-table-button';
                              hideTableButton.classList.add('btn', 'btn-secondary', 'mt-3');
                              hideTableButton.addEventListener('click', function() {
                                  $('#table-data').slideUp();
                                  hideTableButton.remove(); // Hapus tombol setelah tabel disembunyikan
                              });

                              // Masukkan tombol ke dalam div di atas tabel
                              document.getElementById('table-data').parentElement.insertBefore(hideTableButton, document.getElementById('table-data'));
                          }

                          // Arahkan scroll ke tabel
                          document.getElementById('table-data').scrollIntoView({
                              behavior: 'smooth',
                              block: 'start'
                          });

                          // Pencarian yang terbatas pada jenis yang dipilih
                          var dataTable = $('#table-data table').DataTable();
                          $('#table-data input[type="search"]').off('keyup').on('keyup', function() {
                              dataTable.search(typeName + ' ' + this.value).draw();
                          });
                      }
                  };

                  xhr.send();
              });
          });
      });
  </script>


  <!-- waktu notifikasi -->
  <script>
      function timeDifference(current, previous) {
          const msPerMinute = 60 * 1000;
          const msPerHour = msPerMinute * 60;
          const msPerDay = msPerHour * 24;
          const msPerMonth = msPerDay * 30;
          const msPerYear = msPerDay * 365;

          const elapsed = current - previous;

          if (elapsed < msPerMinute) {
              return 'just now';
          } else if (elapsed < msPerHour) {
              return Math.round(elapsed / msPerMinute) + ' mins ago';
          } else if (elapsed < msPerDay) {
              return Math.round(elapsed / msPerHour) + ' hrs ago';
          } else if (elapsed < msPerMonth) {
              return Math.round(elapsed / msPerDay) + ' days ago';
          } else if (elapsed < msPerYear) {
              return Math.round(elapsed / msPerMonth) + ' months ago';
          } else {
              return Math.round(elapsed / msPerYear) + ' years ago';
          }
      }

      function updateNotificationTimes() {
          var elements = document.querySelectorAll('.nk-notification-time');
          var now = new Date();

          elements.forEach(function(element) {
              var uploadTime = new Date(element.getAttribute('data-upload-time'));
              var diffText = timeDifference(now, uploadTime);
              element.textContent = diffText;
          });
      }

      // Mengirim permintaan AJAX untuk menandai notifikasi sebagai sudah dibaca
      function markAsRead(logId) {
          $.ajax({
              type: 'POST',
              url: '<?php echo base_url("home/readnotif"); ?>',
              data: {
                  log_id: logId
              },
              dataType: 'json',
              success: function(response) {
                  if (response.status === 'success') {
                      // Ubah tampilan notifikasi menjadi 'read'
                      var notification = document.querySelector('.nk-notification[data-log-id="' + logId + '"]');
                      notification.classList.remove('unread');
                      notification.classList.add('read');
                  } else {
                      console.error('Failed to mark notification as read.');
                  }
              },
              error: function(xhr, status, error) {
                  console.error('AJAX request failed:', error);
              }
          });
      }

      // Perbarui waktu setiap 1 menit (60000 ms)
      setInterval(updateNotificationTimes, 60000);

      // Perbarui waktu saat halaman dimuat pertama kali
      updateNotificationTimes();

      // Tambahkan event listener untuk menandai notifikasi sebagai sudah dibaca saat diklik
      document.querySelectorAll('.nk-notification').forEach(function(notification) {
          notification.addEventListener('click', function() {
              var logId = this.getAttribute('data-log-id');
              markAsRead(logId);
          });
      });
  </script>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          document.getElementById('download-button').addEventListener('click', function(event) {
              event.preventDefault(); // Prevent default action (redirect)

              // Get document_id from PHP variable
              var document_id = <?= $document->id ?>;

              // Get user_id from session or input (replace with actual method to retrieve user_id)
              var user_id = <?= $this->session->userdata('id') ?>; // Example, replace with actual method

              // Get IP address using input->ip_address() (optional)
              var ip_address = '<?= $this->input->ip_address() ?>'; // Example, replace with actual IP address retrieval if needed

              // Send log request to server
              fetch('<?= base_url('document/log_download_view') ?>', {
                      method: 'POST',
                      headers: {
                          'Content-Type': 'application/json'
                      },
                      body: JSON.stringify({
                          user_id: user_id,
                          document_id: document_id,
                          ip_address: ip_address
                      })
                  })
                  .then(response => {
                      if (!response.ok) {
                          throw new Error('Network response was not ok');
                      }
                      // If logging is successful, initiate file download
                      return fetch('<?= base_url('uploads/' . $document->file) ?>');
                  })
                  .then(response => {
                      return response.blob();
                  })
                  .then(blob => {
                      // Create a new anchor element and set its href attribute to the blob URL
                      var a = document.createElement('a');
                      var url = window.URL.createObjectURL(blob);
                      a.href = url;
                      a.download = '<?= $document->file ?>'; // Set the filename for download
                      document.body.appendChild(a);
                      a.click();
                      document.body.removeChild(a);
                      window.URL.revokeObjectURL(url);
                      console.log('File downloaded successfully');
                  })
                  .catch(error => {
                      console.error('Error downloading file:', error);
                      // Handle error (if needed)
                  });
          });
      });
  </script>


  <script>
      document.addEventListener('DOMContentLoaded', function() {
          var fullScreenButton = document.getElementById('fullScreen');
          var printButton = document.getElementById('print');
          var pdfIframe = document.getElementById('pdf-iframe');

          fullScreenButton.addEventListener('click', function(event) {
              event.preventDefault();
              toggleFullScreen(pdfIframe);
          });

          printButton.addEventListener('click', function(event) {
              event.preventDefault();
              printPDF(pdfIframe);
          });

          function toggleFullScreen(element) {
              if (!document.fullscreenElement && // alternative standard method
                  !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) { // current working methods
                  if (element.requestFullscreen) {
                      element.requestFullscreen();
                  } else if (element.msRequestFullscreen) {
                      element.msRequestFullscreen();
                  } else if (element.mozRequestFullScreen) {
                      element.mozRequestFullScreen();
                  } else if (element.webkitRequestFullscreen) {
                      element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                  }
              } else {
                  if (document.exitFullscreen) {
                      document.exitFullscreen();
                  } else if (document.msExitFullscreen) {
                      document.msExitFullscreen();
                  } else if (document.mozCancelFullScreen) {
                      document.mozCancelFullScreen();
                  } else if (document.webkitExitFullscreen) {
                      document.webkitExitFullscreen();
                  }
              }
          }

          function printPDF(element) {
              if (element.contentWindow) {
                  element.contentWindow.print();
              } else {
                  console.error('Cannot print iframe content');
              }
          }
      });
  </script>

  <script>
      $(document).ready(function() {
          $('.download-link').click(function(e) {
              e.preventDefault();

              var userId = $(this).data('user-id');
              var documentId = $(this).data('document-id');
              var ipAddress = '<?= $this->input->ip_address() ?>'; // Mengambil alamat IP pengguna

              var downloadUrl = $(this).attr('href'); // URL file yang akan diunduh

              // Kirim AJAX request untuk menyimpan log download
              $.ajax({
                  type: 'POST',
                  url: '<?= site_url('document/log') ?>', // Endpoint untuk menyimpan log download, sesuaikan dengan struktur aplikasi Anda
                  data: {
                      user_id: userId,
                      document_id: documentId,
                      ip_address: ipAddress
                  },
                  success: function(response) {
                      // Handle success if needed
                      console.log('Download logged successfully.');

                      // Untuk mengunduh file secara langsung oleh browser
                      var link = document.createElement('a');
                      link.href = downloadUrl;
                      link.download = ''; // Nama file akan menggunakan nama asli dari URL

                      document.body.appendChild(link);
                      link.click();
                      document.body.removeChild(link);
                  },
                  error: function(xhr, status, error) {
                      // Handle error
                      console.error('Error logging download:', error);

                      // Jika terjadi kesalahan, lanjutkan mengarahkan pengguna ke file yang diunduh
                      window.location.href = downloadUrl;
                  }
              });
          });
      });
  </script>


  </body>

  </html>