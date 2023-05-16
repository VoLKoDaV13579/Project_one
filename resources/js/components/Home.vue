<template>
    <div class="container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <router-link to="/" class="nav-item nav-link">Home </router-link>
                <router-link to="/RecyclerList" class="nav-item nav-link">Recycler List</router-link>
                <router-link to="/RecyclerThemeList" class="nav-item nav-link">Recycler Theme List</router-link>
            </ul>
        </header>
        <br>
        <router-view></router-view>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        mounted() {

        }
    }

</script>
