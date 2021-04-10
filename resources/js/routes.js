import Home from './components/home';
import Index from './components/index';

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
            name: "Index",
            path: '/',
            component: Index
        },
    ]
}