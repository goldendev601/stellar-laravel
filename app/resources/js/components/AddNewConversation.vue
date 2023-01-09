<template>
    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Conversation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">

                        <div class="mb-3">
                            <v-select v-model="member" :options="members"  label="name" placeholder="Select member"></v-select>
                            <span class="text-danger" v-if="isRequiredMember">Required</span>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" v-model="message" id="floatingTextarea2"
                                      style="height: 100px" required></textarea>
                            <label for="floatingTextarea2">Type a message......</label>
                            <span class="text-danger"  v-if="isRequiredMessage">Required</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="close-conversation" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-primary" v-on:click="startConversation(member,message)">
                            <span v-if="!loaderStartConversation">Send</span>
                            <div v-else-if="loaderStartConversation" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import vSelect from 'vue-select'
export default {
    name: "AddNewConversation",
    props:['loaderStartConversation'],
    components: {vSelect},
    data: function () {
        return {
            selectedMember: '',
            members: [],
            message: '',
            member: '',
            isRequiredMessage: false,
            isRequiredMember: false,

        }
    },
    mounted: function () {
        this.loadData();
    },
    computed: {
        isloaderRuning() {
            return this.$parent.isLoadingChat;
        }
    },
    methods: {
        loadData: function () {
            axios.get('/api/members-with-no-conversation').then(response => {
                this.members = response.data;
            }).catch(e => {

            })
        },

        startConversation(member, message) {

            this.isRequiredMember = this.member == '' ? true:false
            this.isRequiredMessage = this.message == '' ? true:false

            if (this.message !== '' && this.member !== '') {
                this.$emit('clicked', member, message)
                this.isRequiredMessage = false
                this.isRequiredMember = false
                this.message = ''
                this.selectedMember = ''
            }
        }
    }
}
</script>
