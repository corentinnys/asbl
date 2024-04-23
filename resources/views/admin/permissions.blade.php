@extends('admin.template')
@inject('roles',"App\Http\Controllers\Admin\\rolesHAsPermissionController")

@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-2">Permissions List</h4>

        <p class="mb-4">Each category (Basic, Professional, and Business) includes the four predefined roles shown below.</p>


        <!-- Permission Table -->
        <div class="card">
            <div class="card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row mx-1"><div class="col-sm-12 col-md-3">
                            <div class="dataTables_length" id="DataTables_Table_0_length">
                                <label>
                                    <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label></div></div><div class="col-sm-12 col-md-9"><div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"><div class="me-3"><div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search<input type="search" class="form-control" placeholder="Search.." aria-controls="DataTables_Table_0"></label></div></div><div class="dt-buttons btn-group flex-wrap"><button class="btn add-new btn-primary mb-3 mb-md-0" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#addPermissionModal"><span>Ajouter Permission</span></button> </div></div></div></div><table class="datatables-permissions table border-top dataTable no-footer dtr-column collapsed" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1215px;">
                        <thead>
                        <tr>
                            <th class="control sorting_disabled" rowspan="1" colspan="1" style="width: 0px;" aria-label=""></th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 261px;" aria-label="Name: activate to sort column ascending">Name</th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 413px;" aria-label="Assigned To">Assigned To</th><th class="sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 255px;" aria-label="Created Date">Created Date</th><th class="sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 124px;" aria-label="Actions">Actions</th></tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                        <tr class="odd">
                            <td class="control" tabindex="0" style=""></td>
                            <td>
                                <span class="text-nowrap">{{$permission->name}}</span>
                            </td>
                            <td>

                                <span class="text-nowrap">
                                     @foreach($roles->index($permission->id) as $role)
                                        @switch($role->name)
                                            @case("secretaire")
                                                <span class="badge bg-warning">{{$role->name}}</span>
                                                @break
                                            @case("admin")
                                                <span class="badge bg-primary">{{$role->name}}</span>
                                                @break
                                            @case("tresorier")
                                                <span class="badge bg-danger">{{$role->name}}</span>
                                                @break
                                        @endswitch

                                    @endforeach

                               {{-- <a href="app-user-list.html">
                                    <span class="badge bg-label-primary m-1">Administrator</span>
                                </a>--}}
                                </span>
                            </td>
                            <td class="dtr-hidden" >
                                <span class="text-nowrap">14 Apr 2021, 8:43 PM</span>
                            </td>
                            <td class="" style="">
                                <span class="text-nowrap" data-id="{{$permission->id}}">
                                    <button class="btn btn-sm btn-icon me-2 btn-update" data-bs-target="#editPermissionModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="bx bx-edit"></i></button>
                                    <button class="btn btn-sm btn-icon delete-record">
                                        <i class="bx bx-trash"></i>
                                    </button></span></td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table><div class="row mx-2"><div class="col-sm-12 col-md-6"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 9 of 9 entries</div></div><div class="col-sm-12 col-md-6"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="DataTables_Table_0_next"><a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="next" tabindex="-1" class="page-link">Next</a></li></ul></div></div></div></div>
            </div>
        </div>
        <!--/ Permission Table -->


        <!-- Modal -->
        <!-- Add Permission Modal -->
        <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Ajouter une nouvelle permission</h3>
                            <p>Permissions you may use and assign to your users.</p>
                        </div>
                        <form id="addPermissionForm" class="row fv-plugins-bootstrap5 fv-plugins-framework" onsubmit="return false" novalidate="novalidate">
                            <div class="col-12 mb-3 fv-plugins-icon-container">
                                <label class="form-label" for="modalPermissionName">Permission Name</label>
                                <input type="text" id="modalPermissionName" name="modalPermissionName" class="form-control" placeholder="Permission Name" autofocus="">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <div class="col-12 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="corePermission">
                                    <label class="form-check-label" for="corePermission">
                                        Set as core permission
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 text-center demo-vertical-spacing">
                                <button type="submit" id="createPermission" class="btn btn-primary me-sm-3 me-1">Creer Permission</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                            </div>
                            <input type="hidden"></form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Permission Modal -->

        <!-- Edit Permission Modal -->
        <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Edit Permission</h3>
                            <p>Edit permission as per your requirements.</p>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            <h6 class="alert-heading mb-2">Warning</h6>
                            <p class="mb-0">By editing the permission name, you might break the system permissions functionality. Please ensure you're absolutely certain before proceeding.</p>
                        </div>
                        <form id="editPermissionForm" class="row fv-plugins-bootstrap5 fv-plugins-framework" onsubmit="return false" novalidate="novalidate">
                            <div class="col-sm-9 fv-plugins-icon-container">
                                <label class="form-label" for="editPermissionName">Permission Name</label>
                                <input type="text" id="editPermissionName" name="editPermissionName" class="form-control" placeholder="Permission Name" tabindex="-1">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <div class="col-sm-3 mb-3">
                                <label class="form-label invisible d-none d-sm-inline-block">Button</label>
                                <button type="submit" class="btn btn-primary mt-1 mt-sm-0 update" >Update</button>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editCorePermission">
                                    <label class="form-check-label" for="editCorePermission">
                                        Set as core permission
                                    </label>
                                </div>
                            </div>
                            <input type="hidden"></form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit Permission Modal -->

        <!-- /Modal -->
    </div>

    <script>
        $('#createPermission').click((e)=> {
            let valeur = $('#modalPermissionName').val()
            $.ajax({
                url: "{{route('createPermission')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    name: valeur
                },
                success: function () {
                    $('#addPermissionModal').modal('hide');
                    $('table tbody').append(" <tr>" +
                        "<td class='control' tabindex='0' style=''></td>" +
                        "<td>" +
                        "<span class='text-nowrap'>" + valeur + "</span>" +
                        "<td>/" +
                        " </td>" +
                        "</td>" +
                        "<td class='dtr-hidden' >" +
                        "<span class='text-nowrap'>14 Apr 2021, 8:43 PM</span>" +
                        "</td>" +
                        "<td><span class='text-nowrap'><button class='btn btn-sm btn-icon me-2 btn-update' data-bs-target='#editPermissionModal' data-bs-toggle='modal' data-bs-dismiss='modal'><i class='bx bx-edit'></i></button><button class='btn btn-sm btn-icon delete-record'><i class='bx bx-trash'></i></button></span></td>" +
                        "</tr>")
                }
            })
        });
            $(document).on('click', '.delete-record', function(e) {
            $id =$(e.currentTarget).closest('span').attr('data-id');
            e.preventDefault();
            $.ajax({
                url: "{{route('deletePermission')}}",
                data: {
                    id: $id
                },
                success:function (){

                    $(e.currentTarget).closest('tr').find('td').slideUp(()=>{
                        $(this).closest('tr').remove();
                    })
                }
            });
        });


          /*  $('.update').click((e)=>{
                    e.preventDefault()
               let newValeur = $('#editPermissionName').val();
                   console.log($('#editPermissionModal'));
                    console.log(newValeur)
            })*/
        var id;
        var nameElement; // Déclarer la variable en dehors des fonctions pour qu'elle soit accessible globalement


        $(document).on('click', '.btn-update', function(e){
            id = $(this).closest('td').find('span').attr('data-id');
            console.log("id"+id);
            nameElement = $(this).closest('tr').find('td:nth-of-type(2)').find('span');

        });


            $(document).on('click', '.update', function(e){
            e.preventDefault();
            let newValeur = $('#editPermissionName').val();

            if (nameElement) {
                nameElement.text(newValeur); // Utiliser .text() pour définir le texte de l'élément
            }

            $.ajax({
                url: "{{route('updatePermission')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    name: newValeur,
                    id:id
                },
                success: function ( ) {
                    $('#editPermissionModal').modal('hide');
                }
            })
        });

    </script>
@endsection


                       {{-- @foreach($permissions as $permission)

                                @foreach($roles->index($permission->id) as $role)
                                    @switch($role->name)
                                        @case("secretaire")
                                            <span class="badge bg-warning">{{$role->name}}</span>
                                        @break
                                        @case("admin")
                                            <span class="badge bg-primary">{{$role->name}}</span>
                                            @break
                                        @case("tresorier")
                                            <span class="badge bg-danger">{{$role->name}}</span>
                                            @break
                                    @endswitch

                                @endforeach

                        @endforeach--}}

        </div>
    </div>
</section>



</body>
</html>

