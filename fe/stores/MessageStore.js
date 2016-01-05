import flux from 'control';
import MessageActions from 'actions/MessageActions';

class MessageStore {
    constructor(){
        this.message = '';
        this.bindListeners({
            handleUpdateMessage: MessageActions.UPDATE_MESSAGE
        });
    }

    handleUpdateMessage(message){
        this.message = message;
    }
}

export default flux.createStore(MessageStore, 'MessageStore');