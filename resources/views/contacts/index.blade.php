<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aplikasi CRUD Contact - Laravel 8 AJAX</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border: none;
            border-radius: 10px;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .table thead th {
            background-color: #667eea;
            color: white;
            border: none;
        }
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
        }
        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .action-buttons .btn {
            margin: 0 2px;
        }
        .pagination {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner">
            <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-address-book"></i> Manajemen Data Kontak</h3>
                    <button type="button" class="btn btn-light" id="btnAddContact">
                        <i class="fas fa-plus"></i> Tambah Kontaknya
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="contactsTable">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Nama</th>
                                <th width="12%">Tanggal Lahir</th>
                                <th width="12%">Telepon</th>
                                <th width="18%">Email</th>
                                <th width="23%">Alamat</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="contactsTableBody">
                            <!-- Data will be loaded via AJAX -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center">
                    <div id="paginationInfo"></div>
                    <nav>
                        <ul class="pagination" id="paginationLinks"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Kontak</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="contactForm">
                    <input type="hidden" id="contactId" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap">
                            <div class="invalid-feedback" id="error-name"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                            <div class="invalid-feedback" id="error-date_of_birth"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Contoh: 081234567890">
                            <div class="invalid-feedback" id="error-phone"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Contoh: email@domain.com">
                            <div class="invalid-feedback" id="error-email"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                            <div class="invalid-feedback" id="error-address"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary" id="btnSave">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            // Setup AJAX CSRF Token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let currentPage = 1;
            let isEditMode = false;

            // Load contacts on page load
            loadContacts();

            // Add contact button click
            $('#btnAddContact').click(function() {
                isEditMode = false;
                $('#modalTitle').text('Tambah Kontak');
                $('#contactForm')[0].reset();
                $('#contactId').val('');
                clearErrors();
                $('#contactModal').modal('show');
            });

            // Form submit
            $('#contactForm').submit(function(e) {
                e.preventDefault();
                
                const formData = {
                    name: $('#name').val(),
                    date_of_birth: $('#date_of_birth').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val(),
                    address: $('#address').val()
                };

                clearErrors();
                showLoading();

                if (isEditMode) {
                    updateContact($('#contactId').val(), formData);
                } else {
                    createContact(formData);
                }
            });

            // Load contacts function
            function loadContacts(page = 1, showLoadingOverlay = true) {
                if (showLoadingOverlay) {
                    showLoading();
                }
                
                $.ajax({
                    url: '{{ route("contacts.index") }}?page=' + page,
                    type: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        if (showLoadingOverlay) {
                            hideLoading();
                        }
                        if (response.success) {
                            displayContacts(response.data);
                            currentPage = page;
                        }
                    },
                    error: function(xhr) {
                        if (showLoadingOverlay) {
                            hideLoading();
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data kontak',
                            confirmButtonColor: '#667eea'
                        });
                    }
                });
            }

            // Display contacts in table
            function displayContacts(data) {
                const tbody = $('#contactsTableBody');
                tbody.empty();

                if (data.data.length === 0) {
                    tbody.append(`
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data kontak</td>
                        </tr>
                    `);
                } else {
                    let startNumber = (data.current_page - 1) * data.per_page;
                    
                    $.each(data.data, function(index, contact) {
                        const row = `
                            <tr>
                                <td>${startNumber + index + 1}</td>
                                <td>${contact.name}</td>
                                <td>${formatDate(contact.date_of_birth)}</td>
                                <td>${contact.phone}</td>
                                <td>${contact.email}</td>
                                <td>${contact.address}</td>
                                <td class="text-center action-buttons">
                                    <button class="btn btn-sm btn-warning btn-edit" data-id="${contact.id}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="${contact.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                }

                // Display pagination
                displayPagination(data);
            }

            // Display pagination
            function displayPagination(data) {
                const paginationInfo = $('#paginationInfo');
                const paginationLinks = $('#paginationLinks');
                
                // Info
                paginationInfo.html(`
                    Menampilkan ${data.from || 0} sampai ${data.to || 0} dari ${data.total} data
                `);

                // Links
                paginationLinks.empty();

                if (data.last_page > 1) {
                    // Previous button
                    paginationLinks.append(`
                        <li class="page-item ${data.current_page === 1 ? 'disabled' : ''}">
                            <a class="page-link" href="#" data-page="${data.current_page - 1}">Previous</a>
                        </li>
                    `);

                    // Page numbers
                    for (let i = 1; i <= data.last_page; i++) {
                        paginationLinks.append(`
                            <li class="page-item ${data.current_page === i ? 'active' : ''}">
                                <a class="page-link" href="#" data-page="${i}">${i}</a>
                            </li>
                        `);
                    }

                    // Next button
                    paginationLinks.append(`
                        <li class="page-item ${data.current_page === data.last_page ? 'disabled' : ''}">
                            <a class="page-link" href="#" data-page="${data.current_page + 1}">Next</a>
                        </li>
                    `);
                }
            }

            // Pagination click event
            $(document).on('click', '.page-link', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                if (page) {
                    loadContacts(page);
                }
            });

            // Create contact
            function createContact(data) {
                $.ajax({
                    url: '{{ route("contacts.store") }}',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        hideLoading();
                        if (response.success) {
                            $('#contactModal').modal('hide');
                            // Tampilkan toast notification
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data kontak berhasil ditambahkan',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                            loadContacts(currentPage, false);
                        }
                    },
                    error: function(xhr) {
                        hideLoading();
                        if (xhr.status === 422) {
                            displayErrors(xhr.responseJSON.errors);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menyimpan data',
                                confirmButtonColor: '#667eea'
                            });
                        }
                    }
                });
            }

            // Edit contact button click
            $(document).on('click', '.btn-edit', function() {
                const id = $(this).data('id');
                isEditMode = true;
                $('#modalTitle').text('Edit Kontak');
                clearErrors();
                showLoading();

                $.ajax({
                    url: '/contacts/' + id + '/edit',
                    type: 'GET',
                    success: function(response) {
                        hideLoading();
                        if (response.success) {
                            const contact = response.data;
                            $('#contactId').val(contact.id);
                            $('#name').val(contact.name);
                            $('#date_of_birth').val(contact.date_of_birth);
                            $('#phone').val(contact.phone);
                            $('#email').val(contact.email);
                            $('#address').val(contact.address);
                            $('#contactModal').modal('show');
                        }
                    },
                    error: function(xhr) {
                        hideLoading();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data kontak',
                            confirmButtonColor: '#667eea'
                        });
                    }
                });
            });

            // Update contact
            function updateContact(id, data) {
                $.ajax({
                    url: '/contacts/' + id,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        hideLoading();
                        if (response.success) {
                            $('#contactModal').modal('hide');
                            // Tampilkan toast notification
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data kontak berhasil diupdate',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                            loadContacts(currentPage, false);
                        }
                    },
                    error: function(xhr) {
                        hideLoading();
                        if (xhr.status === 422) {
                            displayErrors(xhr.responseJSON.errors);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat mengupdate data',
                                confirmButtonColor: '#667eea'
                            });
                        }
                    }
                });
            }

            // Delete contact button click
            $(document).on('click', '.btn-delete', function() {
                const id = $(this).data('id');
                
                // Tampilkan konfirmasi SweetAlert sebelum menghapus
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteContact(id);
                    }
                });
            });

            // Delete contact
            function deleteContact(id) {
                showLoading();
                
                $.ajax({
                    url: '/contacts/' + id,
                    type: 'DELETE',
                    success: function(response) {
                        hideLoading();
                        if (response.success) {
                            // Tampilkan toast notification
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data kontak berhasil dihapus',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                            loadContacts(currentPage, false);
                        }
                    },
                    error: function(xhr) {
                        hideLoading();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal menghapus data kontak',
                            confirmButtonColor: '#667eea'
                        });
                    }
                });
            }

            // Display validation errors
            function displayErrors(errors) {
                $.each(errors, function(field, messages) {
                    const input = $('#' + field);
                    input.addClass('is-invalid');
                    $('#error-' + field).text(messages[0]);
                });
            }

            // Clear validation errors
            function clearErrors() {
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').text('');
            }

            // Format date
            function formatDate(dateString) {
                const date = new Date(dateString);
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

            // Show loading
            function showLoading() {
                $('#loadingOverlay').fadeIn();
            }

            // Hide loading
            function hideLoading() {
                $('#loadingOverlay').fadeOut();
            }
        });
    </script>
</body>
</html>
