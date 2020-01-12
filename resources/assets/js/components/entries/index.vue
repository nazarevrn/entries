<template>
    <div>
        <div class="form-group text-center">
            <router-link :to="{name: 'entriesGenerate'}" class="btn btn-success">Генерировать информацию о посещениях</router-link>
        </div>
 
        <div class="panel panel-default text-center">
            <div class="panel-heading">Список посещений</div>
            <form>
                <div class="name filter">
                    <input v-model="name" type="text" class="form-control" placeholder = "ФИО">
                </div>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapse" aria-expanded="false" aria-controls="collapse">
                    Фильтр по дате
                </a> 
                <div class="picker collapse" id="collapse">
                    <date-range-picker 
                        :from="$route.query.from" 
                        :to="$route.query.to" 
                        :panel="$route.query.panel" 
                        :locale="locale" 
                        :submitTitle="submitTitle"  
                        @update="update"/>
                </div>
                <div class="filter_buttons text-center">
                    <button type="submit" @click.prevent="fetch" class="btn btn-success">Применить фильтр</button>
                    <button type="submit" @click.prevent="reset" class="btn btn-danger">Сбросить фильтр</button>
                </div>

            </form>    
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Время</th>
                        <th>Направление</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, id) in entries" v-bind:key="id">
                        <td>{{ item.staff.name }}</td>
                        <td>{{ item.timestamp }}</td>
                        <td>{{ item.pass_direction | direction_filter }}</td>
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
                entries: [],
                locale: "ru",
                submitTitle: "Задать диапазон"
            }
        },

        methods: {
            fetch () {
                var app = this;
                axios.get(`/api/v1/entries`, {
                    params: {
                        name : this.name,
                        from: this.$route.query.from,
                        to: this.$route.query.to
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

            update(values) {
                this.$router.push({ query: Object.assign({}, this.$route.query, {
                    to: values.to,
                    from: values.from,
                    panel: values.panel
                    }) 
                })
            },

            reset() {
                this.name = null;
                let values = {
                    from: null,
                    to : null,
                    panel : null
                    };
                this.update(values);
                this.fetch();
            }


        },

        filters: {
            direction_filter (value) {
                if (value === 0) {
                    return 'Вход';
                } else {
                    return 'Выход';
                }
            }
        },

        mounted() {
            this.fetch();
        }

    }
</script>