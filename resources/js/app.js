import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';
import moment from 'moment-timezone';

import Dashboard from './components/Dashboard';
import Calendar from './components/Calendar';
import Statistics from './components/Statistics';
import InternetConnection from './components/InternetConnection';
import TeamMember from './components/TeamMember';
import TimeWeather from './components/TimeWeather';
import Trains from './components/Trains';
import Twitter from './components/Twitter';
import Uptime from './components/Uptime';
import Velo from './components/Velo';
import TileTimer from './components/TileTimer';
import Spotify from './components/Spotify';

new Vue({
    el: '#dashboard',

    components: {
        Dashboard,
        Calendar,
        Statistics,
        InternetConnection,
        TeamMember,
        TimeWeather,
        Trains,
        Twitter,
        Uptime,
        Velo,
        TileTimer,
        Spotify,
    },

    created() {
        const config = {
            broadcaster: 'pusher',
            key: window.dashboard.pusherKey,
            cluster: 'eu',
            encrypted: true
        }

        /* if (window.dashboard.environment === 'local') {
            config.wsPort = 6001;
        } */

        moment.locale('es');

        this.echo = new Echo(config);
    },
});
