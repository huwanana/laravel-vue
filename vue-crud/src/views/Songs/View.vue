<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4>
          Songs
          <RouterLink to="/songs/create" class="btn btn-primary float-end">Add Song</RouterLink>
        </h4>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Genre</th>
              <th>Artist</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="(this.songs).length > 0">
            <tr v-for="(song, index) in this.songs" :key="index">
              <td>{{ song.id }}</td>
              <td>{{ song.title }}</td>
              <td>{{ song.genre }}</td>
              <td>{{ song.artist }}</td>
              <td>
                <RouterLink :to="{path: '/songs/'+song.id+'/edit'}" class="btn btn-success float-end">Edit</RouterLink>
                <button class="btn btn-danger float-end" @click="deleteSong(song.id)">Delete</button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="7">Loading...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'
  export default {
    name: 'songs',
    data(){
      return {
        songs: []
      }
    },
    mounted(){
      this.getSongs()
    },
    methods: {
      getSongs(){
        axios.get('http://localhost:8000/api/songs')
        .then(res => {
          this.songs = res.data.songs
        })
        .catch(error => {
          console.log(error)
        })
      },
      deleteSong(songId){
        if(confirm('Are you sure you want to delete this data?')){
          axios.delete(`http://localhost:8000/api/songs/${songId}/delete`)
          .then(res => {
            alert(res.data.message)
            this.getSongs()
          })
          .catch(function(error){
            if(error.response){
              if(error.response.status == 404){
                alert(error.response.data.message)
              }
            }
          })
        }
      }
    }
  }
</script>
