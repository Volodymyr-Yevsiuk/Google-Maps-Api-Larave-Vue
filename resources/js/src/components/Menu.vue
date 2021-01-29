<template>
    <div class="navigation">
        <div class="navBar">
            <div class="logo">
                <router-link to="/" class="nav_link home_nav_link">Admin panel</router-link>
            </div>
            <div class="authoriazed_routes admin_routes">
                <router-link to="/" class="nav_link">Admin Page</router-link>
                <router-link to="/create" class="nav_link">Create Marker</router-link>
                <a href="/logout" class="nav_link">Logout</a>
                
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        name: 'Menu'
    }
</script>