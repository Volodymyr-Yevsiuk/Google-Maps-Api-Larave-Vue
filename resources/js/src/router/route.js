import VueRouter  from 'vue-router'
import Map from '../components/Map'
import CreateMarker from '../components/CreateMarker'
import EditMarker from '../components/EditMarker'

export default new VueRouter ({
  routes: [
    {
      path: '',
      name: 'admin',
      component: Map
    },
    {
      path: '/create',
      name: 'adminMarkers.create',
      component: CreateMarker
    },
    {
      path: '/:id/edit',
      name: 'adminMarkers.edit',
      component: EditMarker
    },
  
  ]
})