import Home from './components/home';
import Sair from './components/sair';

export default{
    mode: 'history',
    linkActiveClass: 'font-semibold',
    routes: [
        {
            name: "Home",
            path: '/home',
            component: Home
        },
        {
            name: "Sair",
            path: '/sair',
            component: Sair
        },
    ]
}