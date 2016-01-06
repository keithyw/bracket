import flux from 'control';
import MessageActions from 'actions/MessageActions';

class MessageStore {
    constructor(){
        this.messages = [];
        this.bindListeners({
            handleUpdateMessage: MessageActions.UPDATE_MESSAGE,
            handleUpdateMessages: MessageActions.UPDATE_MESSAGES,
            handleFetchMessages: MessageActions.FETCH_MESSAGES

        });
    }

    handleFetchMessages(){
        this.messages = [];
    }

    handleUpdateMessages(messages){
        console.log(messages);
        this.messages = messages;
    }

    handleUpdateMessage(message){
        this.messages.push(message);
    }
}

export default flux.createStore(MessageStore, 'MessageStore');