<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h4>Edit Song</h4>
      </div>
      <div class="card-body">
        <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
          <li v-for="(error, index) in this.errorList" :key="index" class="mb-0 ms-3">
            {{ error[0] }}
          </li>
        </ul>
        <div class="mb-3">
          <label for="">Title</label>
          <input type="text" class="form-control" v-model="model.song.title">
        </div>
        <div class="mb-3">
          <label for="">Genre</label>
          <input type="text" class="form-control" v-model="model.song.genre">
        </div>
        <div class="mb-3">
          <label for="">Artist</label>
          <input type="text" class="form-control" v-model="model.song.artist">
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="button" @click="updateSong()">Update</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

  export default {
    name: 'songEdit',
    data(){
      return{
        songId: '',
        errorList: '',
        model: {
          song: {
            title: '',
            genre: '',
            artist: ''
          }
        }
      }
    },
    mounted(){
      this.songId = this.$route.params.id
      console.log(this.$route.params.id)
      this.getSongData(this.$route.params.id)
    },
    methods: {
      getSongData(songId){
        axios.get(`http://localhost:8000/api/songs/${songId}/edit`)
        .then(res => {
          console.log(res.data.song)
          this.model.song = res.data.song
        })
        .catch(function(error){
          if(error.response){
            if(error.response.status == 404){
              alert(error.response.data.message)
            }
          }
        })
      },
      updateSong(){
        var myThis = this
        axios.put(`http://localhost:8000/api/songs/${this.songId}/edit`, this.model.song)
        .then(res => {
          alert(res.data.message)
          this.errorList = ''
        })
        .catch(function(error){
          if(error.response){
            if(error.response.status == 422){
              myThis.errorList = error.response.data.errors
            }
            if(error.response.status == 404){
              alert(error.response.data.message)
            }
          }
          else if(error.request){
            console.log(error.request)
          }
          else{
            console.log('Error', error.message)
          }
        })
      }
    }
  }
</script>