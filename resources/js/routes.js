import Home from './components/Home.vue'
import RecyclerList from './components/RecyclerList.vue'
import RecyclerThemeList from './components/RecyclerThemeList.vue'

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'RecyclerList',
        path: '/RecyclerList',
        component: RecyclerList
    },
    {
        name: 'RecyclerThemeList',
        path: '/RecyclerThemeList',
        component: RecyclerThemeList
    },
]