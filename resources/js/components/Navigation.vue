<template>
    <div>
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
                <router-link to="/RecyclerSolutionList" class="nav-item nav-link">Recycler Solution List</router-link>
                <router-link to="/RclRepair" class="nav-item nav-link">Recycler Repair Request</router-link>
                <router-link to="/Users" class="nav-item nav-link">Users</router-link>
            </ul>
        </header>
    </div>
</template>

<script>
    export default { 
        name: "nav", }

</script>
