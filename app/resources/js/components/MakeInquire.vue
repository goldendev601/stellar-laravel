<template>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <span class="close cursor" onclick="closeInquireModal()">
                <img class="modal-close-btn-img" src='/assets/images/close-btn.svg'>
            </span>
            <div class="container px-4 mt-md-5 px-md-5 above-wrapper">
                <div class="row">
                    <div class="col-12 col-md-12 order-2 order-md-1 pe-md-5">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="asstesName">Hi There!</h4>
                                <p class="description my-4">Let us know if we can help you with anything at all.</p>
                            </div>
                            <div v-for="(faq, index) in faqs" v-if=" index <= step  && faq.isShow">
                                <div class="col-12 agency-msg-wrapper" v-if="faq.question != null">
                                    <div class="agency-msg-wrapper-left">
                                        <div class="agent-img-container">
                                            <img class="agent-img" src='/assets/images/user.jpg'>
                                        </div>
                                        <p class="time-info">{{ faq.questionTime }}</p>
                                    </div>
                                    <div v-if="!faq.isTyping">
                                    <div class="agency-msg-wrapper-right" onload="saveTime(index)" v-bind:class = "(endChat) ?'full-width':''">
                                        {{ faq.question }}
                                    </div>
                                    <div class="yesNo" v-if="!emailConfirmation">
                                        <span class="btn btn-danger" v-if="faq.skipEmail" @click="getEmailAnswer" data-answer="No">No</span>
                                        <span class="btn btn-success" v-if="faq.enterEmail" @click="getEmailAnswer" data-answer="Yes">Yes</span>
                                    </div>
                                    </div>
                                    <div v-if="faq.isTyping" class="typing">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                                <div class="col-12 question-item-msg-wrapper question-msg-2" v-if="faq.answer != null">
                                    <div class="question-item-msg">
                                        {{ faq.answer }}
                                    </div>
                                </div>
                            </div>
                            <div id="bottom-div-chat" ref="bottom" style="margin-bottom: 5px;"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container px-4 mt-md-5 px-md-5 bottom-wrapper">
                <div class="row">
                    <div class="col-12 col-md-12 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-md-12 default-question-list">
                                <div class="row">
                                    <div class="col-12 question-item-btn-wrapper question-btn-2" v-if="!isShow"
                                         @click="updateAnswer">
                                        <div class="question-item-btn">
                                            I want to acquire this asset
                                        </div>
                                    </div>
                                    <div class="col-12 message-btn-wrapper" v-if="!isShow">
                                        <div class="message-btn-rect" @click="updateAnswer">
                                            <img class="message-shape-img" src='/assets/images/message-shape.svg'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 message-input-wrapper" v-if="isShow">
                                <input v-on:keyup.enter="validateAnswer" type="text" name="message"  id="message" :disabled="endChat"  v-model="answer" class="form-control message-input"
                                       placeholder="Type message here..." autofocus>
                            <div v-if="!endChat">

                                <img class="send-msg-img" v-if="isShowChat"   v-bind:class = "(answer == null)?'no-click':''" src='/assets/images/send-msg.svg' @click="validateAnswer">

                                <div class="lds-ellipsis" v-if="!isShowChat"><div></div><div></div><div></div><div></div></div>
                            </div>
                            </div>
                            <span class="error-answer text-danger" v-if="errorMessage != null">{{ errorMessage}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from "moment";
export default {
    name: "MakeInquire",
    props: ['asset_id'],
    data: function () {
        return {
            isShow: false,
            isShowChat: true,
            memberName: null,
            emailConfirmation: false,
            isTyping: false,
            emailAnswer:null,
            validatedAnswers:
                {
                    phone:null,
                    first_name: null,
                    last_name:null,
                    email:null
                },
            answer:null,
            valid: true,
            endChat:false,
            errorMessage: null,
            step:0,
            faqs: [
                {
                    question: 'Hi! My name is Sarah. How can I help you today?',
                    answer: null,
                    questionTime: this.getCurrentTime(),
                    isShow:true,
                    isTyping : false
                },
                {
                    question: 'Please enter your phone number.',
                    answer: null,
                    questionTime: null,
                    isShow:true,
                    isTyping : true
                },
                {
                    question: 'Please enter your first name.',
                    answer: null,
                    questionTime: null,
                    isShow:true,
                    isTyping : true
                },
                {
                    question: 'Please enter your last name.',
                    answer: null,
                    questionTime: null,
                    isShow:true,
                    isTyping : true
                },
                {
                    question: 'Would you like to provide your email address.',
                    answer: null,
                    questionTime: null,
                    isShow:true,
                    enterEmail:'Yes',
                    skipEmail:'No',
                    isTyping : true
                },
                {
                    question: 'Please enter your email address.',
                    answer: null,
                    questionTime: null,
                    isShow:true,
                    isTyping : true
                },
                {
                    question: null,
                    answer: null,
                    questionTime: null,
                    isShow:true,
                    isTyping : true
                }
            ]
        };
    },
    updated() {
        this.scrollToBottom()
        this.typing()
    },
    watch: {

        step(newStep, oldStep) {
            if(!this.faqs[newStep].questionTime){
                this.faqs[newStep].questionTime = this.getCurrentTime();
            }

        }
    },
    methods: {
        updateAnswer() {
            this.isShow = true;
            this.faqs[this.step]['answer'] = 'I want to acquire this asset';
            this.step = 1;
        },
        validateAnswer: function (){
            this.isShowChat =false;

            if(this.step == 1){

                const validationRegex = /^[+][0-9]\d{10,15}$/;
                if(this.answer != null && this.answer !='') {
                    if (this.answer.match(validationRegex)) {

                        axios.post('/api/validate/member',{
                                 phone: this.answer,
                        }).then(response => {

                            if(response.data != '' && response.data != null)
                            {
                                this.faqs[this.step]['answer'] = this.answer;
                                this.validatedAnswers['phone'] = response.data.phone
                                this.validatedAnswers['first_name'] = response.data.last_name
                                this.validatedAnswers['last_name'] = response.data.first_name
                                this.memberName = response.data.name
                                this.faqs[2]['isShow'] = false
                                this.faqs[3]['isShow'] = false
                                this.step =4;
                                if(response.data.email != null){
                                    this.faqs[4]['isShow'] = false
                                    this.step =5;
                                    this.validatedAnswers['email'] = response.data.email
                                    this.isShowChat =false;
                                    this.answer = '';
                                    this.faqs[this.step]['isShow'] = false;
                                    this.makeInquire()
                                }else{
                                    if(this.memberName != null){
                                        this.faqs[this.step]['question'] =   this.memberName +' would you like to provide your email address.'
                                    }
                                    this.isShowChat =true;
                                    this.answer = '';
                                    this.endChat= true;
                                }


                            }else{
                                this.validatedAnswers['phone'] = this.answer;
                                this.valid = true;
                                this.errorMessage = null;
                                this.faqs[this.step]['answer'] = this.answer;
                                this.faqs[this.step]['time'] = this.getCurrentTime();
                                this.step++;
                                this.answer = '';
                                this.isShowChat =true;
                            }
                            })

                    } else {
                        this.valid = false;
                        this.isShowChat =true;
                        this.errorMessage = 'Please enter valid phone number';
                    }
                }else{
                    this.valid = false;
                    this.isShowChat =true;
                    this.errorMessage = 'Please enter  phone number';
                }
            }else if(this.step == 2){
                if(this.answer != null && this.answer !=''){
                    this.faqs[this.step]['answer'] = this.answer;
                    this.validatedAnswers['first_name'] = this.answer;
                    this.faqs[this.step]['time'] = this.getCurrentTime();
                    this.valid = true;
                    this.step++;
                    this.isShowChat =true;
                    this.answer = '';
                    this.errorMessage = null;
                }else{
                    this.valid = false;
                    this.isShowChat =true;
                    this.errorMessage = 'Please enter your first name.';
                }
            }else if(this.step == 3){
                if(this.answer != null && this.answer !=''){
                    this.faqs[this.step]['answer'] = this.answer;
                    this.validatedAnswers['last_name'] = this.answer;
                    this.faqs[this.step]['time'] = this.getCurrentTime();
                    this.valid = true;
                    this.step++;
                    this.isShowChat =true;
                    this.answer = '';
                    this.errorMessage = null;

                    this.isShowChat =true;
                    this.endChat= true;

                }else{
                    this.isShowChat =true;
                    this.valid = false;
                    this.errorMessage = 'Please enter your last name.';
                }

            }else if(this.step == 5){

                if((this.answer != null && this.answer != '')){
                    if(this.isValidEmail(this.answer)){
                        this.faqs[this.step]['answer'] =  this.answer;
                        this.validatedAnswers['email'] = this.answer;
                        this.faqs[this.step]['time'] = this.getCurrentTime();
                        this.valid = true;
                        this.step++;
                        this.errorMessage = null;
                        this.answer = '';
                    }else{
                        this.isShowChat =true;
                        this.valid = false;
                        this.errorMessage = 'Please enter valid email address.';
                    }

                }else{
                    this.valid = false;
                    this.isShowChat =true;
                    this.errorMessage = 'Please enter  email address.';
                }

            }

            if((this.validatedAnswers['phone'] != null && this.validatedAnswers['first_name'] != null)
                && (this.validatedAnswers['last_name'] != null && this.step == 6)
            ){
                this.makeInquire();
            }
        },
        async makeInquire() {
            this.isShowChat =false;
            await axios.post('/api/make-inquire', {
                member: this.validatedAnswers,
                asset_id:this.asset_id
            }) .then(response => {

                    this.faqs[this.step]['question'] = response.data.message;
                    this.faqs[this.step]['time'] = this.getCurrentTime();
                    this.faqs[this.step]['isShow'] = true;
                    this.isShowChat =true;
                    this.endChat= true;

                });

        },
        isValidEmail(email) {
            return /^[^@]+@\w+(\.\w+)+\w$/.test(email);
        },
        getCurrentTime()
        {
            return moment().format('HH:mm A')
        },
        saveTime(index){
            if(!this.faqs[index].questionTime){
                this.faqs[index].questionTime = this.getCurrentTime();
            }
        },
        getEmailAnswer: function(event){
            var answer = event.target.getAttribute('data-answer');
            this.faqs[this.step]['answer'] = answer;
            this.faqs[this.step]['time'] = this.getCurrentTime();
            this.emailConfirmation = true;
            this.answer = '';
            this.step++;

            if(answer == 'Yes'){
                this.endChat= false;
                this.isShowChat =true;

            }else{
                this.endChat= false;
                this.isShowChat =true;
                this.faqs[this.step]['isShow'] = false;
                this.makeInquire();
            }

        },
        scrollToBottom() {
            let element = document.getElementById("bottom-div-chat");
            element.scrollIntoView({behavior: "smooth", block: "end"});
        },
        typing(){
            setTimeout( () =>{
                this.faqs[this.step]['isTyping'] = false;
            } , 3000);
        }
    }
}
</script>
<style>
.error-answer{
    background: #e02a2a;
    width: fit-content;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    margin-top: 27px;
    margin-left: 13px;
    color: #fff !important;
    padding: 10px 20px;
    margin: 21px auto 0px;
}
.message-input {
    box-shadow: 0px 2px 15px rgb(0 0 0 / 47%) !important;
}
/* width */
.container.above-wrapper::-webkit-scrollbar {
    width: 5px;
}

/* Track */
.container.above-wrapper::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 10px;
}

/* Handle */
.container.above-wrapper::-webkit-scrollbar-thumb {
    background: linear-gradient(167.96deg, #DFB2A4 0%, #0F2D47 46.87%, #85797C 80.21%, #DFB2A4 96.08%);
    border-radius: 10px;
}

.container.px-4.mt-md-5.px-md-5.above-wrapper {
    max-height: 64vh;
    overflow-y: auto;
}
.container.px-4.mt-md-5.px-md-5.bottom-wrapper {
    position: sticky;
    bottom: 0;
}
.lds-ellipsis {
    display: inline-block;
    position: absolute;
    top: -6px;
    right: 22px;
    width: 80px;
    height: 80px;
}
.yesNo {
    text-align: end;
    margin-top: 10px;
    margin-bottom: 10px;
}
.lds-ellipsis div {
    position: absolute;
    top: 33px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: #003C78;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
    left: 8px;
    animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
    left: 8px;
    animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
    left: 32px;
    animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
    left: 56px;
    animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}
@keyframes lds-ellipsis3 {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(0);
    }
}
@keyframes lds-ellipsis2 {
    0% {
        transform: translate(0, 0);
    }
    100% {
        transform: translate(24px, 0);
    }
}


.typing {
    position: relative;
    background: #fff !important;
    height: 47px !important;
    width: 87px;
    border-radius: 100px;
    margin-left: 7px;

}
.typing span {
    content: "";
    -webkit-animation: blink 1.5s infinite;
    animation: blink 1.5s infinite;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    height: 10px;
    width: 10px;
    background: #3b5998;
    position: absolute;
    left: 30%;
    top: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
}
.typing span:nth-child(2) {
    -webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;
    margin-left: 15px;
}
.typing span:nth-child(3) {
    -webkit-animation-delay: 0.4s;
    animation-delay: 0.4s;
    margin-left: 30px;
}

@-webkit-keyframes blink {
    0% {
        opacity: 0.1;
    }
    20% {
        opacity: 1;
    }
    100% {
        opacity: 0.1;
    }
}

@keyframes blink {
    0% {
        opacity: 0.1;
    }
    20% {
        opacity: 1;
    }
    100% {
        opacity: 0.1;
    }
}
</style>
