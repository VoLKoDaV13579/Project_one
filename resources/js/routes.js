import Home from './components/Home.vue'
import RecyclerList from './components/RecyclerList.vue'
import RecyclerThemeList from './components/RecyclerThemeList.vue'
import RecyclerSolutionList from './components/RecyclerSolutionList.vue'
import RclRepair from './components/RclRepair.vue'
import Users from './components/Users.vue'

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
    {
        name:'RecyclerSolutionList',
        path:'/RecyclerSolutionList',
        component:RecyclerSolutionList
    },
    {
        name:'RclRepair',
        path:'/RclRepair',
        component:RclRepair
    },
    {
        name: 'Users',
        path: '/Users',
        component: Users
    }
        

]