<template>
    <div>
        <gmap
            :center="mapCenter"
            :zoom="6"
            style="width:100%; height: 800px; margin: 0 auto;"
            @click="handleMapClick"
        >
        
            <gmap-info-window
                :options="infoWindowOptions"
                :position="infoWindowPosition()"
                :opened="infoWindowOpened"
                @closeclick="handleInfoWindowClose()"
            >
                <div class="info-window">
                    <button @click="editMarker" class="btn btn-primary edit"><i class="fas fa-edit"></i> Edit marker</button>
                    <p><button @click="showModal" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i> Delete marker</button></p>
                </div>
            </gmap-info-window>

            <gmap-marker
                v-for="(m, index) in markers"
                :key="m.id"
                :position="getPosition(m)"
                :clickable="true"
                :draggable="false"
                @click="handleMarkerClicked(m)"
            >
            </gmap-marker>

        </gmap>
        <div class="modal" tabindex="-1" role="dialog" ref="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete marker</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                        <span aria-hidden="true" @click="closeModal">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure that you want to delete this marker?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" @click="deleteMarker">Yes</button>
                    <button type="button" class="btn btn-danger" @click="closeModal">No</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios';

export default{
    data() {
        
        return {
            markers: [], // list of markers
            infoWindowOptions: { 
                pixelOffset: {
                    width: 0,
                    height: -35
                }
            },
            activeMarker: {}, // determines the marker that was clicked
            infoWindowOpened: false, // check open/close infowindow
            markerId: 0
        }
    },

    created() {

        // Getting the information about markers, that show in admin panel
        axios.get('/userMarkers')
            .then((response) => this.markers = response.data)
            .catch((error) => console.error(error))
    },

    methods: {
        getPosition(marker) {
            return {
                lat: parseFloat(marker.lat),
                lng: parseFloat(marker.lng)
            }
        },
        infoWindowPosition() {
            return {
                lat: parseFloat(this.activeMarker.lat),
                lng: parseFloat(this.activeMarker.lng)
            }
        },

        // function that works after clicking on the marker
        handleMarkerClicked(m) {
            this.activeMarker = m;
            this.infoWindowOpened = true;
            this.markerId = m.id;
        },
        handleInfoWindowClose() {
            this.activeMarker = {};
            this.infoWindowOpened = false;
        },

        // create the marker by click on the map
        handleMapClick(e) {
            this.markers.push({
                lat: e.latLng.lat(),
                lng: e.latLng.lng()
            });
        
            // post request to method store in IndexAdminControllers
            axios.post('/admin/adminMarkers', {
                lat: e.latLng.lat(),
                lng: e.latLng.lng()
            })
            .then(() => console.log('Marker was created'))
            .catch((err) => console.error(err))
        },

        // delete marker from map and db
        deleteMarker() {

            const index = this.markers.findIndex(elem => elem.id === this.markerId );

            const newArr = [
                ...this.markers.slice(0, index),
                ...this.markers.slice(index + 1)
            ];

            this.markers = newArr;
            this.activeMarker = {};
            this.infoWindowOpened = false;

            // delete request to method destroy in IndexAdminController
            axios.delete('/admin/adminMarkers/'+ this.markerId)
            .then(() => console.log(`Element with id = ${this.markerId} was deleted!`))
            .catch((error) => console.error(error))

            this.closeModal();
        },

        editMarker() {
            this.$router.push('/' + this.markerId + '/edit');
        },

        showModal() {
            this.$refs.modal.style.display = 'block';
        },

        closeModal() {
            this.$refs.modal.style.display = 'none';
        }
    },

    computed: {
        mapCenter() {
            if(!this.markers.length) {
                return {
                    lat:50.449218,
                    lng:30.525824
                }
            }

             return {
                lat: parseFloat(this.markers[0].lat),
                lng: parseFloat(this.markers[0].lng)
            }
        }
    },
    
}

</script>

