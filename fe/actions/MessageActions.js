import flux from 'control';


class MessageActions {
    updateMessage(message) {
        return message;
    }
}

export default flux.createActions(MessageActions);