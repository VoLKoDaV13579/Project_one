<template>
    <div class="float-end">
        <button type="button" class="btn btn-success" @click="changeModalStatus('create')">Создать</button>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Тема</th>
                <th scope="col">Описание темы</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(theme, key) of listOfThemes" :key="key">
                <th scope="row">{{ theme.id }}</th>
                <td>{{ theme.title }}</td>
                <td>{{ theme.description }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary" @click="changeModalStatus('edit', theme)"><i
                                class="fas fa-edit"></i></button>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-sm btn-primary"
                            @click="changeModalStatus('delete', theme)"><i class="fas fa-trash-alt"></i></button>
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
                                <label class="form-label" for="title">Тема</label>
                                <input type="text" class="form-control" id="title" v-model="newObject.title"
                                    placeholder="Тема....">
                                <div class="form-text">Тема</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Описание</label>
                                <input type="text" class="form-control" id="description" v-model="newObject.description"
                                    placeholder="Описание....">
                                <div class="form-text">Описание</div>
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
                                <label class="form-label" for="title">Тема</label>
                                <input type="text" class="form-control" id="title" v-model="updateObject.title"
                                    placeholder="Тема....">
                                <div class="form-text">Тема</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Описание</label>
                                <input type="text" class="form-control" id="description"
                                    v-model="updateObject.description" placeholder="Описание....">
                                <div class="form-text">Описание</div>
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
                listOfThemes: [],
                isCreateModal: false,
                isEditModal: false,
                isDeleteModal: false,
                newObject: {
                    title: '',
                    description: '',
                },
                updateObject: {}
            }
        },
        mounted() {
            let vue = this;
            axios.get('/api/getTheme')
                .then(function (response) {
                    vue.listOfThemes = response.data;
                    console.log(vue.listOfThemes);
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
                    axios.post('/api/createTheme', vue.newObject)
                        .then(function (response) {
                            vue.listOfThemes = response.data.listOfThemes;
                            vue.changeModalStatus('create');
                            console.log('Success');
                        });
                } else if (modal == 'edit') {
                    axios.post('/api/updateTheme', vue.updateObject)
                        .then(function (response) {
                            vue.listOfThemes = response.data.listOfThemes;
                            vue.changeModalStatus('edit');
                            console.log('Success');
                        });
                } else if (modal == 'delete') {
                    console.log(vue.updateObject);
                    axios.post('/api/deleteTheme', vue.updateObject)
                        .then(function (response) {
                            vue.listOfThemes = response.data.listOfThemes;
                            vue.changeModalStatus('delete');
                        });

                }
            }
        }
    }

</script>
