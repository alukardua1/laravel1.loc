<!--
  - Copyright (c) by anime-free
  - Date: 2020.
  - User: Alukardua
  -->

<template>
    <button v-if="isFavorited" @click.prevent="unFavorite(post)"
            class="btn btn-danger"
            data-toggle="tooltip" title="Убрать из закладок" data-original-title="Убрать из закладок">
        <i class="far fa-heart"></i>
    </button>
    <button v-else @click.prevent="favorite(post)"
            class="btn btn-success"
            data-toggle="tooltip" title="Добавить в закладки" data-original-title="Добавить в закладки">
        <i class="far fa-heart"></i>
    </button>
</template>

<script>
    export default {
        props: ['post', 'favorited'],

        data: function () {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            this.isFavorited = !!this.isFavorite;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(post) {
                axios.post('/favorites_add/' + post)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            unFavorite(post) {
                axios.post('/favorites_del/' + post)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>
