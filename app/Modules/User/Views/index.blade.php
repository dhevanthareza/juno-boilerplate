@extends('dashboard_layout.index')
@section('content')
    <style>
        .modal-mask {
            position: fixed;
            z-index: 9998;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, .5);
            display: table;
            transition: opacity .3s ease;
        }

        .modal-wrapper {
            display: table-cell;
            vertical-align: middle;
        }
    </style>

    <div class="page-inner" id="user-page">
        <default-datatable title="User" url="{!! url('user') !!}" :headers="headers">
            <template #left-action="{ content }">
                <button @click="handleRoleButtonClick" type="button" class="btn btn-xs btn-info mr-1" data-toggle="modal">
                    Role
                </button>
            </template>
        </default-datatable>
        <div v-if="showModal">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" @click="showModal = false">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Modal body text goes here.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        @click="showModal = false">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>

        <div ref="modal" class="modal fade" id="addRoleModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex flex-row mb-3">
                            <input type="text" v-model="keyword" class="form-control mr-2" placeholder="Cari Role" />
                            <button type="button" class="btn btn-xs btn-primary mr-1">
                                Tambah Role
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            Role
                                        </th>
                                        <th class="text-center">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        createApp({
            data() {
                return {
                    isRolesLoading: false,
                    roles: [],
                    showModal: false,
                    headers: [{
                            text: 'id',
                            value: 'id',
                        },
                        {
                            text: 'Nama User',
                            value: 'name',
                        },
                        {
                            text: 'Username User',
                            value: 'username',
                        },
                        {
                            text: 'Email User',
                            value: 'email',
                        },
                    ],
                }
            },
            created() {},
            components: {
                ...commonComponentMap(
                    [
                        'DefaultDatatable',
                    ]
                )
            },
            methods: {
                handleRoleButtonClick() {
                    console.log("dsad")
                    this.showModal = true
                }
            },
        }).mount('#user-page');
    </script>
@endsection
