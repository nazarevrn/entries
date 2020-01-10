<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'entriesIndex'}" class="btn btn-success">Просмотр информации о посещениях</router-link>
        </div>

        <div class="form-group">
            <a href="#"
                class="btn btn-xs btn-danger"
                v-on:click="generate()">
                Генерировать
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            generate() {
                let app = this;
                axios.post('/api/v1/entries')
                    .then(function (resp)  {
                        app.$router.push({name: 'entriesIndex'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert('Ошибка во время генерации');
                        
                    });
            }
        }
    }
</script>