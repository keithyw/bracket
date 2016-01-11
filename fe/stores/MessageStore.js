import flux from 'control';
import axios from 'axios';
import MessageActions from 'actions/MessageActions';
import MessageSource from 'sources/MessageSource';

class MessageStore {
    constructor(){
        this.messages = [];
        this.error = null;
        this.bindListeners({
            handleUpdateMessage: MessageActions.UPDATE_MESSAGE,
            handleUpdateMessages: MessageActions.UPDATE_MESSAGES,
            handleFetchMessages: MessageActions.FETCH_MESSAGES,
            handleMessagesFailed: MessageActions.MESSAGES_FAILED,
            handleFixMessage: MessageActions.FIX_MESSAGE
        });
        this.exportAsync(MessageSource);
        this.exportPublicMethods({
            saveMessage: this.saveMessage
        });
    }

    handleFetchMessages(){
        this.messages = [];
    }

    handleMessagesFailed(error){
        this.error = error;
    }

    handleUpdateMessages(messages){
        this.messages = messages.data ? messages.data : messages;
        this.error = null;
    }

    handleFixMessage(message){
        let found = false;
        let me = this;
        if (this.messages.length > 0){
            this.messages.forEach(function(msg, i){
                if (msg.raw_message_id == message.raw_message_id){
                    me.messages[i] = message;
                    found = true;
                }
            });
            if (!found){
                this.messages.push(message);
            }
        }
        else{
            this.messages.push(message);
        }

    }

    handleUpdateMessage(message){

        let arr = [];
        if (this.messages.length > 0){
            let found = false;
            this.messages.forEach(function(msg, i){
                console.log(msg);
                if (msg.raw_message_id == message.data.raw_message_id){
                    found = true;
                }
            });
        }
        else{
            //this.messages.push(message.data);
        }

    }

    saveMessage(message){
        return axios.post('/brackets', {message:message})
            .then(MessageActions.updateMessage);
    }
}

export default flux.createStore(MessageStore, 'MessageStore');