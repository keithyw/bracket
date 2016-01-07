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
            handleMessagesFailed: MessageActions.MESSAGES_FAILED
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
        console.log(messages);
        this.messages = messages.data ? messages.data : messages;
        this.error = null;
    }

    handleUpdateMessage(message){
        this.messages.push(message.data);
    }

    saveMessage(message){
        return axios.post('/brackets', {message:message})
            .then(MessageActions.updateMessage);
    }
}

export default flux.createStore(MessageStore, 'MessageStore');