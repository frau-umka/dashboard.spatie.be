<template>
    <tile :position="position" no-fade>
        <div
            class="grid gap-2 justify-items-center h-full"
            style="grid-template-rows: auto 1fr auto;"
        >
            <div class="markup">
                <h1>{{ date }}</h1>
            </div>
            <div class="align-self-center font-bold text-4xl tracking-wide leading-none">
                {{ time }}
            </div>
            <div class="uppercase">
                <div
                    class="grid gap-2 items-center"
                    style="grid-template-columns: repeat(3, auto);"
                >

                    <span class="text-sm uppercase text-dimmed">temperatura</span>
                    {{ weather.current }}°
                    <span class="text-2xl" v-html="icon"></span>

                </div>
            </div>
        </div>
    </tile>
</template>

<script>
import { emoji } from '../helpers';
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import moment from 'moment-timezone';
import weather from '../services/weather/Weather';

export default {
    components: {
        Tile,
    },

    mixins: [echo],

    props: {
        dateFormat: {
            type: String,
            default: 'DD-MM-YYYY',
        },
        timeFormat: {
            type: String,
            default: 'HH:mm',
        },
        timeZone: {
            type: String,
        },
        position: {
            type: String,
        },
    },

    data() {
        return {
            date: '',
            time: '',
            weather: {
                current: 0,
                max: 0,
                min: 0,
                icon: '',
            },
        };
    },

    created() {
        this.refreshTime();
        setInterval(this.refreshTime, 1000);
    },

    methods: {
        emoji,

        refreshTime() {
            this.date = moment()
                .tz(this.timeZone)
                .format(this.dateFormat);
            this.time = moment()
                .tz(this.timeZone)
                .format(this.timeFormat);
        },

        getEventHandlers() {
            return {
                'OpenWeather.OpenWeatherDataFetched': response => {
                    this.weather = response.weather;
                },
            };
        },
    },

    computed: {
        icon() {
            let icon = '';
            switch(this.weather.icon) {
                case '01d':
                case '01n':
                    icon = '☀️';
                    break;
                case '02d':
                case '02n':
                    icon = '🌤️';
                    break;
                case '03d':
                case '03n':
                    icon = '🌥️';
                    break;
                case '04d':
                case '04n':
                    icon = '☁️';
                    break;
                case '09d':
                case '09n':
                    icon = '🌧️';
                    break;
                case '10d':
                case '10n':
                    icon = '🌦️';
                    break;
                case '11d':
                case '11n':
                    icon = '⛈️';
                    break;
                case '13d':
                case '13n':
                    icon = '🌨️';
                    break;
                case '50d':
                case '50n':
                    icon = '🌫️';
                    break;
                default:
                    icon = '☀️';
            }

            return emoji(icon);
        }
    }
};
</script>
