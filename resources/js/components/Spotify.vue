<template>
    <tile :position="position" no-fade>
        <div class="flex items-center justify-center h-full">
          <div v-if="!authorization">
            <a :href="authorizeUrl" class="px-6 py-4 rounded-full bg-green text-default font-bold">
              Conectar con Spotify
            </a>
          </div>
          <div v-else class="flex">
            <div>
              <img :src="image" alt="Album image">
            </div>
            <div class="flex flex-col pl-2">
              <span class="text-xl font-bold">{{ name }}</span>
              <div class="flex">
                <span v-for="(artist, index) in track.artists" :key="index" class="pr-2">
                  {{ artist.name }}
                </span>
              </div>
            </div>
          </div>
        </div>
    </tile>
</template>

<script>
import { emoji } from '../helpers';
import echo from '../mixins/echo';
import Tile from './atoms/Tile';

export default {
    components: {
        Tile,
    },

    mixins: [echo],

    props: {
      authorizeUrl: {
        type: String,
        default: '',
      },
      position: {
        type: String,
      },
    },

    data() {
        return {
          track : {},
          authorization : false,
        };
    },

    created() {

    },

    computed: {
      name() {
        return this.track.name;
      },
      image() {
        return this.track.album ? this.track.album.images[2].url : '';
      }
    },

    methods: {
        emoji,

        getEventHandlers() {
            return {
                'Spotify.CurrentTrackFetched': response => {
                  this.authorization = true;
                  console.log(response.track);
                  this.track = response.track;
                },
            };
        },
    },
};
</script>
