<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between pb-3">
                        <h1>Conversations</h1>
                        <div class="startNewConversationBtn" data-bs-toggle="modal" data-bs-target="#exampleModal"><a
                            href="#"> <i
                            data-feather="plus"></i>Start
                            New
                            Conversation</a>
                        </div>
                        <AddNewConversation :loaderStartConversation="loaderStartConversation"
                                            @clicked="startConversation" ref="AddNewConversation"></AddNewConversation>
                    </div>
                </div>
            </div>
            <div class="row libraryPage">
                <div class="xl-100 box-col-12">
                    <div class="card o-hidden">
                        <div class="card-body p-0">
                            <div class="row">
                                <MemberList :member="member" @clicked="onClickChild" ref="memberList"></MemberList>
                                <ConversationsSection ref="conversationsSection"
                                                      :loader="loader" :member="member"
                                                      :conversations="conversations"></ConversationsSection>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// $(".select-member").select2({
//     placeholder: "Select seller",
// });
import ConversationsSection from "./ConversationsSection"
import MemberList from "./MemberList"
import AddNewConversation from "./AddNewConversation"

export default {
    name: "App",
    props: ['member_by_id'],

    comments: {
        ConversationsSection,
        MemberList,
        AddNewConversation
    }, data() {
        return {
            conversations: [],
            member: '',
            loader: false,
            loaderStartConversation: false

        }
    },
    created() {
        if (this.member_by_id !='') {
            this.getMember(this.member_by_id)
        }
    },
    methods: {
        // Our method to GET results from a Laravel endpoint
        async onClickChild(member) {
            this.loaderActive(true)
            await axios.get('/api/conversations/member/' + member.id)
                .then(response => {
                    this.conversations = response.data;
                }).then(re => {
                    this.$refs.conversationsSection.scrollChat();

                }).then(re => {
                    this.loaderActive(false)
                });

            this.member = member

        },
        async getMember(member_by_id) {
            this.loaderActive(true)
            await axios.get('/api/conversations/member/' + member_by_id.id)
                .then(response => {
                    this.conversations = response.data;
                }).then(re => {
                    if(this.conversations.length > 0){
                        this.$refs.conversationsSection.scrollChat();
                    }
                }).then(re => {
                    this.loaderActive(false)
                });

            this.member = member_by_id

        },
        async startConversation(member, message) {
            this.loaderStartConversation = true;
            await axios.post('/api/conversations/start', {
                message: message,
                memberId: member.id,
            })
                .then(response => {
                    this.$refs.memberList.getResults();
                    this.$refs.AddNewConversation.loadData();
                    this.onClickChild(member);
                    this.loaderStartConversation = false;
                    document.getElementById('close-conversation').click();

                });
        },
        loaderActive(loader) {
            this.loader = loader;
        },
    }
}
</script>
