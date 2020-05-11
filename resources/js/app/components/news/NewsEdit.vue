<template>
    <div class="app-section">
        <div class="card p-3">
            <section class="content">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button @click="deleteNews" class="btn btn-danger mr-3" v-if="id != 0">Delete</button>
                        <button @click="saveNews" class="btn btn-primary ml-3" :disabled="$v.$invalid">Save</button>
                        <router-link tag="button" :to="{name: 'news.show', params: {id}}" class="btn btn-dark">Back</router-link>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" :class="{'is-invalid': $v.title.$error}" v-model="title" @blur="$v.title.$touch()" id="title" name="title" placeholder="This is Title (Min 3 chars)">
                    <span v-if="!$v.title.required" class="invalid-feedback" role="alert">
                        <strong>Title is required</strong>
                    </span>
                    <span v-if="!$v.title.minLength" class="invalid-feedback" role="alert">
                        <strong>Need {{$v.title.$params.minLength.min}} chars. Now is {{title.length}}</strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="desc">Description:</label>
                    <textarea name="desc" id="desc" cols="30" rows="10" class="form-control" :class="{'is-invalid': $v.desc.$error}" v-model="desc" @blur="$v.desc.$touch()" placeholder="This is Description (Min 10 chars)"></textarea>
                    <span v-if="!$v.desc.required" class="invalid-feedback" role="alert">
                        <strong>Description is required</strong>
                    </span>
                    <span v-if="!$v.desc.minLength" class="invalid-feedback" role="alert">
                        <strong>Need {{$v.desc.$params.minLength.min}} chars. Now is {{desc.length}}</strong>
                    </span>
                </div>
                <div class="row">
                    <photo-edit-card
                        v-if="photos.length > 0"
                        v-for="photo in photos"
                        :photo="photo"
                        :key="photo.id"
                        @deletePhoto="deletePhoto"/>
                </div>
                <div v-if="id != 0" class="attach-file">
                    <div class="row">
                        <div class="col">
                            <label class="custom-file-upload">
                                Upload photo
                                <input type="file" name="avatar" id="avatar" multiple accept="image/*" @change="onPhotoChange">
                            </label>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <p>You can upload image after save the post</p>
                </div>
                <div v-if="errorPhoto">
                    <span class="invalid-avatar" role="alert">
                        <strong>Image size needs < 1Mb</strong>
                    </span>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    import {required, minLength} from 'vuelidate/lib/validators';
    import PhotoEditCard from "./PhotoEditCard";

    export default {
        data() {
            return {
                id: 0,
                title: '',
                desc: '',
                photos: [],
                errorPhoto: false,
                newPhoto: null
            }
        },
        methods: {
            getNews() {
                axios.get('/news/data/' + this.id)
                .then(result => {
                    if (!result.data.isAuthor) {
                        this.$router.push({name: 'home'});
                    }
                    this.title = result.data.news.title;
                    this.desc = result.data.news.description;
                    this.photos = result.data.news.photos;
                })
            },
            deleteNews() {
                axios.delete('/news/' + this.id)
                .then(result => {
                    this.$router.push({name: 'home'});
                }).catch(error => {
                    console.log(error)
                })
            },
            deletePhoto(id) {
                this.photos = this.photos.filter(photo => photo.id != id)
            },
            onPhotoChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                if(files[0].size > 1024 * 1024) {
                    this.errorPhoto = true;
                    return;
                }
                this.errorPhoto = false;
                this.newPhoto = files[0];
                this.savePhoto();
            },
            savePhoto() {
                const config = { headers: { 'Content-Type': 'multipart/form-data' } };
                let data = new FormData;
                data.append('photo', this.newPhoto);
                data.append('news_id', this.id);
                axios.post('/news/photo',
                    data, config
                ).then(result => {
                    if(result.data !== null) {
                        this.photos.push(result.data)
                    }
                }).catch(error => {
                    console.log(error)
                })
            },
            saveNews() {
                axios.post('/news/' + this.id, {
                    title: this.title,
                    desc: this.desc
                }).then(result => {
                    if (this.id == 0) {
                        this.$router.push({name: 'news.edit', params: {id: result.data.id}})
                        this.id = result.data.id;
                    }
                }).catch(error => {
                    console.log(error)
                })
            }
        },
        validations: {
            title: {
                required,
                minLength: minLength(3),
            },
            desc: {
                required,
                minLength: minLength(10),
            }
        },
        created() {
            this.id = this.$route.params.id;
            if(this.id != 0) {
                this.getNews();
            }
        },
        components: {
            PhotoEditCard
        }
    }
</script>

<style lang="scss" scoped>
    .attach-file {
        text-align: center;
    }
    .avatar {
        width:100px;
        height: 100px;
        border-radius: 65px;
        object-fit: cover;
    }
    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        color: #fff;
        width: 100%;
        border: 1px solid #343a40;
        display: inline-block;
        background-color: #343a40;
        border-radius: 0.25rem;
        padding: 6px 12px;
        cursor: pointer;
    }
    .invalid-avatar {
        width: 100%;
        margin-top: 0.25rem;
        font-size: 80%;
        color: #e3342f;
    }
</style>
