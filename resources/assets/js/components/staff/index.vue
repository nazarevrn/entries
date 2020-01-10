<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'staffCreate'}" class="btn btn-success">Создать нового пользователя</router-link>
        </div>

        <!-- <div class="form-group">
            <router-link :to="{name: 'entriesIndex'}" class="btn btn-success">Просмотр информации о посещениях</router-link>
        </div> -->
 
        <div class="panel panel-default">
            <div class="panel-heading">Список пользователей</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>КОД</th>
                        <th>Телефон</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, id) in staff" v-bind:key="id">
                        <td>{{ item.name }}</td>
                        <td>{{ item.code }}</td>
                        <td>{{ item.phone }}</td>
                        <td>
                            <router-link :to="{name: 'editStaff', params: {id: item.id}}" class="btn btn-xs btn-default">
                                Редактировать
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(item.id)">
                                Удалить
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {
                staff: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/staff')
                .then(function (resp) {
                    app.staff = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load staff");
                });
        },
        methods: {
            deleteEntry(id) {
                if (confirm("Вы действительно хотите удалить?")) {
                    var app = this;
                    axios.delete('/api/v1/staff/' + id)
                        .then(function (resp) {
                            app.$router.push({path: '/'});
                        })
                        .catch(function (resp) {
                            alert("Удаление невозможно...");
                        });
                    //console.log(id);
                }
            }
        }
    }
</script>