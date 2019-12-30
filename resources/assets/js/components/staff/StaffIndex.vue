<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createStaff'}" class="btn btn-success">Создать нового пользователя</router-link>
        </div>
 
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
                            <!-- <router-link :to="{name: 'editStaff', params: {id: item.id}}" class="btn btn-xs btn-default">
                                Редактировать пользователя
                            </router-link> -->
                            <!-- <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(vacation.id, index)">
                                Delete
                            </a> -->
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
            axios.get('/api/v1/staff/index')
                .then(function (resp) {
                    app.staff = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load staff");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/v1/vacations/' + id)
                        .then(function (resp) {
                            app.vacations.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete company");
                        });
                }
            }
        }
    }
</script>