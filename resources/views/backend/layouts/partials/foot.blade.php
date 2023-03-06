<!-- JAVASCRIPT -->
<script src="{{ asset('backend/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/libs/node-waves/waves.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- Jquery Confirm -->
<script src="{{ asset('plugins/jquery-confirm/js/jquery-confirm.js') }}"></script>
<!-- DataTables  & Plugins -->
{{-- <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/datatables-buttons/js/buttons.flash.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/datatables-buttons/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/vfs_fonts.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/datatables-buttons/js/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/vfs_fonts.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script> --}}

{{-- Datatable --}}
<!-- Required datatable js -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
{{-- Datatable --}}

{{-- Input mask --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js" integrity="sha512-jTgBq4+dMYh73dquskmUFEgMY5mptcbqSw2rmhOZZSJjZbD2wMt0H5nhqWtleVkyBEjmzid5nyERPSNBafG4GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Custom File input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('js/datatables-checkboxes.js') }}"></script>
<!-- materialdesign icon js-->
{{-- <script src="{{ asset('backend/js/pages/materialdesign.init.js') }}"></script> --}}
{{-- Toastify CDN --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('backend/js/app.js') }}"></script>
<style>
    .btn-default{
        background-color: #bdbab3 !important;
    }
</style>
<script>

    //-- Loader 
    $(document).ready(function(){
        $('.loader').remove();
        $('#userTable').removeClass('d-none');
        $('#HistoryTable').removeClass('d-none');
        $('#departementTable').removeClass('d-none');
    })
    //-- End Loader

    //-- DataTables
    $(function () {
        bsCustomFileInput.init();
        //Initialize Select2 Elements
        $('.select2').select2()

        $("#userTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
        })

        $('#departementTable').DataTable({
            "paging":   true,
            "ordering": true,
            "info":     true,
            // "dom": '<"top">rt<"bottom"flp i><"clear">'
        });
        
        $('#HistoryTable').DataTable({
            "paging":   true,
            "ordering": true,
            "info":     true
        });
    })
    //-- End DataTables

   $("#checkbox").click(function () {
       if ($("#checkbox").is(':checked')) {
           $("#e1 > option").prop("selected", "selected");
           $("#e1").trigger("change");
       } else {
           $("#e1 > option").removeAttr("selected");
           $("#e1").val("");
           $("#e1").trigger("change");
       }
   });

   function detailModal(title, url, width) {
        $.confirm({
            title: title,
            theme : 'material',
            backgroundDismiss: true, // this will just close the modal
            content: 'URL:'+url,
            animation: 'zoom',
            closeAnimation: 'scale',
            animationSpeed: 400,
            closeIcon: true,
            columnClass: width,
            buttons: {
                close: {
                    btnClass: 'btn-dark font-bold',                    
                }
            },
        });
    }

    function modalDelete(title, name, url, link) {
        $.confirm({ 
            title: `Delete ${title}?`,
            content: `Are you sure want to delete ${name}`,
            autoClose: 'cancel|8000',
            cancelButtonClass: 'btn-danger',
            
            buttons: {
                delete: {
                    text: 'delete',
                    btnClass: 'btn-danger',
                    
                    action: function () {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "_method": 'delete',
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function (data) {
                                window.location.href = link
                            },
                            error: function (data) {
                                $.alert('Failed!');
                                console.log(data);
                            }
                        });
                    }
                },
                cancel: function () {
                    
                }
            }
        });        
    }

    // function modalDelete(val,num)
    // {
    //     Swal.fire({
    //         title: `Delete ${title}?`,
    //         text: `Do you want to delete ${name}`,
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#d33',
    //         cancelButtonColor: 'grey',
    //         confirmButtonText: 'Yes, delete it!',
    //         action: function () {
    //                     $.ajax({
    //                         type: 'POST',
    //                         url: url,
    //                         dataType: 'json',
    //                         headers: {
    //                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                         },
    //                         data: {
    //                             "_method": 'delete',
    //                             "_token": "{{ csrf_token() }}"
    //                         },
    //                         success: function (data) {
    //                             window.location.href = link
    //                         },
    //                         error: function (data) {
    //                             $.alert('Failed!');
    //                             console.log(data);
    //                         }
    //                     });
    //                 }
            
    //     }).then((result) => {
    //         if (result.isConfirmed) {
                
    //             $(val).parent().parent().remove();
    //         }
    //         })
    // }

    function logout() {
        $.confirm({
            icon: 'fas fa-sign-out-alt',
            title: 'Logout',
            theme: 'supervan',
            content: 'Are you sure want to logout?',
            autoClose: 'cancel|8000',
            buttons: {
                logout: {
                    text: 'logout',
                    btnClass: 'btn-danger',
                    
                    action: function () {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('logout') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function (data) {
                                location.reload();
                            },
                            error: function (data) {
                                $.alert('Failed!');
                                console.log(data);
                            }
                        });
                    }
                },
                cancel: function () {
                    
                }
            }
        });
    }
</script>
{{-- <script type="text/javascript">

    $(document).ready(function () {
     
    window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
            $(this).remove(); 
        });
    }, 10022220);
     
    });
</script> --}}
@if(session()->has('success'))
    <script>
            Toastify({
                text: "{{ session()->get('success') }}",
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "#D5F3E9",
                    color: "#1f7556"
                },
                duration: 3000
            }).showToast();
    </script>
@endif

@if(session()->has('warning'))
<script>
        Toastify({
            text: "{{ session()->get('warning') }}",
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#FBEFDB",
                color: "#916c2e"
            },
            duration: 3000
        }).showToast();
</script>
@endif

@if(session()->has('failed'))
<script>
    Toastify({
        text: "{{ session()->get('failed') }}",
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "#fde1e1",
            color: "#924040"
        },
        duration: 3000
    }).showToast();
</script>
@endif
@stack('scripts')
@yield('script')