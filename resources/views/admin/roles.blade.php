@extends('admin.template')
@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    @inject('roleCount',"App\Http\Controllers\Admin\RolesController")
    @inject('permissions',"App\Http\Controllers\Admin\PermissionsController")
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-2">Roles List</h4>

        <p>A role provided access to predefined menus and features so that depending on <br> assigned role an administrator can have access to what user needs.</p>
        <!-- Role cards -->
        <div class="row g-4">
            @foreach($roles as $role)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">

                                <h6 class="fw-normal">Total {{$roleCount->countUserHasRole($role->id)}} users</h6>
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                                        <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="Allen Rieske" data-bs-original-title="Allen Rieske">
                                        <img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="Julee Rossignol" data-bs-original-title="Julee Rossignol">
                                        <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="Kaith D'souza" data-bs-original-title="Kaith D'souza">
                                        <img class="rounded-circle" src="../../assets/img/avatars/15.png" alt="Avatar">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-sm pull-up" aria-label="John Doe" data-bs-original-title="John Doe">
                                        <img class="rounded-circle" src="../../assets/img/avatars/1.png" alt="Avatar">
                                    </li>
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="role-heading">
                                    <h4 class="mb-1">{{$role->name}}</h4>
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><small>Edit Role</small></a>
                                </div>
                                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach





                <!--/ Role Table -->

        <!--/ Role cards -->

        <!-- Add Role Modal -->
        <!-- Add Role Modal -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="role-title">Add New Role</h3>
                            <p>Set role permissions</p>
                        </div>
                        <!-- Add role form -->
                        <form id="addRoleForm" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework" onsubmit="return false" novalidate="novalidate">
                            <div class="col-12 mb-4 fv-plugins-icon-container">
                                <label class="form-label" for="modalRoleName">Role Name</label>
                                <input type="text" id="modalRoleName" name="modalRoleName" class="form-control" placeholder="Enter a role name" tabindex="-1">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <div class="col-12">
                                <h4>Role Permissions</h4>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                      {{--  <tr>
                                            <td class="text-nowrap fw-medium">Administrator Access <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Allows a full access to the system" data-bs-original-title="Allows a full access to the system"></i></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                                    <label class="form-check-label" for="selectAll">
                                                        Select All
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>--}}

                                      @foreach($permissions->getPermission() as $permission)
                                          <tr>
                                              <td class="text-nowrap fw-medium">{{$permission->name}}</td>
                                              <td>
                                                  <div class="d-flex">
                                                      <div class="form-check me-3 me-lg-5">
                                                          <input class="form-check-input checketrue" name="choix[{{$permission->id}}]" type="radio" value="true" id="userManagementRead{{$permission->id}}">
                                                          <label class="form-check-label" for="userManagementRead{{$permission->id}}">
                                                              oui
                                                          </label>
                                                      </div>
                                                      <div class="form-check me-3 me-lg-5">
                                                          <input class="form-check-input checkefalse" name="choix[{{$permission->id}}]" type="radio" value="false" id="userManagementWrite{{$permission->id}}">
                                                          <label class="form-check-label" for="userManagementWrite{{$permission->id}}">
                                                              non
                                                          </label>
                                                      </div>
                                                  </div>
                                              </td>
                                          </tr>
                                      @endforeach



                                        </tbody>
                                    </table>
                                </div>
                                <!-- Permission table -->
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                            <input type="hidden"></form>
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Role Modal -->

        <!-- / Add Role Modal -->
    </div>
        <script>
    let roleName
            // Lorsque le lien pour ouvrir la modal est cliqué
            $('.role-edit-modal').click(function() {
                // Trouver l'élément h4 associé
                roleName = $(this).closest('.card-body').find('.role-heading h4').text().trim();
                $.ajax({
                    url:"{{route("getPermissions")}}",
                    data:{
                        role:roleName
                    },
                    success:function (responsePHP) {

                        $('.form-check-input').each(function () {
                            // Obtient le nom de la permission associée à cette case à cocher
                            let permissionName = $(this).attr('name').replace('choix[', '').replace(']', '');

                            // Vérifie si le nom de la permission correspond à l'une des permissions dans la réponse AJAX
                            let isChecked = false;
                            responsePHP.forEach(permission => {
                                // Compare les noms de permission
                                if (permission.permissionID == permissionName) {
                                    isChecked = true;
                                }
                            });

                            // Coche la case "oui" si la permission est présente, sinon coche la case "non"

                            if (isChecked) {
                                $(this).closest('.d-flex').find('.form-check-input[value="true"]').prop('checked', true); // Coche la case "oui"
                            } else {

                                $(this).closest('.d-flex').find('.form-check-input[value="true"]').prop('checked', false); // Décoche la case "oui"
                                $(this).closest('.d-flex').find('.form-check-input[value="false"]').prop('checked', true); // Coche la case "non"
                            }
                        });

                    }
                })
            });

            $('button[type=submit]').click((e) => {
                e.preventDefault();

                // Créer un objet pour stocker les valeurs
                let valeurs = {};

                // Sélectionner tous les éléments radio
                $('input[type="radio"]').each(function() {
                    // Vérifier si l'élément radio est coché
                    if ($(this).is(':checked')) {
                        // Récupérer l'ID de la permission à partir de l'ID de l'élément
                        let permissionId = $(this).attr('id').replace('userManagementRead', '').replace('userManagementWrite', '');
                        // Récupérer la valeur de l'élément radio
                        let valeur = $(this).val();
                        // Stocker la valeur dans l'objet avec l'ID de la permission comme clé
                        valeurs[permissionId] = valeur;
                    }
                });

                let permissionNames = [];

                // Sélectionner tous les éléments <tr> dans la table des permissions
                $('#addRoleForm table tbody tr').each(function() {
                    // Récupérer le nom de la permission à partir du premier élément <td> de la ligne
                    let permissionName = $(this).find('td:first-child').text().trim();
                    // Ajouter le nom de la permission au tableau
                    permissionNames.push(permissionName);
                });


                // Afficher les valeurs dans la console
                console.log(permissionNames);
                $.ajax({
                    url:"{{route('roleUpdate')}}",
                    method:"POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        valeurs:valeurs,
                        role:roleName
                    },
                    success:function () {
                     alert("update reussit") ;
                    }
                })
            });
        </script>
@endsection
