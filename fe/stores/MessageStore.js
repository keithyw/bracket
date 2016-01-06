import flux from 'control';
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
    }

    handleFetchMessages(){
        this.messages = [];
    }

    handleMessagesFailed(error){
        this.error = error;
    }

    handleUpdateMessages(messages){
        console.log(messages);
        this.messages = messages;
        this.error = null;
    }

    handleUpdateMessage(message){
        this.messages.push(message);
    }
}

export default flux.createStore(MessageStore, 'MessageStore');