<template>
    <div class="float-end">
        <button type="button" class="btn btn-success" @click="changeModalStatus('create')">Создать</button>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Статус</th>
                <th scope="col">Внутренний ID</th>
                <th scope="col">Адресс</th>
                <th scope="col">Серийный номер</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(recycler, key) of listOfRecycler" :key="key">
                <th scope="row">{{ recycler.id }}</th>
                <td>{{ recycler.status }}</td>
                <td>{{ recycler.system_id }}</td>
                <td>{{ recycler.address }}</td>
                <td>{{ recycler.serial_number }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary" @click="changeModalStatus('edit', recycler)"><i
                                class="fas fa-edit"></i></button>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary"
                            @click="changeModalStatus('delete', recycler)"><i class="fas fa-trash-alt"></i></button>
                    </div>

                </td>
            </tr>
        </tbody>
    </table>
    <div v-if="isCreateModal">
        <transition name="modal">
            <div class="modal fade show" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:block">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Создание записи</h5>
                            <button type="button" class="btn btn-primary btn-sm" style="background-color: #455a64;"
                                data-dismiss="modal" aria-label="Close" @click="changeModalStatus('create')">
                                Закрыть
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="title">Статус</label>
                                <input type="text" class="form-control" id="status" v-model="newObject.status"
                                    placeholder="Введите статус....">
                                <div class="form-text">Введите статус</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Внутренний ID</label>
                                <input type="text" class="form-control" id="system_id" v-model="newObject.system_id"
                                    placeholder="Введите внутренний ID....">
                                <div class="form-text">Введите внутренний ID</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="price">Адресс</label>
                                <input type="text" class="form-control" id="address" v-model="newObject.address"
                                    placeholder="Введите адресс....">
                                <div class="form-text">Введите адресс</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="amount">Серийный номер</label>
                                <input type="text" class="form-control" id="serial_number" v-model="newObject.serial_number"
                                    placeholder="Введите серийный номер....">
                                <div class="form-text">Введите серийный номер</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"
                                @click="changeModalStatus('create')">Отмена</button>
                            <button type="button" class="btn btn-success" @click="save('create')">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
    <div v-if="isEditModal">
        <transition name="modal">
            <div class="modal fade show" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:block">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Изменение записи</h5>
                            <button type="button" class="btn btn-primary btn-sm" style="background-color: #455a64;"
                                data-dismiss="modal" aria-label="Close" @click="changeModalStatus('edit')">
                                Закрыть
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="title">Статус</label>
                                <input type="text" class="form-control" id="title" v-model="updateObject.status"
                                    placeholder="Статус....">
                                <div class="form-text">Статус</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Внутренний ID</label>
                                <input type="text" class="form-control" id="description"
                                    v-model="updateObject.system_id" placeholder="Введите внутренний ID....">
                                <div class="form-text">Введите внутренний ID</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="price">Адресс</label>
                                <input type="text" class="form-control" id="price" v-model="updateObject.address"
                                    placeholder="Адресс....">
                                <div class="form-text">Адресс</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="amount">Серийный номер</label>
                                <input type="text" class="form-control" id="amount" v-model="updateObject.serial_number"
                                    placeholder="Введите серийный номер....">
                                <div class="form-text">Введите серийный номер</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"
                                @click="changeModalStatus('edit')">Отмена</button>
                            <button type="button" class="btn btn-success" @click="save('edit')">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
    <div v-if="isDeleteModal">
        <transition name="modal">
            <div class="modal fade show" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:block">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Удаление записи</h5>
                            <button type="button" class="btn btn-primary btn-sm" style="background-color: #455a64;"
                                data-dismiss="modal" aria-label="Close" @click="changeModalStatus('delete')">
                                Отменить
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="title">Подтвердите удаление</label>
                                <div class="form-text">Вы действительно хотите удалить запись?</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"
                                @click="changeModalStatus('delete')">Отмена</button>
                            <button type="button" class="btn btn-success" @click="save('delete')">Удалить</button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                listOfRecycler: [],
                isCreateModal: false,
                isEditModal: false,
                isDeleteModal: false,
                newObject: {
                    status: '',
                    system_id: '',
                    address: 0,
                    serial_number: 0,
                },
                updateObject: {}
            }
        },
        mounted() {
            let vue = this;
            axios.get('/api/get')
                .then(function (response) {
                    vue.listOfRecycler = response.data;
                    console.log(vue.listOfRecycler);
                });
        },

        methods: {
            changeModalStatus: function (modal, object = null) {
                if (modal == 'create') {
                    this.isCreateModal = !this.isCreateModal;
                } else if (modal == 'edit') {
                    this.updateObject = object;
                    this.isEditModal = !this.isEditModal;
                } else if (modal == 'delete') {
                    this.updateObject = object;
                    console.log(this.updateObject);
                    this.isDeleteModal = !this.isDeleteModal;
                }
            },

            save: function (modal) {
                let vue = this;
                if (modal == 'create') {
                    axios.post('/api/create', vue.newObject)
                        .then(function (response) {
                            vue.listOfRecycler = response.data.listOfRecycler;
                            vue.changeModalStatus('create');
                            console.log('Success');
                        });
                } else if (modal == 'edit') {
                    axios.post('/api/update', vue.updateObject)
                        .then(function (response) {
                            vue.listOfRecycler = response.data.listOfRecycler;
                            vue.changeModalStatus('edit');
                            console.log('Success');
                        });
                } else if (modal == 'delete') {
                    console.log(vue.updateObject);
                    axios.post('/api/delete', vue.updateObject)
                        .then(function (response) {
                            vue.listOfRecycler = response.data.listOfRecycler;
                            vue.changeModalStatus('delete');
                        });

                }
            }
        }
    }

</script>
