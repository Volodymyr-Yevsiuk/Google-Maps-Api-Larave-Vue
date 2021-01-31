<template>
  <div class="form_div">
    <div v-if="(!isEdit)" class="hint">
      <p>Hint: you can also create a marker by clicking on the map :)</p>
    </div>
    <h4 class="create_title">{{ (!isEdit) ? 'Create new marker' : `Edit marker with id = ${id}` }}</h4>
    <form
      class="form "
      @submit.prevent="submitForm()"
      method="POST"

    >
      <ul>
        <li class="create_li " ref="latLi">
          <label for="lat">Latitude:</label>
          <input
            type="text"
            id="lat"
            name="lat"
            class="form-control"
            placeholder="Enter latitude"
            v-model="lat"
            :required="false"
            ref="latForm"
          />
          <div class="invalid-feedback">Please fill out this field.</div>
        </li>

        <li class="create_li " ref="lngLi">
          <label for="lng">Longitude:</label>
          <input
            type="text"
            id="lng"
            name="lng"
            class="form-control"
            placeholder="Enter longitude"
            v-model="lng"
            :required="false"
            ref="lngForm"
          />
          <div class="invalid-feedback">Please fill out this field.</div>
        </li>

        <li class="create_li">
          <label for="descr"> Detailed information about the place:</label>
          <textarea
            type="text"
            id="descr"
            name="descr"
            class="form-control"
            placeholder="Describe this place"
            v-model="descr"
          ></textarea>
        </li>

        <li class="create_li">
          <label for="img">Image of the place:</label>
          <div v-if="isEdit">
              <img v-if="typeof(image) === 'string'" :src="'/maps/images/markers/' + image" class="edit_img" ref="placeImage">
          </div>
          <br/><input
            type="file"
            id="img"
            name="image"
            class="image_input"
            data-buttonText="Сhoose image"
            data-buttonName="btn-primary"
            data-placeholder="No file"
            @change="onAttachmentChange"
          />
        </li>
        
        <li class="create_li">
          <button class="btn btn-success" type="submit">Save</button>
        </li>
      </ul>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
      // property that checked Edit or Create form
        isEdit: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            id: null,
            lat: '',
            lng: '',
            descr: '',
            image: null,   
        }
    },

    mounted() {
      
        // If edit form, then in input fields recorded info from db
        if(this.isEdit) {
            axios.get('/api/markers/' + this.$route.params.id)
            .then((response) => {
                const data = response.data;
                this.id = data.id;
                this.lat = data.lat;
                this.lng = data.lng;
                this.bootstrapValidateForm();
                this.descr = data.descr;
                this.image = data.img;
                
            })
            .catch((error) => console.error(error))

            
        }
    },

    methods: {
        submitForm() {
            const formData = new FormData();
            const config = { 'content-type': 'multipart/form-data' };
            if(!this.isEdit) {
                
                this.bootstrapValidateForm();
                
                formData.append('lat', this.lat);
                formData.append('lng', this.lng);
                formData.append('descr', this.descr);
                formData.append('image', this.image);

                axios.post('/admin/adminMarkers', formData, config)
                .then(() => this.$router.push({name: 'admin'}))
                .catch((error) => console.error(error))
            } else {

                formData.set('lat', this.lat);
                formData.set('lng', this.lng);
                formData.set('descr', this.descr);
                formData.set('image', this.image);
                formData.append('_method', 'put');

                axios.post("/admin/adminMarkers/" + this.id, formData, config)
                .then(() => this.$router.push({name: 'admin'}))
                .catch((error) => console.error(error))
            }
        },

        onAttachmentChange(e) {
            this.image = e.target.files[0];
            this.$refs.placeImage.style.display = 'none';
        },

        bootstrapValidateForm() {
          this.$refs.latForm.setAttribute('required', true)
          this.$refs.lngForm.setAttribute('required', true)
          this.$refs.latLi.classList.add('was-validated');
          this.$refs.lngLi.classList.add('was-validated');
        }
          
    }
}
</script>
