<template>
    <v-container>
        <v-form @submit.prevent="submit">
            <v-text-field
                v-model="form['name']"
                label="Tag*"
                required
            ></v-text-field>
            <v-btn v-if="editSlug" type="submit" color="purple">Update</v-btn>
            <v-btn v-else type="submit" color="primary">Create</v-btn>
            <v-btn v-if="editSlug" class="mr-4" color="normal" @click="cancel">
                <v-icon left>cancel</v-icon>
                cancel
            </v-btn>
        </v-form>
        <br>
        <v-card class="mx-auto">
            <v-toolbar dark dense>
                <v-toolbar-title>Tags</v-toolbar-title>
            </v-toolbar>
            <v-list>
                <div v-for="(tag, index) in tags" :key="tag.id">
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>
                                    {{ tag.name }}
                            </v-list-item-title>
                        </v-list-item-content>
                        <v-list-item-action>
                            <v-btn icon small @click="edit(index)">
                                <v-icon color="orange">edit</v-icon>
                            </v-btn>
                        </v-list-item-action>
                        <v-list-item-action>
                            <v-btn icon small @click="destroy(tag.slug)">
                                <v-icon color="red">delete</v-icon>
                            </v-btn>
                        </v-list-item-action>
                    </v-list-item>
                    <v-divider></v-divider>
                </div>
            </v-list>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                form : {
                    name:null
                },
                tags: {},
                editSlug: null,
            }
        },
        created() {
            if (!User.admin()) {
                this.$router.push('/');
            }
            this.fetchTags();
        },
        methods: {
            fetchTags() {
                this.$Progress.start()
                axios.get('api/tag')
                    .then(res => {
                        this.tags = res.data.data
                        this.$Progress.finish()
                    })
                    .catch(error => {
                        error.response.data
                        this.$Progress.fail()
                    })
            },
            submit() {
                this.editSlug ? this.update() : this.create();
            },
            create() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, create it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('/api/tag', this.form)
                            .then(res => { 
                                this.tags.unshift(res.data);
                                this.form.name = null;
                                Toast.fire({
                                    icon: res.data.status,
                                    title: res.data.message
                                });
                             })
                            .catch(error => console.log(error.response.data))
                    }
                })
            },
            update() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.put(`/api/tag/${this.editSlug}`, this.form)
                            .then(res => { 
                                this.fetchTags();
                                this.editSlug = null;
                                this.form.name = null;
                                Toast.fire({
                                    icon: res.data.status,
                                    title: res.data.message
                                });
                             })
                            .catch(error => console.log(error.response.data))
                    }
                })
            },
            edit(index) {
                this.editSlug = this.tags[index].slug;
                this.form.name = this.tags[index].name;
            },
            destroy(slug, index) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/api/tag/${slug}`)
                            .then(res => { 
                                this.tags.splice(index, 1)
                                Toast.fire({
                                    icon: res.data.status,
                                    title: res.data.message
                                });
                             })
                            .catch(error => console.log(error.response.data))
                    }
                })
            },
            cancel() {
                this.editSlug = null;
                this.form.name = null;
            }
        }
    }
</script>