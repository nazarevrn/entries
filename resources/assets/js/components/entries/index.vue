<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'staffIndex'}" class="btn btn-success">Действия с пользователями</router-link>
        </div>

        <div class="form-group">
            <router-link :to="{name: 'entriesGenerate'}" class="btn btn-success">Генерировать информацию о посещениях</router-link>
        </div>
 
        <div class="panel panel-default">
            <div class="panel-heading">Список посещений</div>
            <form>
                <div class="name filter">
                    <input v-model="name" type="text" class="form-control" placeholder = "ФИО">
                </div>
                <div class="apply_filter">
                    <button type="submit" @click.prevent="fetch" >Применить фильтр</button>
                </div>
            </form>    
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Время</th>
                        <th>Направление</th>
                        <!-- <th width="100">&nbsp;</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, id) in entries" v-bind:key="id">
                        <td>{{ item.staff.name }}</td>
                        <td>{{ item.timestamp }}</td>
                        <td>{{ item.pass_direction | direction_filter }}</td>
                        <!-- <td>
                            <router-link :to="{name: 'editStaff', params: {id: item.id}}" class="btn btn-xs btn-default">
                                Редактировать
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(item.id)">
                                Удалить
                            </a>
                        </td> -->
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
                name: '',
                entries: []
            }
        },
        // mounted() {
        //     var app = this;
        //     axios.get(`/api/v1/entries`)
        //         .then(function (resp) {
        //             app.entries = resp.data;
        //         })
        //         .catch(function (resp) {
        //             console.log(resp);
        //             alert("Could not load entries");
        //         });
        // },

        methods: {
            fetch () {
                var app = this;
                axios.get(`/api/v1/entries`, {
                    params: {
                        name : this.name
                    }
                })
                    .then(function (resp) {
                        app.entries = resp.data;
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not load entries");
                    });
            },
            
            // filter() {
            //     console.log(123);
            // }


        },

        filters: {
            direction_filter (value) {
                if (value === 0) {
                    return 'Вход';
                } else {
                    return 'Выход';
                }
                //return value.toFixed(2)
            }
        },

        mounted() {
            this.fetch();
        }

    }
</script>